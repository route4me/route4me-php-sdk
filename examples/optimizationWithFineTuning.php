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
use Route4Me\Route;

// The example refers to the process of creating new optimization with fine-tuning.

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

// Huge list of addresses
$json = json_decode(file_get_contents('./addresses_md_tw.json'), true);
$json = array_slice($json, 0, 19);

$addresses = [];

foreach ($json as $address) {
    $addresses[] = Address::fromArray($address);
}

//region Optimization With Duration Priority FineTuning
$parameters = RouteParameters::fromArray([
    'route_name'                => 'Optimization With Duration Priority FineTuning. '.date('Y-m-d H:i'),
    'algorithm_type'            => AlgorithmType::CVRP_TW_SD,
    'route_time'                => 23200,
    'optimize'                  => OptimizationType::TIME,
    'device_type'               => DeviceType::WEB,
    'udu_distance_unit'         => 'km',
    'route_max_duration'        => 86400,
    'travel_mode'               => TravelMode::DRIVING,
    'vehicle_capacity'          => 30,
    'vehicle_max_distance_mi'   => 10000,
    'rt'                        => true,
    'target_duration'           => 100,
    'target_distance'           => 0,
    'target_wait_by_tail_size'  => 0

]);

$optimizationParams = new OptimizationProblemParams();
$optimizationParams->setAddresses($addresses);
$optimizationParams->setParameters($parameters);

$problems = OptimizationProblem::optimize($optimizationParams);
assert(!is_null($problems), "Cannot generate an optimization with duration priority fine-tuning");

$routes=$problems->getRoutes();
assert(sizeof($routes)==2, "The generated optimization hasn't two routes");

$totalTripDistanceByDuration = $routes[0]->trip_distance + $routes[1]->trip_distance;
$totalTripDurationByDuration = $routes[0]->route_duration_sec + $routes[1]->route_duration_sec;
$totalTripWaitingTimeByDuration = $routes[0]->total_wait_time + $routes[1]->total_wait_time;

echo "Generated an optimization with the <b>duration</b> priority fine-tuning:<br>";
echo "   Total Trip Distance:     $totalTripDistanceByDuration <br>";
echo "   Total Trip Duration:     $totalTripDurationByDuration <br>";
echo "   Total Trip Waiting Time: $totalTripWaitingTimeByDuration <br><br><br>";

//endregion


//region Optimization With Distance Priority FineTuning
$parameters = RouteParameters::fromArray([
    'route_name'                => 'Optimization With Distance Priority FineTuning. '.date('Y-m-d H:i'),
    'algorithm_type'            => AlgorithmType::CVRP_TW_SD,
    'route_time'                => 23200,
    'optimize'                  => OptimizationType::TIME,
    'device_type'               => DeviceType::WEB,
    'udu_distance_unit'         => 'km',
    'route_max_duration'        => 86400,
    'travel_mode'               => TravelMode::DRIVING,
    'vehicle_capacity'          => 30,
    'vehicle_max_distance_mi'   => 10000,
    'rt'                        => true,
    'target_duration'           => 0,
    'target_distance'           => 100,
    'target_wait_by_tail_size'  => 0

]);

$optimizationParams = new OptimizationProblemParams();
$optimizationParams->setAddresses($addresses);
$optimizationParams->setParameters($parameters);

$problems = OptimizationProblem::optimize($optimizationParams);
assert(!is_null($problems), "Cannot generate an optimization with the distance priority fine-tuning");

$routes=$problems->getRoutes();
assert(sizeof($routes)==2, "The generated optimization hasn't two routes");

$totalTripDistanceByDistance = $routes[0]->trip_distance + $routes[1]->trip_distance;
$totalTripDurationByDistance = $routes[0]->route_duration_sec + $routes[1]->route_duration_sec;
$totalTripWaitingTimeByDistance = $routes[0]->total_wait_time + $routes[1]->total_wait_time;

echo "Generated an optimization with the <b>distance</b> priority fine-tuning:<br>";
echo "   Total Trip Distance:     $totalTripDistanceByDistance <br>";
echo "   Total Trip Duration:     $totalTripDurationByDistance <br>";
echo "   Total Trip Waiting Time: $totalTripDurationByDistance <br><br><br>";

//endregion


//region Optimization With TimeWaiting Priority FineTuning
$parameters = RouteParameters::fromArray([
    'route_name'                => 'Optimization With WaitingTime Priority FineTuning. '.date('Y-m-d H:i'),
    'algorithm_type'            => AlgorithmType::CVRP_TW_SD,
    'route_time'                => 23200,
    'optimize'                  => OptimizationType::TIME,
    'device_type'               => DeviceType::WEB,
    'udu_distance_unit'         => 'km',
    'route_max_duration'        => 86400,
    'travel_mode'               => TravelMode::DRIVING,
    'vehicle_capacity'          => 30,
    'vehicle_max_distance_mi'   => 10000,
    'rt'                        => true,
    'target_duration'           => 0,
    'target_distance'           => 0,
    'target_wait_by_tail_size'  => 100

]);

$optimizationParams = new OptimizationProblemParams();
$optimizationParams->setAddresses($addresses);
$optimizationParams->setParameters($parameters);

$problems = OptimizationProblem::optimize($optimizationParams);
assert(!is_null($problems), "Cannot generate an optimization with the waiting time priority fine-tuning");

$routes=$problems->getRoutes();
assert(sizeof($routes)==2, "The generated optimization hasn't two routes");

$totalTripDistanceByTimeWaiting = $routes[0]->trip_distance + $routes[1]->trip_distance;
$totalTripDurationByTimeWaiting = $routes[0]->route_duration_sec + $routes[1]->route_duration_sec;
$totalTripWaitingTimeByTimeWaiting = $routes[0]->total_wait_time + $routes[1]->total_wait_time;

echo "Generated an optimization with the <b>waiting time</b> priority fine-tuning:<br>";
echo "   Total Trip Distance:     $totalTripDistanceByTimeWaiting <br>";
echo "   Total Trip Duration:     $totalTripDurationByTimeWaiting <br>";
echo "   Total Trip Waiting Time: $totalTripWaitingTimeByTimeWaiting <br><br><br>";

//endregion
