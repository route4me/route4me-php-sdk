<?php

//**********************************************************************
// Drivers Schedules with Territories
// 110 Stops
// 5 Drivers
// 12 Schedules
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
    'route_name' => '5 Drivers Schedules '.date('Y-m-d H:i:s', time()),
    'distance_unit' => DistanceUnit::MILES,
    'device_type' => DeviceType::WEB,
    'optimize' => OptimizationType::DISTANCE,
    'travel_mode' => TravelMode::DRIVING,
    'parts' => 5,
    'advanced_constraints' => []
]);

//**********************************************************************
// Territories
$zones = [["ZONE 01"], ["ZONE 02"], ["ZONE 03"]];

//**********************************************************************
// Schedules
// Time: 9:00 am EST => (9 + 5) * 3600 => 50400
$available_time_windows = [
    [50400, 64800], [54000, 75600], [57600, 72000], [57600, 75600], [54000, 68400], 
    [54000, 75600], [54000, 68400], [57600, 79200], [43200, 57600], [57600, 79200],
    [50400, 64800], [43200, 61200]
];

for($i = 0; $i < 12; ++$i)
{
    $parameters->advanced_constraints[] = RouteAdvancedConstraints::fromArray([
        'max_cargo_volume' => 0.0,
        'members_count' => 1,
        'available_time_windows' => [$available_time_windows[$i]],
        'tags' => $zones[$i % 3]
    ]);
}

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
    $addresses[] = Address::fromArray($address);
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
