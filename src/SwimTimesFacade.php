<?php
namespace spelbreker\SwimTimesApi;

use \Illuminate\Support\Facades\Facade;

class SwimTimesFacade extends Facade {
    
    protected static function getFacadeAccessor() {
        return 'swimtimes';
    }
}
