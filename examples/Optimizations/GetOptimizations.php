<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Set the api key in the Route4Me class
Route4Me::setApiKey(Constants::API_KEY);

$routeParameters = [
    'limit'  => 5,
    'offset' => 0,
];

$optimizationProblem = new OptimizationProblem();

$optimizations = $optimizationProblem->get($routeParameters);

foreach ($optimizations as $optimization) {
    echo 'Optimization problem ID -> '.$optimization->optimization_problem_id.'<br>';
}
