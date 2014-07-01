<?php
require __DIR__.'/../vendor/autoload.php';;

use Route4me\Route4me;
use Route4me\OptimizationProblem;

Route4me::setApiKey('11111111111111111111111111111111');

$problemId = 'F2FEA85DA7EFCE180CAD70704816347A';
$problem = OptimizationProblem::reoptimize($problemId);

var_dump($problem);
