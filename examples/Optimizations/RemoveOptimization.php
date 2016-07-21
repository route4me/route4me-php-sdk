<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\OptimizationProblem;
	
	// Example refers to the process of removing the optimization problems
	
	// Set the api key in the Route4Me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	//--------------------------------------------------------
	$optimization = new OptimizationProblem();
	
	$params = array (
		"optimization_problem_ids"  => array(
			"0" => "E222162732CBC3BF9A79F90D83E12DFC"
		),
		"redirect"  => 0
	);
	
	$result = $optimization->removeOptimization($params);
	
	var_dump($result);
?>