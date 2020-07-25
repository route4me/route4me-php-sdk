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

// The example refers to the process of creating new optimization with callback url.

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

// Huge list of addresses
$json = json_decode(file_get_contents('./addresses_md_tw.json'), true);
$json = array_slice($json, 0, 10);

$addresses = [];

foreach ($json as $address) {
    $addresses[] = Address::fromArray($address);
}

$parameters = RouteParameters::fromArray([
    'route_name' => 'Oprimization Without FineTuning. '.date('Y-m-d H:i'),
    'algorithm_type' => AlgorithmType::CVRP_TW_SD,
    'distance_unit' => DistanceUnit::MILES,
    'device_type' => DeviceType::WEB,
    'optimize' => OptimizationType::DISTANCE,
    'metric' => Metric::GEODESIC,
    'route_max_duration' => 86400 * 2,
    'travel_mode' => TravelMode::DRIVING,
    'vehicle_capacity' => 50,
    'vehicle_max_distance_mi' => 10000,
    'parts' => 50,

]);

$optimizationParams = new OptimizationProblemParams();
$optimizationParams->setAddresses($addresses);
$optimizationParams->setParameters($parameters);

$problems = OptimizationProblem::optimize($optimizationParams);

$route=$problems->getRoutes()[0];

$routeId = $problems->getRoutes()[0]->route_id;
assert(!is_null($routeId), "Cannot get route ID");

//region Route With Duration Priority FineTuning
$duplicateResult1 = $route->duplicateRoute([$routeId]);

assert(is_array($duplicateResult1), "Cannot duplicate the route<br>");

if (!$duplicateResult1['status'] || sizeof($duplicateResult1['route_ids'])<1) die("Cannot duplicate the route<br>");

$duplicatedRouteId1 = $duplicateResult1['route_ids'][0];

$duplicatedRoute = $route->getRoutes(['route_id' => $duplicatedRouteId1]);
assert($duplicatedRoute instanceof Route,'Cannot get the duplicated route.');

$duplicatedRoute->parameters = new \stdClass();

$duplicatedRoute->parameters = [
    'target_duration' => 100,
    'target_distance' => 1,
    'target_wait_by_tail_size' => 1,
    'route_name' => 'Oprimization With Duration Priority FineTuning. '.date('m-d-Y')
];

$duplicatedRoute->httpheaders = 'Content-type: application/json';

$result1 = $duplicatedRoute->update();

assert($result1 instanceof Route,'Cannot fine-tune the route with the duration priority.');

$tripDistance1 = $result1->trip_distance;
$routeDurationSec1 = $result1->route_duration_sec;

echo "tripDistance1: $tripDistance1 <br>";
echo "routeDurationSec1: $routeDurationSec1 <br>";

//die("STOP <br>");
//endregion

//region Route With Distance Priority FineTuning
$duplicateResult2 = $route->duplicateRoute([$routeId]);

assert(is_array($duplicateResult2), "Cannot duplicate the route<br>");

if (!$duplicateResult2['status'] || sizeof($duplicateResult2['route_ids'])<1) die("Cannot duplicate the route<br>");

$duplicatedRouteId2 = $duplicateResult2['route_ids'][0];

$duplicatedRoute2 = $route->getRoutes(['route_id' => $duplicatedRouteId2]);
assert($duplicatedRoute2 instanceof Route,'Cannot get the duplicated route.');

$duplicatedRoute2->parameters = new \stdClass();

$duplicatedRoute2->parameters = [
    'target_duration' => 1,
    'target_distance' => 100,
    'target_wait_by_tail_size' => 1,
    'route_name' => 'Oprimization With Distance Priority FineTuning. '.date('m-d-Y')
];

$duplicatedRoute2->httpheaders = 'Content-type: application/json';

$result2 = $duplicatedRoute2->update();

assert($result2 instanceof Route,'Cannot fine-tune the route with the duration priority.');

$tripDistance2 = $result2->trip_distance;
$routeDurationSec2 = $result2->route_duration_sec;

echo "tripDistance2: $tripDistance2 <br>";
echo "routeDurationSec2: $routeDurationSec2 <br>";
//endregion


echo "Route ID: ".$problems->getRoutes()[0]->route_id.'<br>';
foreach ($problems as $problem) {

    //Route4Me::simplePrint($problem, true);
}
