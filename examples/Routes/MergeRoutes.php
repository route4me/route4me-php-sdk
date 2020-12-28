<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Set the api key in the Route4Me class
// This example not available for demo API key
Route4Me::setApiKey(Constants::API_KEY);

$route = new Route();

// Get 2 different random route IDs
$route_id1 = $route->getRandomRouteId(0, 20);
assert(!is_null($route_id1), "Cannot retrieve a random route ID");

$route_id2 = $route_id1;

$count = 0;

while ($route_id1 == $route_id2) {
    $route_id2 = $route->getRandomRouteId(0, 20);

    ++$count;

    if ($count > 5) {
        break;
    }
}

echo "Route ID 1 -> $route_id1 <br> Route ID 2 -> $route_id2 <br>";

// Get the depot address from first route
$addresses = $route->GetAddressesFromRoute($route_id1);
assert(!is_null($addresses), "Cannot retrieve the addresses from the route");

$depot = null;

foreach ($addresses as $address) {
    if (isset($address->is_depot)) {
        if (true == $address->is_depot) {
            $depot = $address;
            break;
        }
    }
}

// Merge the selected routes
$params = [
    'route_ids'     => $route_id1.','.$route_id2,
    'depot_address' => $depot->address,
    'remove_origin' => false,
    'depot_lat'     => $depot->lat,
    'depot_lng'     => $depot->lng,
];

$result = $route->mergeRoutes($params);

var_dump($result);
