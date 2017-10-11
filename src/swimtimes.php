<?php

namespace spelbreker\SwimTimesApi;

use SqueSportz\SwimTimes\Connector;

/**
 * Created by PhpStorm.
 * @author Patrick Brouwer
 * Date: 22-3-2017
 * Time: 09:41
 */
class swimTimes
{

    public $api;
    private $_styleJsonLocation = __DIR__ . '\..\cache\styles.json';

    /**
     * swimTimes constructor.
     *
     * setup connection from username and password for the swimtimes.nl api connection
     * https://www.swimtimes.nl/about/apis/console
     */
    public function __construct()
    {
        //setup connection
        $this->api = new Connector();
        $this->api->setAuth(config('swimtimes.username'), config('swimtimes.password'));

        //setup style json file for fast calculation styles
        $this->createStylesJsonCache();
    }

    /**
     * get all nations
     * @return array
     */
    public function getNations()
    {
        $this->api->setPath('match/list/nations');
        return $this->api->getData();
    }

    /**
     * get know teams by nation
     *
     * this function is to find the team unique number or code for set in the config
     *
     * @param $nation
     * @return array
     */
    public function getTeamsByNation($nation)
    {
        $this->api->setPath('team/list?nation=' . $nation);
        return $this->api->getData();
    }

    /**
     * get swimmers by team id/code
     *
     * @param null $team team id/code (not required if set default in config)
     * @param null $active Swimmers who have an active license (not required if set default in config)
     * @return mixed|string
     */
    public function getSwimmersByTeam($team = null, $active = null)
    {
        if ($team != null) { //set default
            $team = config('swimtimes.team', '371');
        }

        if ($active != null) {
            $active = config('swimtimes.active', 'false');
        }

        $this->api->setPath('swim/list/team?team=' . $team . '&active=' . $active);
        return $this->api->getData();
    }

    /**
     * format time
     *
     * @param $Time
     * @return string
     */
    public function calcTime($Time)
    {
        if (strpos($Time, '.') || strpos($Time, ',')) { /* Mistake because of localisation */
            $seconden = intval($Time);
            $duizenste = substr(intval($Time * 100), -2);
        } else {
            $seconden = intval($Time);
            $duizenste = 0;
        }
        $duizenste = str_pad(intval($duizenste), 2, "0", STR_PAD_LEFT);
        if (intval($seconden / 60) > 0) {
            $minuten = intval($seconden / 60);
            if (intval($minuten / 60) > 0) {
                $minutes_seconds = intval($minuten / 60) . ":" . (str_pad(($minuten % 60), 2, "0", STR_PAD_LEFT)) . ":" . (str_pad(($seconden % 60), 2, "0", STR_PAD_LEFT));
            } else {
                $minutes_seconds = $minuten . ":" . (str_pad(($seconden % 60), 2, "0", STR_PAD_LEFT));
            }
        } else {
            $minutes_seconds = $seconden;
        }
        $Time = $minutes_seconds . "." . $duizenste;
        return $Time;
    }

    /**
     * reformat date to dutch date format
     *
     * @param $date
     * @return string
     */
    public function calcDate($date)
    {
        list($year, $month, $day) = explode("-", $date);
        return "$day-$month-$year";
    }

    /**
     * calculate style (dutch)
     *
     * @param $i style number
     * @return string
     */
    public function calcStyle($i)
    {
        $styles = json_decode(file_get_contents($this->_styleJsonLocation));
        return (isset($styles->$i) ? $styles->$i : 'Onbekend');
    }

    /**
     * create styles cache for fast calculating styles (dutch)
     */
    public function createStylesJsonCache()
    {
        if (!file_exists($this->_styleJsonLocation) || filemtime($this->_styleJsonLocation) <= (time() - 60 * 60 * 24 * 15)) { // Recheck every 15 days
            function swimStroke($i)
            {
                if ($i == 0) return 'Wisselslag';
                elseif ($i == 1) return 'Vlinderslag';
                elseif ($i == 2) return 'Rugslag';
                elseif ($i == 3) return 'Schoolslag';
                elseif ($i == 4) return 'Vrije slag';
            }

            /* Get all the strokes */
            try {
                $this->api->setPath('styles/all');
                $data = $this->api->getData();
                $styles = array();
                foreach ($data as $k => $d) {
                    @$styles[$d->swimid] = ($d->swimcount > 1 ? $d->swimcount . " x " : "") . $d->swimdistance . "m " . swimStroke($d->swimstroke);
                }
                file_put_contents($this->_styleJsonLocation, json_encode($styles, JSON_PRETTY_PRINT));
            } catch (Exception $e) {
                echo 'Error: ', $e->getMessage(), "\n";
                exit;
            }
        }
    }


}
