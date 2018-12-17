<?php
namespace Route4Me;

$root=realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Route4Me;
use Route4Me\Route;

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Set the api key in the Route4Me class
Route4Me::setApiKey('11111111111111111111111111111111');

// Example refers to the process of recomputing the route directions.

$route = new Route();

// Get a random route ID
$route_id = $route->getRandomRouteId(0, 10);
assert(!is_null($route_id), "Can't retrieve a random route ID");

$randomRoute = $route->getRoutes($route_id, null);
assert(!is_null($randomRoute), "Can't retrieve a random route ID");

// Recompute the route directions
$route->route_id = $route_id;

$route->parameters = new \stdClass();

$route->parameters = array( 
    "recompute_directions" => 1
);

$route->httpheaders = 'Content-type: application/json';

$result = $route->update();

Route4Me::simplePrint((array)$result->parameters);
