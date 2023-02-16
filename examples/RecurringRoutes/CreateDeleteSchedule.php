<?php

//**********************************************************************
// Create Schedule then create, update, get. delete RouteSchedule
//**********************************************************************

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Exception\ApiError;
use Route4Me\V5\Routes\AddonRoutesApi\Route;
use Route4Me\V5\RecurringRoutes\Schedules;
use Route4Me\V5\Vehicles\DataTypes\Vehicle;

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

try {
    // get route_id and member_id
    $route = new Route;
    $routes = $route->getRoutes([
        'limit' => 1,
        'offset' => 0
    ]);

    $route_id = null;
    $member_id = null;
    if (is_array($routes) && isset($routes[0])) {
        $route_id = $routes[0]->route_id;
        $member_id = $routes[0]->member_id;
    }
    $route = null;

    if ($route_id === null) {
        throw new ApiError('There is no any route.');
    }

    // get vehicle_id
    $vehicle = new Vehicle();
    $vehicles = $vehicle->getVehiclesPaginatedList([
        'with_pagination' => true,
        'page' => 1,
        'perPage' => 1
    ]);

    $vehicle_id = null;
    if (is_array($vehicles) && isset($vehicles[0]) && is_array($vehicles[0]) && isset($vehicles[0]['vehicle_id'])) {
        $vehicle_id = $vehicles[0]['vehicle_id'];
    }
    $vehicle = null;

    if ($vehicle_id === null) {
        throw new ApiError('There is no any vehicle.');
    }

    // create Schedule
    $schedules = new Schedules;

    $schedule = $schedules->createSchedule([
        'name' => 'The bestest schedule',
        'schedule_blacklist' => [],
        'schedule' => null,
        'timezone' => 'UTC'
    ]);

    // work with RouteSchedule
    $route_schedule = $schedules->createRouteSchedule([
        'route_id' => $route_id,
        'schedule_uid' => $schedule->schedule_uid
    ]);

    $route_schedule = $schedules->updateRouteSchedule($route_id, [
        'schedule_uid' => $schedule->schedule_uid,
        'member_id' => $member_id,
        'vehicle_id' => $vehicle_id
    ]);

    $route_schedule = $schedules->getRouteSchedule($route_id);

    $schedules->deleteRouteSchedule($route_id);

    print_r($route_schedule);
} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
