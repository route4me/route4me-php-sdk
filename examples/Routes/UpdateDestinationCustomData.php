<?php
namespace Route4Me;

$root=realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Route4Me;
use Route4Me\Route;

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Set the api key in the Route4Me class
Route4Me::setApiKey('11111111111111111111111111111111');

// Example refers to the process of set custom data of an address

$route=new Route();

// Get a random route ID
$route_id=$route->getRandomRouteId(0, 10);
assert(!is_null($route_id), "Can't retrieve a random route ID");

// Get random address's id from selected route above
//--------------------------------------------------------
$addressRand=(array)$route->GetRandomAddressFromRoute($route_id);

echo "Route ID -> $route_id, Route destination ID -> " . $addressRand['route_destination_id'] . "<br><br>";

$route->route_id = $route_id;
$route->route_destination_id = $addressRand['route_destination_id'];

// Update destination custom data
$route->parameters = new \stdClass();

$route->parameters->custom_fields = array(
        "animal"  => "tiger",
        "bird"    => "canary"
);

$route->httpheaders = 'Content-type: application/json';

$result=$route->updateAddress();

var_dump($result);
