<?php
namespace Route4Me;

$root=realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Route4Me;
use Route4Me\OptimizationProblem;
use Route4Me\Order;

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Example refers to adding of an order to an optimization.

// Set the api key in the Route4me class
// This example not available for demo API key
Route4Me::setApiKey('11111111111111111111111111111111');

// Get random optimization problem ID
$optimization = new OptimizationProblem();

$optimizationProblemId=$optimization->getRandomOptimizationId(0, 10);

assert(!is_null($optimizationProblemId), "Can't retrieve a random optimization problem ID");

// Add an order to an optimization
$orderParameters=array(
    "optimization_problem_id" => $optimizationProblemId,
    "redirect"                => 0,
    "device_type"             => "web",
);

$jfile = file_get_contents("add_order_to_optimization_data.json");

$body = json_decode($jfile);

$order = new Order();

$response = $order->addOrder2Optimization($orderParameters,$body);

Route4Me::simplePrint($response);
