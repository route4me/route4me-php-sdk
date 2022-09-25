<?php

//**********************************************************************
// Optimization using Territories addresses
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
    'route_name' => 'Single Depot, Multiple Driver - 3 Territories IDs '.date('Y-m-d H:i:s', time()),
    'route_time' => 46800,
    'distance_unit' => DistanceUnit::MILES,
    'device_type' => DeviceType::WEB,
    'optimize' => OptimizationType::DISTANCE,
    'travel_mode' => TravelMode::DRIVING,
    'advanced_constraints' => [] 
]);

//**********************************************************************
// Schedules
// Schedule 1
// Time Window Start:  8:00 am EST
// Time Window End:   11:00 am EST
$parameters->advanced_constraints[] = RouteAdvancedConstraints::fromArray([
    'max_cargo_volume' =>  0.0,
    'members_count' =>  3,
    'available_time_windows' => [[46800, 57600]],
    'tags' => ['A34BA30C717D1194FC0230252DF0C45C']
]);

// Schedule 2
// Time Window Start:  8:00 am EST
// Time Window End:   12:00 am EST
$parameters->advanced_constraints[] = RouteAdvancedConstraints::fromArray([
    'max_cargo_volume' =>  0.0,
    'members_count' =>  4,
    'available_time_windows' => [[46800, 61200]],
    'tags' => ['DA6A8F10313CCFEC843978FC065F235B']
]);

// Schedule 3
// Time Window Start:  8:00 am EST
// Time Window End:   13:00 am EST
$parameters->advanced_constraints[] = RouteAdvancedConstraints::fromArray([
    'max_cargo_volume' =>  0.0,
    'members_count' =>  3,
    'available_time_windows' => [[46800, 64800]],
    'tags' =>  ['8142ABF2D693336987726ECDB5ED2D6D']
]);

//**********************************************************************
// Addresses
$json = json_decode(file_get_contents(dirname(__FILE__).'/data/addresses_41.json'), true);
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
