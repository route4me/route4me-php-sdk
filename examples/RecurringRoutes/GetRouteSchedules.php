<?php

//**********************************************************************
// Get list of Route Schedules
//**********************************************************************

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\V5\RecurringRoutes\Schedules as Schedules;

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

$schedules = new Schedules();

//**********************************************************************
// get list of all Route Schedules
try {
    $list = $schedules->getAllRouteSchedules();
    print_r($list);
} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}

//**********************************************************************
// get first page of paginated list of Route Schedules
try {
    $list = $schedules->getRouteSchedules(1, 5);
    print_r($list);
} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
