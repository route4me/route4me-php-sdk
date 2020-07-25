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

// Huge list of addresses
$json = json_decode(file_get_contents('./addresses.json'), true);

$addresses = [];
foreach ($json as $address) {
    $addresses[] = Address::fromArray($address);
}

$parameters = RouteParameters::fromArray([
    'algorithm_type' => Algorithmtype::CVRP_TW_SD,
    'route_name' => 'Single Depot, Multiple Driver, No Time Window',
    'route_date' => time() + 24 * 60 * 60,
    'route_time' => 60 * 60 * 7,
    'rt' => true,
    'distance_unit' => DistanceUnit::MILES,
    'device_type' => DeviceType::WEB,
    'optimize' => OptimizationType::TIME,
    'metric' => Metric::GEODESIC,
    'route_max_duration' => 86400,
    'travel_mode' => TravelMode::DRIVING,
    'vehicle_capacity' => 20,
    'vehicle_max_distance_mi' => 99999,
    'parts' => 4,
]);

$optimizationParams = new OptimizationProblemParams();
$optimizationParams->setAddresses($addresses);
$optimizationParams->setParameters($parameters);

$problem = OptimizationProblem::optimize($optimizationParams);

foreach ((array) $problem as $key => $value) {
    if (is_string($value)) {
        echo $key.' --> '.$value.'<br>';
    } else {
        echo "************ $key ************* <br>";
        Route4Me::simplePrint((array) $value, true);
        echo '******************************* <br>';
    }
}
