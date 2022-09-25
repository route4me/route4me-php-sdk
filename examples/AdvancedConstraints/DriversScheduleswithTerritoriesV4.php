<?php

//**********************************************************************
// Drivers Schedules with Territories
// 110 Stops
// 5 Drivers
// 3 Schedules
// 3 Territories
//**********************************************************************

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Enum\OptimizationType;
use Route4Me\Enum\AlgorithmType;
use Route4Me\Enum\DistanceUnit;
use Route4Me\Enum\DeviceType;
use Route4Me\Enum\OptimizationStates;
use Route4Me\Enum\TravelMode;
use Route4Me\V5\Addresses\RouteAdvancedConstraints;

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

//**********************************************************************
// General Route Parameters
$parameters = RouteParameters::fromArray([
    'rt' => true,
    'algorithm_type' => Algorithmtype::ADVANCED_CVRP_TW,
    'route_name' => 'Drivers Schedules - 3 Territories '.date('Y-m-d H:i:s', time()),
    'distance_unit' => DistanceUnit::MILES,
    'device_type' => DeviceType::WEB,
    'optimize' => OptimizationType::DISTANCE,
    'travel_mode' => TravelMode::DRIVING,
    'parts' => 10,
    'advanced_constraints' => []
]);

//**********************************************************************
// Territories
$zones = [["ZONE 01"], ["ZONE 02"], ["ZONE 03"]];

//**********************************************************************
// Schedules
// Schedule 1
// Time Window Start:  8:00 am EST
// Time Window End:   11:00 am EST
$parameters->advanced_constraints[] = RouteAdvancedConstraints::fromArray([
    'tags' => $zones[0],
    '$members_count' => 3,
    'available_time_windows' => [[(8 + 5) * 3600 , (11 + 5) * 3600]]
]);

// Schedule 2
// Time Window Start:  8:00 am EST
// Time Window End:   12:00 pm EST
$parameters->advanced_constraints[] = RouteAdvancedConstraints::fromArray([
    'tags' => $zones[1],
    '$members_count' => 3,
    'available_time_windows' => [[(8 + 5) * 3600 , (12 + 5) * 3600]]
]);

// Schedule 3
// Time Window Start:  8:00 am EST
// Time Window End:   01:00 pm EST
$parameters->advanced_constraints[] = RouteAdvancedConstraints::fromArray([
    'tags' => $zones[2],
    '$members_count' => 3,
    'available_time_windows' => [[(8 + 5) * 3600 , (13 + 5) * 3600]]
]);

//**********************************************************************
// Addresses
$json = json_decode(file_get_contents(dirname(__FILE__).'/data/addresses_110.json'), true);

// Depot
$addresses[] = Address::fromArray([
    'address' => 'DEPOT',
    'is_depot' => true,
    'lat' => 25.694341,
    'lng' => -80.166036,
    'time' => 0
]);

// Stops
foreach ($json as $address) {
    $addresses[] = Address::fromArray([
        'address' => $address['address'],
        'is_depot' => false,
        'lat' => $address['lat'],
        'lng' => $address['lng'],
        'time' => 300,
        'tags' => $address['tags']
    ]);
}

$optimizationParams = new OptimizationProblemParams();
$optimizationParams->setAddresses($addresses);
$optimizationParams->setParameters($parameters);

$problem = OptimizationProblem::optimize($optimizationParams);

echo "Optimization Problem ID: " . $problem->optimization_problem_id . PHP_EOL;
echo "State: " . OptimizationStates::getName($problem->state) . " (" . $problem->state . ")" . PHP_EOL;

echo "Routes:" . PHP_EOL;
foreach($problem->routes as $route)
{
    echo "\tID: " . $route->route_id . PHP_EOL;
    echo "\tDistance: " . $route->trip_distance . PHP_EOL;
}
