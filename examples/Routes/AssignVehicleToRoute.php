<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Set the api key in the Route4Me class
Route4Me::setApiKey(Constants::API_KEY);

// Example refers to the process of assigning a vehicle to a route.

$vehicle = new Vehicle();

$vehicleParameters = [
    'with_pagination'   => true,
    'page'              => 1,
    'perPage'           => 10,
];

$response = $vehicle->getVehicles($vehicleParameters);

$randomIndex = rand(0, 9);

$vehicleId = $response['data'][$randomIndex]['vehicle_id'];

$route = new Route();

// Get a random route ID
$routeId = $route->getRandomRouteId(0, 10);

assert(!is_null($routeId), "Cannot retrieve a random route ID");

// Update the route parameters
$route->route_id = $routeId;

$route->parameters = new \stdClass();

$route->parameters = [
    'vehicle_id' => $vehicleId,
];

$route->httpheaders = 'Content-type: application/json';

$route->update();

$route = new Route();

$assignedRoute= $route->getRoutes(['route_id' => $routeId]);

Route4Me::simplePrint((array)$assignedRoute->vehicle, true);
