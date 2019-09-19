<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Set the api key in the Route4Me class
Route4Me::setApiKey('11111111111111111111111111111111');

// Get random route from test routes
$route = new Route();

$route_id = $route->getRandomRouteId(0, 10);

assert(!is_null($route_id), "Cannot retrieve random route_id");

// Get random destination from selected route above
$addressRand = (array) $route->GetRandomAddressFromRoute($route_id);
$route_destination_id = $addressRand['route_destination_id'];

assert(!is_null($route_destination_id), "Cannot retrieve random address");

echo "route_destination_id = $route_destination_id <br>";

// Remove the destination from the route
$address = new Address();

$address->route_id = $route_id;
$address->route_destination_id = $route_destination_id;
$result = $address->deleteAddress();

var_dump($result);
