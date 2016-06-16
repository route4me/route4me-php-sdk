<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4me\Route;
	
	// Set the api key in the Route4Me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	$routeParameters = array(
		'limit'  =>  10,
		'offset' =>  5
	);
	
	$optimizationProblem = new OptimizationProblem();
	
	$optimizations = $optimizationProblem->get($routeParameters);
	
	foreach ($optimizations as $optimization) {
		Route4Me::simplePrint((array)$optimization);
		echo "=============================================<br>";
	}
	
?>