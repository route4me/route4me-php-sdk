<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Example refers to adding of an order to an optimization.

// Set the api key in the Route4me class
// This example not available for demo API key
Route4Me::setApiKey(Constants::API_KEY);

// Get random optimization problem ID
$optimization = new OptimizationProblem();

$optimizationProblemId = $optimization->getRandomOptimizationId(0, 10);

assert(!is_null($optimizationProblemId), "Cannot retrieve a random optimization problem ID");

// Add an order to an optimization

$jFile = file_get_contents('add_order_to_optimization_data.json');

$body = json_decode($jFile);

$orderParameters = [
    'optimization_problem_id'   => $optimizationProblemId,
    'redirect'                  => 0,
    'device_type'               => 'web',
    'addresses'                 => $body->addresses,
];

$order = new Order();

$response = $order->addOrder2Optimization($orderParameters);

Route4Me::simplePrint($response, true);
