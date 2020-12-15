<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Set the api key in the Route4Me class
Route4Me::setApiKey(Constants::API_KEY);

// The example refers to the process of unlinking a route from master optimization.

$route = new Route();

// Get a random route ID
$route_id = $route->getRandomRouteId(10, 10);
assert(!is_null($route_id), "Cannot retrieve a random route ID");

// Unlink a route from master destination.
$route->route_id = $route_id;
$route->parameters = new \stdClass();

$route->parameters = [
    'route_id' => $route_id,
    'unlink_from_master_optimization' => true,
];

$route->httpheaders = 'Content-type: application/json';

$result = $route->updateRoute($route->parameters);

Route4Me::simplePrint($result);
