<?php
namespace Route4Me;

$root=realpath(dirname(__FILE__).'/../');
require $root.'/vendor/autoload.php';

use Route4Me\Route4Me;
use Route4Me\Route;

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

Route4Me::setApiKey('11111111111111111111111111111111');

$route = new Route();

// Get a random route ID
$route_id=$route->getRandomRouteId(0, 10);
assert(!is_null($route_id), "Can't retrieve a random route ID");

// Get route tracking
$routeId = $route_id;
$route = Route::getRoutes($routeId, array(
    'device_tracking_history' => true
));

var_dump($route->tracking_history);
