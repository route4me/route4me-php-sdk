<?php

//**********************************************************************
// Create Route Schedule
//**********************************************************************

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\V5\RecurringRoutes\Schedules as Schedules;

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

try {
    $route_schedules = new Schedules;

    $params = [
        'route_id' => '66C2AC4A323053FF0A40FEB6918ACF5E',
        'schedule_uid' => '1515E9A65DD2DEF79CAD7A7E68D91515'
    ];

    $schedule = $route_schedules->createRouteSchedule($params);

    print_r($schedule);
} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
