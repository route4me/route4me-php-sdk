<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Set the api key in the Route4Me class
Route4Me::setApiKey(Constants::API_KEY);

// Get random route ID
$route = new Route();
$route_id = $route->getRandomRouteId(0, 10);

assert(!is_null($route_id), "Cannot retrieve random route_id");

// Get random address's id from selected route above
$addressRand = (array) $route->GetRandomAddressFromRoute($route_id);
$route_destination_id = $addressRand['route_destination_id'];

assert(!is_null($route_destination_id), "Cannot retrieve random address");

// Add an address note
$noteParameters = [
    'route_id'          => $route_id,
    'address_id'        => $route_destination_id,
    'dev_lat'           => $addressRand['lat'],
    'dev_lng'           => $addressRand['lng'],
    'device_type'       => 'web',
    'strUpdateType'     => 'dropoff',
    'strNoteContents'   => 'Test',
];

$addressNote = new AddressNote();

echo "route_id = $route_id <br>";
echo "route_destination_id = $route_destination_id <br><br>";

$address1 = $addressNote->AddAddressNote($noteParameters);

Route4Me::simplePrint((array) $address1, true);
