<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

Route4Me::setApiKey(Constants::API_KEY);

$route = new Route();

// Get a random route ID
$route_id = $route->getRandomRouteId(0, 10);
assert(!is_null($route_id), "Cannot retrieve a random route ID");

// Get route manifest
$params = [
    'directions' => 1,
    'route_id'   => $route_id,
];

$route = Route::getRoutes($params);

foreach ($route->addresses as $addr1) {
    Route4Me::simplePrint((array) $addr1, true);
    echo '<br>';
}
