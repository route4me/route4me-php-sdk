<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Set the api key in the Route4Me class
Route4Me::setApiKey(Constants::API_KEY);

$route = new Route();

// Get a random route ID
$route_id = $route->getRandomRouteId(0, 10);
assert(!is_null($route_id), "Cannot retrieve a random route ID");

// Share a route with an email
$params = [
    'route_id' => $route_id,
    'response_format' => 'json',
    'recipient_email' => 'rrrrrrrrrrrrrrrr+share1234@gmail.com',
];

$result = $route->shareRoute($params);

var_dump($result);
