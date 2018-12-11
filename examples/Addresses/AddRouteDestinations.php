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
$routeId = $route->getRandomRouteId(0, 10);

assert(!is_null($routeId), "can't retrieve random route_id");

// Add the destinations to the route
$addresses = array();

$address1 = (array)Address::fromArray(array(
    'address'   =>  '146 Bill Johnson Rd NE Milledgeville GA 31061',
    'lat'       =>  33.143526,
    'lng'       =>  -83.240354,
    'time'      =>  0
));

$address2 = (array)Address::fromArray(array(
    'address'   =>   '222 Blake Cir Milledgeville GA 31061',
    'lat'       =>   33.177852,
    'lng'       =>   -83.263535,
    'time'      =>   0
));

$addresses[] = $address1; 
$addresses[] = $address2;

$routeParameters = array(
    "route_id"  =>  $routeId,
    "addresses" => array($address1, $address2)
);

$route1 = new Route();

$route1->httpheaders = 'Content-type: application/json';

$result = $route1->addAddresses($routeParameters);

Route4Me::simplePrint((array)$result);
