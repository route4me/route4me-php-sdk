<?php
require __DIR__.'/../vendor/autoload.php';
//See video tutorial here: http://support.route4me.com/route-planning-help.php?id=manual0:tutorial2:chapter2:subchapter1

use Route4Me\Route4Me;
use Route4Me\Enum\OptimizationType;
use Route4Me\OptimizationProblem;
use Route4Me\OptimizationProblemParams;
use Route4Me\Enum\AlgorithmType;
use Route4Me\Enum\DistanceUnit;
use Route4Me\Enum\DeviceType;
use Route4Me\Enum\TravelMode;
use Route4Me\Enum\Metric;
use Route4Me\RouteParameters;
use Route4Me\Address;
use Route4Me\Route;

Route4Me::setApiKey('11111111111111111111111111111111');

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
