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

// The example refers to the process of updating a route destination

$route = new Route();

// Get a random route ID
$route_id = $route->getRandomRouteId(0, 10);
assert(!is_null($route_id), "Can't retrieve a random route ID");

// Get a random address ID from selected route above
$addressRand = (array)$route->GetRandomAddressFromRoute($route_id);

$route->route_id = $route_id;
$route->route_destination_id = $addressRand['route_destination_id'];

// Update the route destination
$route->parameters = new \stdClass();

$route->addresses = array( Address::fromArray(array(
    "alias"                   =>  "new address alias",
    "first_name"              =>  "Edi",
    "last_name"               =>  "Jacobson",
    "address"                 =>  "230 Arbor Way Milledgeville GA 31061",
    "is_depot"                =>  false,
    "lat"                     =>  33.129695892334,
    "lng"                     =>  -83.24577331543,
    "sequence_no"             =>  9,
    "is_visited"              =>  true,
    "is_departed"             =>  false,
    "timestamp_last_visited"  =>  36000,
    "timestamp_last_departed" =>  null,
    "customer_po"             =>  "po_131324566",
    "invoice_no"              =>  "in549874",
    "reference_no"            =>  "7988544",
    "order_no"                =>  "on654754",
    "order_id"                =>  4564,
    "weight"                  =>  45,
    "cost"                    =>  55.60,
    "revenue"                 =>  75.80,
    "cube"                    =>  3,
    "pieces"                  =>  30,
    "email"                   =>  "ejacob111@yahoo.com",
    "phone"                   =>  "111-222-333",
    "time_window_start"       =>  36600,
    "time_window_end"         =>  37200,
    "time"                    =>  600,
    "priority"                =>  1,
    "curbside_lat"            =>  33.129695892334,
    "curbside_lng"            =>  -83.24577331543,
    "time_window_start_2"     =>  39400,
    "time_window_end_2"       =>  40000
)));

$route->httpheaders = 'Content-type: application/json';

$result = $route->updateAddress();

Route4Me::simplePrint($result);
