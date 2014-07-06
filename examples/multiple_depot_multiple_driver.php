<?php
require __DIR__.'/../vendor/autoload.php';;

use Route4me\Route4me;
use Route4me\Enum\OptimizationType;
use Route4me\OptimizationProblem;
use Route4me\OptimizationProblemParams;
use Route4me\Enum\AlgorithmType;
use Route4me\Enum\DistanceUnit;
use Route4me\Enum\DeviceType;
use Route4me\Enum\TravelMode;
use Route4me\Enum\Metric;
use Route4me\RouteParameters;
use Route4me\Address;
use Route4me\Route;

Route4me::setApiKey('11111111111111111111111111111111');

// Huge list of addresses
$json = json_decode(file_get_contents('./addresses.json'), true);

$addresses = array();
foreach($json as $address) {
    $addresses[] = Address::fromArray($address);
}

$parameters = RouteParameters::fromArray(array(
    "algorithm_type"          => AlgorithmType::CVRP_TW_SD,
    "distance_unit"           => DistanceUnit::MILES,
    "device_type"             => DeviceType::WEB,
    "optimize"                => OptimizationType::DISTANCE,
    "metric"                  => Metric::GEODESIC,
    "route_max_duration"      => 86400 * 2,
    "travel_mode"             => TravelMode::DRIVING,
    "vehicle_capacity"        => 50,
    "vehicle_max_distance_mi" => 10000,
    "parts"                   => 50
));

$optimizationParams = new OptimizationProblemParams;
$optimizationParams->setAddresses($addresses);
$optimizationParams->setParameters($parameters);

$problem = OptimizationProblem::optimize($optimizationParams);

var_dump($problem);
