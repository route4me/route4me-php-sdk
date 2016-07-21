<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\Address;
	use Route4Me\OptimizationProblem;
	
	// Set the api key in the Route4Me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	// Get random optimization problem from test optimization problems
	//--------------------------------------------------------
	$optimization = new OptimizationProblem();
	
	$optimization_problem=$optimization->getRandomOptimizationId(0, 10);
	
	if (is_null($optimization_problem)) {
		echo "can't retrieve random optimization_problem_id!.. Try again.";
		return;
	}
	//--------------------------------------------------------
	// Get random destination from selected optimization above
	//--------------------------------------------------------
	$addressRand= (array)$optimization->getRandomAddressFromOptimization($optimization_problem['optimization_problem_id']);
	
	if (is_null($addressRand)) {
		echo "can't retrieve random address!.. Try again.";
		return;
	}
	
	if (isset($addressRand['is_depot'])) {
		if ($addressRand['is_depot']) {
			echo "This address is depot!.. Try again.";
			return;
		}
	}
	
	$route_destination_id=$addressRand['route_destination_id'];
	
	if (is_null($route_destination_id)) {
		echo "can't retrieve random address!.. Try again.";
		return;
	}
	
	echo "route_destination_id = $route_destination_id <br>";
	//--------------------------------------------------------
	$params = array (
		"optimization_problem_id"  => $optimization_problem['optimization_problem_id'],
		"route_destination_id"     => $route_destination_id
	);
	
	$result = $optimization->removeAddress($params);
	
	var_dump($result);
?>