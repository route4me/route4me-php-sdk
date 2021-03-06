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
$routeId = $route->getRandomRouteId(0, 10);

assert(!is_null($routeId), "Cannot retrieve random route_id");

// Get random address's id from the above selected route
$addressRand = (array) $route->GetRandomAddressFromRoute($routeId);
$route_destination_id = $addressRand['route_destination_id'];

assert(!is_null($route_destination_id), "Cannot retrieve random address");

// Add a custom note to a route
$noteParameters = [
    'route_id'              => $routeId,
    'address_id'            => $route_destination_id,
    'format'                => 'json',
    'dev_lat'               => $addressRand['lat'],
    'dev_lng'               => $addressRand['lng'],
    'custom_note_type[11]'  => 'slippery',
    'custom_note_type[10]'  => 'Backdoor',
    'strUpdateType'         => 'dropoff',
    'strNoteContents'       => 'test1111',
];

$addressNote = new AddressNote();

$response = $addressNote->addCustomNoteToRoute($noteParameters);

Route4Me::simplePrint($response);
