<?php
namespace Route4Me;

$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

require $vdir.'/../vendor/autoload.php';

use Route4Me\OptimizationProblem;
use Route4Me\Route;
use Route4Me\Route4Me;

Route4Me::setApiKey('11111111111111111111111111111111');

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
	
	Route4Me::simplePrint($problem);

?>
