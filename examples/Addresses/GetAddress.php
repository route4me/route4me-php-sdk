<?php
namespace Route4Me;

$root = realpath(dirname(__FILE__) . '/../../');
require $root . '/vendor/autoload.php';

use Route4Me\Route4Me;
use Route4Me\Route;

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Set the api key in the Route4Me class
Route4Me::setApiKey('11111111111111111111111111111111');

// Get random route ID
$route = new Route();
$routeId = $route->getRandomRouteId(0, 10);

assert(!is_null($routeId), "Can't retrieve random route_id");

// Get random address's id from selected route above
$addressRand = (array)$route->GetRandomAddressFromRoute($routeId);
$route_destination_id = $addressRand['route_destination_id'];

assert(!is_null($route_destination_id), "Can't retrieve random address");

// Get the address by route_destination_id
$address = new Address();

$addressRetrieved = $address->getAddress($routeId, $route_destination_id);

Route4Me::simplePrint((array)$addressRetrieved);
