<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Set the api key in the Route4Me class
Route4Me::setApiKey(Constants::API_KEY);

// Get random route ID
$route = new Route();
$routeId = $route->getRandomRouteId(0, 10);

assert(!is_null($routeId), "Cannot retrieve random route_id");

// Get random address's id from selected route above
$addressRand = (array) $route->GetRandomAddressFromRoute($routeId);
$optimization_problem_id = $addressRand['optimization_problem_id'];

assert(!is_null($optimization_problem_id), "Cannot retrieve random address");

// Add an address to the optimization
$addresses = [];

$address1 = (array) Address::fromArray([
    'address'   => '717 5th Ave New York, NY 10021',
    'alias'     => 'Giorgio Armani',
    'lat'       => 40.7669692,
    'lng'       => 73.9693864,
    'time'      => 0,
]);

$addresses[0] = $address1;

$OptimizationParameters = (array) OptimizationProblem::fromArray([
    'optimization_problem_id'   => $optimization_problem_id,
    'addresses'                 => $addresses,
    'reoptimize'                => 1,
]);

$optimizationProblem = new OptimizationProblem();

$result = $optimizationProblem->update($OptimizationParameters);

Route4Me::simplePrint($result);
