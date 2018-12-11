<?php
$root=realpath(dirname(__FILE__).'/../');
require $root.'/vendor/autoload.php';

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

// Set the api key in the Route4me class
Route4Me::setApiKey('11111111111111111111111111111111');

// Huge list of addresses
$json = json_decode(file_get_contents('./addresses.json'), true);
$json = array_slice($json, 0, 10);

$addresses = array();

foreach($json as $address) {
    $addresses[] = Address::fromArray($address);
}

$parameters = RouteParameters::fromArray(array(
    "algorithm_type"          => AlgorithmType::TSP,
    "distance_unit"           => DistanceUnit::MILES,
    "device_type"             => DeviceType::WEB,
    "optimize"                => OptimizationType::DISTANCE,
    "travel_mode"             => TravelMode::DRIVING,
    "route_max_duration"      => 86400,
    "vehicle_capacity"        => 1,
    "vehicle_max_distance_mi" => 10000,
    "rt"                      => true
));

$optimizationParams = new OptimizationProblemParams;
$optimizationParams->setAddresses($addresses);
$optimizationParams->setParameters($parameters);

$problems = OptimizationProblem::optimize($optimizationParams);

foreach ($problems as $problem) {
    if (is_array($problem) || is_object($problem)) {
        foreach ($problem as $key => $value) {
            if (!is_object($value)) {
                echo $key." --> ".$value."<br>";
            }
        }
    }
}
