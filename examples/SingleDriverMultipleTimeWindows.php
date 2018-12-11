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

$addresses = array();
foreach($json as $address) {
    $addresses[] = Address::fromArray($address);
}

$parameters = RouteParameters::fromArray(array(
    "algorithm_type"     => Algorithmtype::TSP,
    "route_name"         => "Single Driver Multiple TimeWindows 12 Stops",
    "route_date"         => time() + 24*60*60,
    "route_time"         => 5 * 3600 + 30 * 60,
    "distance_unit"      => DistanceUnit::MILES,
    "device_type"        => DeviceType::WEB,
    "optimize"           => OptimizationType::DISTANCE,
    "metric"             => Metric::GEODESIC
));

$optimizationParams = new OptimizationProblemParams;
$optimizationParams->setAddresses($addresses);
$optimizationParams->setParameters($parameters);

$problem = OptimizationProblem::optimize($optimizationParams);

foreach ((array)$problem as $key => $value) {
    if (is_string($value)) {
        echo $key." --> ".$value."<br>";
    } else {
        echo "************ $key ************* <br>";
        Route4Me::simplePrint((array)$value);
        echo "******************************* <br>";
    }
}

