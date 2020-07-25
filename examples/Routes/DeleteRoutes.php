<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Set the api key in the Route4Me class
Route4Me::setApiKey(Constants::API_KEY);

$route = new Route();

// Get 2 random route IDs
$randomRouteID1 = $route->getRandomRouteId(0, 25);
assert(!is_null($randomRouteID1), "Cannot retrieve 1st random route ID");

$randomRouteID2 = $route->getRandomRouteId(0, 25);
assert(!is_null($randomRouteID2), "Cannot retrieve 2nd random route ID");

echo "Random route ID 1 -> $randomRouteID1 <br>  Random route ID 2 -> $randomRouteID2 <br>";

// Remove selected routes
$route_ids = join(',', [$randomRouteID1, $randomRouteID2]);

$result = $route->deleteRoutes($route_ids);

Route4Me::simplePrint($result);
