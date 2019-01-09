<?php
namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Route4Me;
use Route4Me\Route;
use Route4Me\Enum\ActivityTypes;

// Example refers to get activities on the specified route by activity_type parameter.

// Set the api key in the Route4Me class
Route4Me::setApiKey('11111111111111111111111111111111');

$activityTypes = new ActivityTypes();

// Get random route ID
$route = new Route();
$route_id = $route->getRandomRouteId(0, 10);
echo "route_id -> $route_id <br>"; $count=0;
// Itereate through all the existing activity types
foreach ($activityTypes->getConstants() as $prop => $value) {
    $activityParameters = ActivityParameters::fromArray(array(
        "activity_type" => $value,
        "limit"         => 2,
        "offset"        => 0,
        "route_id"      => $route_id
    ));
    
    $activities = new ActivityParameters();
    $results = $activities->searcActivities($activityParameters);
    
    if (!is_array($results) || !is_array($results['results']) || sizeof($results['results'])<1) {
        continue;
    }
    
    $count++; echo "count -> $count <br>";
    foreach ($results as $key => $activity) {
        Route4Me::simplePrint($activity);
        echo "<br>";
    }
    
    echo "------------------- <br><br>";
}
