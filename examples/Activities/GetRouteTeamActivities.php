<?php
namespace Route4Me;

$root = realpath(dirname(__FILE__) . '/../../');
require $root.'/vendor/autoload.php';

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

$activityParameters = ActivityParameters::fromArray(array(
    "route_id"    => $routeId,
    "team"        => "true"
));

$activities = new ActivityParameters();
$actresults = $activities->getActivities($activityParameters);
$results = $activities->getValue($actresults,"results");

foreach ($results as $result) {
	Route4Me::simplePrint($result);
    echo "<br>";
}
