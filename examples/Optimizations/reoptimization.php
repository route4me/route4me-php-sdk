<?php
namespace Route4me;

$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

require $vdir.'/../vendor/autoload.php';

use Route4me\OptimizationProblem;
use Route4me\Route;
use Route4me\Route4me;

Route4me::setApiKey('11111111111111111111111111111111');

// Get random route from test routes
	//--------------------------------------------------------
	$route=new Route();
	
	$route_id=$route->getRandomRouteId(10, 20);
	
	if (is_null($route_id)) {
		echo "can't retrieve random route_id!.. Try again.";
		return;
	}
	
	$route=$route->getRoutes($route_id,null);
	
	$optimizationProblemId=$route->getOptimizationId();
	
	$problemParams = array(
		'optimization_problem_id'  =>  $optimizationProblemId
	);
	$problem = OptimizationProblem::reoptimize($problemParams);
	
	Route4me::simplePrint($problem);

?>
