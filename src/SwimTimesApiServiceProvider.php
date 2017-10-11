<?php

namespace PatrickBrouwer\SwimTimesApi;

use Illuminate\Support\ServiceProvider;

class SwimTimesApiServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        //setup config to publisch patch
        $this->publishes([
            __DIR__ . '/../config/swimtimes.php' => config_path('swimtimes.php'),
        ]);

        //include the connector for the connector class from SqueSportz
        include realpath(dirname(__FILE__)).'/SqueSportz/SwimTimes/connector.class.php';
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}