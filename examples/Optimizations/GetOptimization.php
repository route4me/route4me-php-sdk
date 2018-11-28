<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\Route;
	
	// Set the api key in the Route4Me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	// Get random route from test routes
	//--------------------------------------------------------
	$route=new Route;
	
	$route_id=$route->getRandomRouteId(0, 10);
	
	if (is_null($route_id)) {
		echo "can't retrieve random route_id!.. Try again.";
		return;
	}
	
	$route=$route->getRoutes($route_id,null);
	
	$optimizationProblemId=$route->getOptimizationId();
	
	echo "route_id = $route_id<br>";
	echo "optimization_problem_id = $optimizationProblemId <br><br>";
	
	$optimizationProblemParams = array(
		"optimization_problem_id"  =>  $optimizationProblemId
	);
	
	$optimizationProblem = new OptimizationProblem();
	
	$optimizationProblem = $optimizationProblem->get($optimizationProblemParams);
	
	foreach ((array)$optimizationProblem as $probParts)
	{
		Route4Me::simplePrint((array)$probParts);	
	}
	
?>