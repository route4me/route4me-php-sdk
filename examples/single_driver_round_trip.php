<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../');
require $root.'/vendor/autoload.php';

use Route4Me\Enum\OptimizationType;
use Route4Me\Enum\AlgorithmType;
use Route4Me\Enum\DistanceUnit;
use Route4Me\Enum\DeviceType;
use Route4Me\Enum\TravelMode;

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

// Huge list of addresses
$json = json_decode(file_get_contents('./addresses.json'), true);
$json = array_slice($json, 0, 10);

$addresses = [];

foreach ($json as $address) {
    $addresses[] = Address::fromArray($address);
}

$parameters = RouteParameters::fromArray([
    'algorithm_type' => AlgorithmType::TSP,
    'distance_unit' => DistanceUnit::MILES,
    'device_type' => DeviceType::WEB,
    'optimize' => OptimizationType::DISTANCE,
    'travel_mode' => TravelMode::DRIVING,
    'route_max_duration' => 86400,
    'vehicle_capacity' => 1,
    'vehicle_max_distance_mi' => 10000,
    'rt' => true,
]);

$optimizationParams = new OptimizationProblemParams();
$optimizationParams->setAddresses($addresses);
$optimizationParams->setParameters($parameters);

$problems = OptimizationProblem::optimize($optimizationParams);

foreach ($problems as $problem) {
    Route4Me::simplePrint($problem, true );
}
