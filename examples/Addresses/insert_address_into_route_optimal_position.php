<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Example refers to the process of an address inserting into specified route's optimal position

// Set the api key in the Route4Me class
Route4Me::setApiKey(Constants::API_KEY);

// Get random route ID
$route = new Route();
$routeId = $route->getRandomRouteId(0, 10);

assert(!is_null($routeId), "Cannot retrieve random route_id");

// Insert the address into the route's optimal position
$addresses = [];

$params = [
    'route_id'  => $routeId,
    'addresses' => [
        '0' => [
            'address'       => 'Cabo Rojo, Cabo Rojo 00623, Puerto Rico',
            'alias'         => '',
            'lat'           => 18.086627,
            'lng'           => -67.145735,
            'curbside_lat'  => 18.086627,
            'curbside_lng'  => -67.145735,
            'is_departed'   => false,
            'is_visited'    => false,
        ],
    ],
    'optimal_position' => true,
];

$route1 = new Route();

$result = $route1->insertAddressOptimalPosition($params);

assert(!is_null($result), "Cannot insert a destination into the route");

echo " Route ID -> $routeId <br><br>";

assert(isset($result->addresses), "Cannot insert a destination into the route");

foreach ($result->addresses as $address) {
    echo 'Address -> '.$address->address, ', Sequence number -> '.$address->sequence_no.'<br>';
}
