<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// The example refers to logging of a specific message directly to Activity Feed

// Set the api key in the Route4me class
Route4Me::setApiKey('11111111111111111111111111111111');

// Get random route ID
$route = new Route();
$route_id = $route->getRandomRouteId(0, 10);

$postParameters = ActivityParameters::fromArray([
    'activity_type' => 'user_message',
    'activity_message' => 'Hello - php!',
    'route_id' => $route_id,
]);

$activities = new ActivityParameters();

$results = $activities->sendUserMessage($postParameters);

$msg = null != isset($results['status'])
  ? (1 == $results['status'] ? 'The user message was sent to the route ' : 'he user message could not sent to the route ')
   : 'The user message could not sent to the route ';

$msg .= ' with route_id='.$route_id;

echo "<br> $msg <br>";
