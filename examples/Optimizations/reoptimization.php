<?php
namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\OptimizationProblem;
use Route4Me\Route4Me;

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

Route4Me::setApiKey('11111111111111111111111111111111');

// Get random optimization problem ID
$optimization = new OptimizationProblem();

$optimizationProblemId = $optimization->getRandomOptimizationId(0, 10);

assert(!is_null($optimizationProblemId), "Can't retrieve a random optimization problem ID");

// Reoptimize an optimization
$problemParams = array(
    'optimization_problem_id'  =>  $optimizationProblemId
);

$problem = OptimizationProblem::reoptimize($problemParams);

Route4Me::simplePrint($problem);
