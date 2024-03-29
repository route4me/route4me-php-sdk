<?php

//**********************************************************************
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
    'rt' => TRUE,
    'algorithm_type' => Algorithmtype::ADVANCED_CVRP_TW,
    'route_name' => 'Retail Location - Single Depot - Multiple Driver '.date('Y-m-d H:i:s', time()),
    'route_time' => 25200,
    'distance_unit' => DistanceUnit::MILES,
    'device_type' => DeviceType::WEB,
    'optimize' => OptimizationType::DISTANCE,
    'travel_mode' => TravelMode::DRIVING,
    'advanced_constraints' => [] 
]);

//**********************************************************************
// Schedules
// Schedule 1
// Time Window Start:  2:00 am EST
// Time Window End:    3:20 am EST
$parameters->advanced_constraints[] = RouteAdvancedConstraints::fromArray([
    'members_count' => 10,
    'available_time_windows' => [[25200, 30000]],
    'location_sequence_pattern' =>
    [
        [
            'alias' => 'AFTER DEPOT LOCATION',
            'address' => '1407 MCCOY, Louisville, KY, 40215',
            'lat' => 38.202496,
            'lng' => -85.786514,
            'time' => 300
        ],
        '',
        [
            'alias' => 'BEFORE DEPOT LOCATION',
            'address' => '4738 BELLEVUE AVE, Louisville, KY, 40215',
            'lat' => 38.179806,
            'lng' => -85.775558,
            'time' => 300
        ]
    ]
]);

//**********************************************************************
// Addresses
$json = json_decode(file_get_contents(dirname(__FILE__).'/data/addresses_9.json'), true);

// Depot
$addresses[] = Address::fromArray([
    'address' => '1604 PARKRIDGE PKWY, Louisville, KY, 40214',
    'is_depot' => true,
    'lat' => 38.141598,
    'lng' => -85.793846,
    'time' => 0
]);

// Stops
foreach ($json as $address) {

    // skip retail
    if($address['address'] == '1407 MCCOY, Louisville, KY, 40215') continue;
    if($address['address'] == '4738 BELLEVUE AVE, Louisville, KY, 40215') continue;

    $addresses[] = Address::fromArray([
        'address' => $address['address'],
        'alias' => 'DEPOT',
        'lat' => $address['lat'],
        'lng' => $address['lng'],
        'time' => $address['time']
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
    echo "\tAddresses:" . PHP_EOL;

    foreach($route->addresses as $address) echo "\t\t" . $address->address . PHP_EOL;
}
