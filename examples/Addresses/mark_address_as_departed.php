<?php
namespace Route4Me;

$root = realpath(dirname(__FILE__) . '/../../');
require $root . '/vendor/autoload.php';

use Route4Me\Route4Me;
use Route4Me\Address;

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Set the api key in the Route4Me class
Route4Me::setApiKey('11111111111111111111111111111111');

// Get random route ID
$route = new Route();
$routeId = $route->getRandomRouteId(0, 10);

assert(!is_null($routeId), "can't retrieve random route_id");

// Get random address's id from selected route above
$addressRand = (array)$route->GetRandomAddressFromRoute($routeId);
$route_destination_id = $addressRand['route_destination_id'];

assert(!is_null($route_destination_id), "can't retrieve random address");

// Mark the address as deoarted
$address=new Address();

$params = array(
    "route_id"     => $routeId,
    "address_id"   => $route_destination_id,
    "is_departed"  => 1,
    "member_id"    => 1
);

$result = $address->markAsDeparted($params);

var_dump($result); 
