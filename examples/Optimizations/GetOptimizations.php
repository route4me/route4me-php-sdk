<?php
	namespace Route4me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4me\Route4me;
	use Route4me\Route;
	
	// Set the api key in the Route4me class
	Route4me::setApiKey('11111111111111111111111111111111');
	
	$routeParameters = array(
		'limit'  =>  10,
		'offset' =>  5
	);
	
	$optimizationProblem = new OptimizationProblem();
	
	$optimizations = $optimizationProblem->get($routeParameters);
	
	foreach ($optimizations as $optimization) {
		Route4me::simplePrint((array)$optimization);
		echo "=============================================<br>";
	}
	
?>