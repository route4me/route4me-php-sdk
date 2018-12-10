<?php
namespace Route4Me;

$root=realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Route4Me;
use Route4Me\Route;
use Route4Me\Address;

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Set the api key in the Route4Me class
Route4Me::setApiKey('11111111111111111111111111111111');

$route=new Route();

// Select a route with more than 4 addresses.
$routesParams = array(
    "offset"  =>  0,
    "limit"   =>  20
);

$routes = $route->getRoutes(null,$routesParams);

$selectedRoute= null;

foreach ($routes as $route1) {
	if (isset($route1->destination_count)) {
	    if ($route1->destination_count>4) {
	        $selectedRoute = $route->getRoutes($route1->route_id);
            break;
	    }
	}
}

assert(!is_null($selectedRoute), "Can't select a route with more than 4 addresses");

// Resequence a route destination 
$routeID = $selectedRoute->route_id;
$routeDestinationID = $selectedRoute->addresses[2]->route_destination_id;

echo "Route ID-> $routeID, Route destination ID -> $routeDestinationID <br>"; 

$params = array(
    "route_id"              => $routeID,
    "route_destination_id"  => $routeDestinationID,
    "addresses"  => array(
        "0" => array(
            "route_destination_id"  => $routeDestinationID,
            "sequence_no"  => 3
        )
    )
);

$resequence=$route->resequenceRoute($params);

foreach ((array)$resequence as $key => $addresses) {
    echo "key=$key.<br>";
    if ($key=="addresses") {
        foreach ($addresses as $key1 => $address) {
            if (isset($address['route_destination_id'])) {
                echo "route_destination_id=".$address['route_destination_id']."<br>";
            }
            if (isset($address['lat'])) {
                echo "lat=".$address['lat']."<br>";
            }
            if (isset($address['lng'])) {
                echo "lng=".$address['lng']."<br>";
            }
        }
    }
    
    echo "<br>";
}

Route4Me::simplePrint($resequence);
