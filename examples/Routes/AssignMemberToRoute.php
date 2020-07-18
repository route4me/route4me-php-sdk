<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Set the api key in the Route4Me class
Route4Me::setApiKey('11111111111111111111111111111111');

// Example refers to the process of assigning a member to a route.

$member = new Member();

$users = $member->getUsers();

assert(!is_null($users), 'Cannot retrieve list of the users');
assert(2 == sizeof($users), 'Cannot retrieve list of the users');
assert(isset($users['results']), 'Cannot retrieve list of the users');
assert(isset($users['total']), 'Cannot retrieve list of the users');

$randIndex = rand(0, $users['total'] - 1);

$randomUserID = $users['results'][$randIndex]['member_id'];
echo "Random member_id -> $randomUserID <br>";

$route = new Route();

// Get a random route ID
$routeId = $route->getRandomRouteId(0, 10);

assert(!is_null($routeId), "Cannot retrieve a random route ID");

// Update the route parameters
$route->route_id = $routeId;

$route->parameters = new \stdClass();

$route->parameters = [
    'member_id' => $randomUserID,
];

$route->httpheaders = 'Content-type: application/json';

$route->update();

$route = new Route();

$assignedRoute= $route->getRoutes(['route_id' => $routeId]);

echo "Assigned member id -> ".$assignedRoute->parameters->{'member_id'};

