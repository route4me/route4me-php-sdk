<?php
namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Route4Me;
use Route4Me\Address;
use Route4Me\OptimizationProblem;

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Set the api key in the Route4Me class
Route4Me::setApiKey('11111111111111111111111111111111');

// Get random optimization problem from test optimization problems
$optimization = new OptimizationProblem();

$optimization_problem_id = $optimization->getRandomOptimizationId(0, 10);

assert(!is_null($optimization_problem_id), "Can't retrieve random optimization_problem_id");

// Get random destination from selected optimization above
$addressRand = (array)$optimization->getRandomAddressFromOptimization($optimization_problem_id);

assert(!is_null($addressRand), "Can't retrieve random address");

if (isset($addressRand['is_depot'])) {
    if ($addressRand['is_depot']) {
        echo "This address is depot!.. Try again.";
        return;
    }
}

$route_destination_id = $addressRand['route_destination_id'];

assert(!is_null($route_destination_id), "Can't retrieve random address");

// Remove the destination from the optimization
$params = array (
    "optimization_problem_id"  => $optimization_problem_id,
    "route_destination_id"     => $route_destination_id
);

$result = $optimization->removeAddress($params);

var_dump($result);
