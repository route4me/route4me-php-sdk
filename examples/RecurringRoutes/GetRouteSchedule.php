<?php

//**********************************************************************
// Get Route Schedule by Route ID
//**********************************************************************

namespace Route4Me;

use Route4Me\V5\RecurringRoutes\Schedules as Schedules;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

try {
    $schedules = new Schedules();

    $schedule = $schedules->getRouteSchedule('66C2AC4A323053FF0A40FEB6918ACF5E');
    print_r($schedule);
} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
