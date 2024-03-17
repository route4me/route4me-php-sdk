<?php

//**********************************************************************
// Get all routes copied from the specified Scheduled Route
//**********************************************************************

namespace Route4Me;

use Route4Me\V5\RecurringRoutes\Schedules as Schedules;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

try {
    $schedules = new Schedules();
    $route_id = '66C2AC4A323053FF0A40FEB6918ACF5E';
    $schedule_uid = '1515E9A65DD2DEF79CAD7A7E68D91515';
    $route_date = '2023-01-01';

    $schedule = $schedules->getScheduledRoutesCopies($route_id, $schedule_uid, $route_date);
    print_r($schedule);
} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
