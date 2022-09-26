<?php

//**********************************************************************
// Driver's Different Working Time
// Drivers have 2 Working Times:
// Full Time 8h
// Partial Time 4h
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

// Depot
$depots = [
    Address::fromArray([
        'alias' => 'Start Depot',
        'address' => '1604 PARKRIDGE PKWY, Louisville, KY, 40214',
        'lat' => 38.141598,
        'lng' => -80.190211
    ])
];

//**********************************************************************
// General Route Parameters
$parameters = RouteParameters::fromArray([
    'algorithm_type' => Algorithmtype::ADVANCED_CVRP_TW,
    'route_name' => 'Drivers Different Working Time Example - Single Depot, Multiple Driver '.date('Y-m-d H:i:s', time()),
    'route_date' => time() + 24 * 60 * 60,
    'route_time' => 6 * 3600,
    'distance_unit' => DistanceUnit::MILES,
    'device_type' => DeviceType::WEB,
    'optimize' => OptimizationType::DISTANCE,
    'travel_mode' => TravelMode::DRIVING,
    'route_max_duration' => 8 * 60 * 60,
    'parts' => 6,
    'advanced_constraints' => []
]);

//**********************************************************************
// Schedules
// Schedule part time
// Time Window Start:  7:00 am EST
// Time Window End:   11:00 am EST
$parameters->advanced_constraints[] = RouteAdvancedConstraints::fromArray([
    'max_cargo_volume' => 0.0,
    'members_count' => 4,
    'available_time_windows' => [[(7 + 5) * 3600 , (11 + 5) * 3600]]
]);

// Schedule full time
// Time Window Start:  7:00 am EST
// Time Window End:   15:00 am EST
$parameters->advanced_constraints[] = RouteAdvancedConstraints::fromArray([
    'max_cargo_volume' => 0.0,
    'members_count' => 2,
    'available_time_windows' => [[(7 + 5) * 3600 , (15 + 5) * 3600]]
]);

//**********************************************************************
// Addresses
$json = json_decode(file_get_contents(dirname(__FILE__).'/data/addresses_9.json'), true);
$addresses = [];

foreach ($json as $address) {
    $addresses[] = Address::fromArray([
        'address' => $address['address'],
        'lat' => $address['lat'],
        'lng' => $address['lng'],
        'time' => $address['time']
    ]);
}

$optimizationParams = new OptimizationProblemParams();
$optimizationParams->setAddresses($addresses);
$optimizationParams->setDepots($depots);
$optimizationParams->setParameters($parameters);

$problem = OptimizationProblem::optimize($optimizationParams);

echo "Optimization Problem ID: " . $problem->optimization_problem_id . PHP_EOL;
echo "State: " . OptimizationStates::getName($problem->state) . " (" . $problem->state . ")" . PHP_EOL;

echo "Optimization Problem ID: " . $problem->optimization_problem_id . PHP_EOL;
echo "State: " . OptimizationStates::getName($problem->state) . " (" . $problem->state . ")" . PHP_EOL;

echo "Routes:" . PHP_EOL;
foreach($problem->routes as $route)
{
    echo "\tID: " . $route->route_id . PHP_EOL;
    echo "\tDistance: " . $route->trip_distance . PHP_EOL;
    echo "\tAddresses:" . PHP_EOL;

    foreach($route->addresses as $address) echo "\t\t" . $address->address . PHP_EOL;
}
