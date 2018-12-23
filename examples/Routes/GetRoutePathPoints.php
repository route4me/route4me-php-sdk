<?php
namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Route4Me;
use Route4Me\Route;

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Set the api key in the Route4Me class
Route4Me::setApiKey('11111111111111111111111111111111');

$route = new Route();

// Get a random route ID
$route_id = $route->getRandomRouteId(0, 10);
assert(!is_null($route_id), "Can't retrieve a random route ID");

// Note: not every optimization includes information about path points, only thus, which was generated with the parameter route_path_output = "Points"  

// Get a route with the path points
$params = array(
    "route_path_output" => "Points",
    "route_id"   => $route_id
);

$routeResults = (array)$route->getRoutePoints($params);

if (isset($routeResults['addresses'])) {
    foreach ($routeResults['addresses'] as $key => $address) {
        $araddress = (array)$address;

        if (isset($araddress['route_destination_id'])) {
            echo "route_destination_id=".$araddress['route_destination_id']."<br>";
        }

        if (isset($araddress['path_to_next'])) {
            echo "path_to_next:<br>";
            Route4Me::simplePrint($araddress['path_to_next']);
        }

        echo "<br>";
    }
}
