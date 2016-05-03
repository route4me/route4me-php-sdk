<?php
require __DIR__.'/../vendor/autoload.php';
//See video tutorial here: http://support.route4me.com/route-planning-help.php?id=manual0:tutorial2:chapter1:subchapter1

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

