<?php
namespace Route4Me;

$root = realpath(dirname(__FILE__) . '/../../');
require $root . '/vendor/autoload.php';

use Route4Me\Route4Me;
use Route4Me\Route;
use Route4Me\Address;

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Set the api key in the Route4Me class
Route4Me::setApiKey('11111111111111111111111111111111');

// Get random route ID
$route=new Route();
$routeId=$route->getRandomRouteId(0, 10);

assert(!is_null($routeId), "can't retrieve random route_id");

//--------------------------------------------------------

// Get random address's id from selected route above
//--------------------------------------------------------
$addressRand=(array)$route->GetRandomAddressFromRoute($routeId);

if (isset($addressRand['is_depot']))
{
    if ($addressRand['is_depot'])
    {
        echo "Random choosed address is depot, it can't be marked!.. Try again.";
        return;
    }
}

// Get random address's id from selected route above
$addressRand=(array)$route->GetRandomAddressFromRoute($routeId);
$route_destination_id=$addressRand['route_destination_id'];

assert(!is_null($route_destination_id), "can't retrieve random address");

//--------------------------------------------------------

$addressParameters=(array)Address::fromArray(array(
    "route_id"              => $routeId,
    "route_destination_id"  => $route_destination_id,
));

$body= array(
    "is_departed"  => TRUE,
);

$address=new Address();

$result=$address->markAddress($addressParameters, $body);

Route4Me::simplePrint($result);
