<?php
namespace Route4Me;

$root=realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Route4Me;
use Route4Me\Route;

// Set the api key in the Route4Me class
Route4Me::setApiKey('11111111111111111111111111111111');

// The example refers to the process of searching for the specified text throughout all routes, belonging to the user's account.

$RouteParameters = array(
    "query"   => 'Automated'
);

$route = new Route();

$routeResults = $route->getRoutes($RouteParameters);

foreach ($routeResults as $routeResult)
{
    $results = (array)$routeResult;
    
    if (isset($results['route_id'])) echo "Route ID - > " . $results['route_id'] . "<br>";
    
    if (isset($results['parameters']->route_name)) echo "Route name - > ".$results['parameters']->route_name."<br>";

    echo "<br>";
}
