<?php

//**********************************************************************
// Create a new Master Route
//**********************************************************************

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\V5\RecurringRoutes\Schedules as Schedules;

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

try {
    $schedules = new Schedules;

    $params = [
        'route_id' => '66C2AC4A323053FF0A40FEB6918ACF5E',
        'route_name' => 'The Bestest route',
        'member_id' => 1053088,
        'vehicle_id' => '061C7E7DCE3538AD2D0B047954F1F499',
        'name' => 'The bestest schedule',
        'schedule_blacklist' => [],
        'schedule' => null,
        'timezone' => 'UTC'
    ];

    $res = $schedules->createMasterRoute($params);

    echo var_export($res) . PHP_EOL;
} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
