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

// The example refers to the process of getting a route with the encoded & compressed path points.

// Get a route with the path points
$params = [
    'route_path_output' => 'Points',
    'compress_path_points' => true,
    'route_id' => $route_id,
];

$routeResults = (array) $route->getRoutePoints($params);

if (isset($routeResults['addresses'])) {
    foreach ($routeResults['addresses'] as $key => $address) {
        $arAddress = (array) $address;

        if (isset($araddress['route_destination_id'])) {
            echo 'route_destination_id='.$arAddress['route_destination_id'].'<br>';
        }

        if (isset($arAddress['path_to_next'])) {
            echo 'path_to_next:<br>';
            Route4Me::simplePrint((array) $arAddress['path_to_next']);
        }

        echo '<br>';
    }
}
