<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../');
require $root.'/vendor/autoload.php';

use Route4Me\Enum\OptimizationType;
use Route4Me\Enum\AlgorithmType;
use Route4Me\Enum\DistanceUnit;
use Route4Me\Enum\DeviceType;
use Route4Me\Enum\TravelMode;
use Route4Me\Enum\Metric;

// Set the api key in the Route4me class
// This example is not available for demo API key
Route4Me::setApiKey(Constants::API_KEY);

// List of addresses
$jsonAddresses = json_decode(file_get_contents('./addresses_only.json'), true);

$addresses = [];
foreach ($jsonAddresses as $address) {
    $addresses[] = Address::fromArray($address);
}

$jsonDepots = json_decode(file_get_contents('./depots.json'), true);

// List of depots
$depots = [];
foreach ($jsonDepots as $depot) {
    $depots[] = Address::fromArray($depot);
}

$parameters = RouteParameters::fromArray([
    'route_name' => 'Multiple Depots Seprate Section '.date('Y-m-d H:i'),
    'algorithm_type' => AlgorithmType::CVRP_TW_MD,
    'distance_unit' => DistanceUnit::MILES,
    'device_type' => DeviceType::WEB,
    'optimize' => OptimizationType::TIME,
    'metric' => Metric::GEODESIC,
    'route_max_duration' => 86400 * 2,
    'travel_mode' => TravelMode::DRIVING,
    'vehicle_capacity' => 50,
    'vehicle_max_distance_mi' => 10000,
    'parts' => 50,
]);

$optimizationParams = new OptimizationProblemParams();
$optimizationParams->setAddresses($addresses);
$optimizationParams->setDepots($depots);
$optimizationParams->setParameters($parameters);

$problem = OptimizationProblem::optimize($optimizationParams);

Route4Me::simplePrint((array) $problem, true);
