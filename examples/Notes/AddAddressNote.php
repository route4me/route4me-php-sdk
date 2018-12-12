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

// Get random route ID
$route = new Route();
$route_id = $route->getRandomRouteId(0, 10);

assert(!is_null($route_id), "Can't retrieve random route_id");

// Get random address's id from selected route above
$addressRand = (array)$route->GetRandomAddressFromRoute($route_id);
$route_destination_id = $addressRand['route_destination_id'];

assert(!is_null($route_destination_id), "Can't retrieve random address");

// Add an address note
$noteParameters = array(
    "route_id"        => $route_id,
    "address_id"      => $route_destination_id,
    "dev_lat"         => 33.132675170898,
    "dev_lng"         => -83.244743347168,
    "device_type"     => "web",
    "strUpdateType"   => "dropoff",
    "strNoteContents" => "Test"
);

$address = new Address();

echo "route_id = $route_id <br>";
echo "route_destination_id = $route_destination_id <br><br>";

$address1 = $address->AddAddressNote($noteParameters);

Route4Me::simplePrint($address1);
