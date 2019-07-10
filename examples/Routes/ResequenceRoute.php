<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Set the api key in the Route4Me class
Route4Me::setApiKey('11111111111111111111111111111111');

$route = new Route();

// Select a route with more than 4 addresses.
$routesParams = [
    'offset' => 0,
    'limit' => 20,
];

$routes = $route->getRoutes($routesParams);

$selectedRoute = null;

foreach ($routes as $route1) {
    if (isset($route1->destination_count)) {
        if ($route1->destination_count > 4) {
            $selectedRoute = $route->getRoutes(['route_id' => $route1->route_id]);
            break;
        }
    }
}

assert(!is_null($selectedRoute), "Cannot select a route with more than 4 addresses");

// Resequence a route destination
$routeID = $selectedRoute->route_id;
$routeDestinationID = $selectedRoute->addresses[2]->route_destination_id;

echo "Route ID-> $routeID, Route destination ID -> $routeDestinationID <br>";

$params = [
    'route_id' => $routeID,
    'route_destination_id' => $routeDestinationID,
    'addresses' => [
        '0' => [
            'route_destination_id' => $routeDestinationID,
            'sequence_no' => 3,
        ],
    ],
];

$response = $route->resequenceRoute($params);

foreach ($response['addresses'] as $address) {
    Route4Me::simplePrint($address);
    echo '<br>';
}
