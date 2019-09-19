<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Set the api key in the Route4Me class
Route4Me::setApiKey('51d0c0701ce83855c9f62d0440096e7c');

$optimizationParameters = [
    'start_date' => '2019-10-15',
    'end_date' => '2019-10-20'
];

$optimizationProblem = new OptimizationProblem();

$optimizations = $optimizationProblem->get($optimizationParameters);

foreach ($optimizations as $optimization) {
    echo 'Optimization problem ID -> '.$optimization->optimization_problem_id.'<br>';
}
