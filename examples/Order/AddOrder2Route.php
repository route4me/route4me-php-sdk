<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Example refers to adding of an order to a route.

// Set the api key in the Route4me class
Route4Me::setApiKey('11111111111111111111111111111111');

// Get random route ID
$route = new  Route();

$routeID = $route->getRandomRouteId(0, 10);

assert(!is_null($routeID), "Cannot retrieve a random route ID");

// Add an order to a route

$jFile = file_get_contents('add_order_to_route_data.json');

$body = json_decode($jFile);

$orderParameters = Order::fromArray([
    'route_id' => $routeID,
    'redirect' => 0,
    'addresses' => $body->addresses,
]);

$order = new Order();

$response = $order->addOrder2Route($orderParameters);

Route4Me::simplePrint($response, true);
