<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Set the api key in the Route4Me class
Route4Me::setApiKey(Constants::API_KEY);

$RouteParameters = [
    'start_date' => '2019-08-01',
    'end_date'   => '2019-08-05'
];

$route = new Route();

$routeResults = $route->getRoutes($RouteParameters);

foreach ($routeResults as $routeResult) {
    $results = (array) $routeResult;

    Route4Me::simplePrint($results);

    echo '<br>';
}