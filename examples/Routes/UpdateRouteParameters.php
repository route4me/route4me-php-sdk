<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Set the api key in the Route4Me class
Route4Me::setApiKey('11111111111111111111111111111111');

// Example refers to the process of updating the parameters of a route

$route = new Route();

// Get a random route ID
$route_id = $route->getRandomRouteId(0, 10);
assert(!is_null($route_id), "Cannot retrieve a random route ID");

$randomRoute = $route->getRoutes(['route_id' => $route_id]);
assert(!is_null($randomRoute), "Cannot retrieve a random route ID");

// Update the route parameters
$route->route_id = $route_id;

$route->parameters = new \stdClass();

$route->parameters = [
    'member_id' => $randomRoute->member_id,
    'optimize' => 'Distance',
    'route_max_duration' => '82400',
    'route_name' => 'updated '.date('m-d-Y'),
];

$route->httpheaders = 'Content-type: application/json';

$result = $route->update();

Route4Me::simplePrint((array) $result->parameters);
