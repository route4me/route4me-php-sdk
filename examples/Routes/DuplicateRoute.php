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

$route=new Route();

// Get random route ID
$randomRouteID = $route->getRandomRouteId(0, 25);
assert(!is_null($randomRouteID), "Can't retrieve a random route ID");

// Duplicate the selected route
$routeDuplicate=$route->duplicateRoute($randomRouteID);

Route4Me::simplePrint($routeDuplicate);
