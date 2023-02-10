<?php

//**********************************************************************
// Delete Schedule by ID
//**********************************************************************

namespace Route4Me;

use Route4Me\V5\RecurringRoutes\Schedules as Schedules;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

try {
    $schedules = new Schedules();

    $schedule = $schedules->deleteSchedule('1515E9A65DD2DEF79CAD7A7E68D91515');
    print_r($schedule);
} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
