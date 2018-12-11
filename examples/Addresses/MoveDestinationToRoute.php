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

$route = new Route();

$grParams = array(
    'offset' => 0,
    'limit'  => 10
);

$routes = $route->getRoutes(null, $grParams);
assert(!is_null($routes), "There are no routes in the account for this example. Please, create at last two routes first.");
assert(sizeof($routes)>1, "This example requires at last 2 routes. Please, create them first.");

// Get random source route from test routes
$route = new Route();

$route_id0 = $routes[rand(0, sizeof($routes)-1)]->route_id;

echo "<br> From the route -> " . $route_id0 ."<br>";

if (is_null($route_id0)) {
    echo "can't retrieve random route_id!.. Try again.";
    return;
}

// Get random source destination from selected source route above
$addressRand=(array)$route->GetRandomAddressFromRoute($route_id0);
$route_destination_id=$addressRand['route_destination_id'];

assert(!is_null($route_destination_id), "Can't retrieve random address.");

echo "move destination = $route_destination_id <br>";

// Get random destination route from test routes
$to_route_id = $route_id0;

while ($to_route_id == $route_id0) {
    $to_route_id = $routes[rand(0, sizeof($routes)-1)]->route_id;
}

echo "<br> to the route -> " . $to_route_id ."<br>";

if (is_null($to_route_id)) {
    echo "can't retrieve random route_id!.. Try again.";
    return;
}

// Get random destination destination from selected source route above
$addressRand2 = (array)$route->GetRandomAddressFromRoute($to_route_id);

$after_destination_id = $addressRand2['route_destination_id'];

if (is_null($after_destination_id)) {
    echo "can't retrieve random address!.. Try again.";
    return;
}

echo "after_destination_id = $after_destination_id <br>";

// Move the destination to the route     
$routeparams = array(
    'to_route_id'           =>  $to_route_id,
    'route_destination_id'  =>  strval($route_destination_id),
    'after_destination_id'  =>  strval($after_destination_id)
);

$address = new Address();
$result = $address->moveDestinationToRoute($routeparams);

var_dump($result);
