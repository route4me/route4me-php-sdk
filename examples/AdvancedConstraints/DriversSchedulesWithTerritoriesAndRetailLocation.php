<?php

//**********************************************************************
// Drivers Schedules with Territories and Retail Location
// 110 Stops
// 2 Drivers
// 6 Schedules
// 3 Territories
// Retail Location
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
    'parts' => 2,
    'advanced_constraints' => []
]);

//**********************************************************************
// Territories
$zones = [["ZONE 01"], ["ZONE 02"], ["ZONE 03"]];

//**********************************************************************
// Schedules
// Time Window Start:  8:00 am EST
// Time Window End:   11:00 am EST
for($i = 0; $i < 6; ++$i)
{
    $parameters->advanced_constraints[] = RouteAdvancedConstraints::fromArray([
        'max_cargo_volume' => 0.0,
        'members_count' => 1,
        'available_time_windows' => [[(8 + 5) * 3600 , (11 + 5) * 3600]],
        'tags' => $zones[$i % 3],
        'location_sequence_pattern' => [
            '',
            Address::fromArray([
                'alias' => 'RETAIL LOCATION',
                'address' => 'RETAIL LOCATION',
                'lat' => 25.8741751,
                'lng' => -80.1288583,
                'time' => 300
            ])
        ]
    ]);
}

//**********************************************************************
// Addresses
$json = json_decode(file_get_contents(dirname(__FILE__).'/data/addresses_110.json'), true);
$addresses = [];

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
