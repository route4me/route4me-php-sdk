<?php
	namespace Route4me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4me\Route4me;
	use Route4me\Route;
	use Route4me\OptimizationProblem;
	
	// Set the api key in the Route4me class
	Route4me::setApiKey('11111111111111111111111111111111');
	
	// Get random route from test routes
	//--------------------------------------------------------
	$route=new Route();
	
	$route_id=$route->getRandomRouteId(0, 10);
	
	if (is_null($route_id)) {
		echo "can't retrieve random route_id!.. Try again.";
		return;
	}
	//--------------------------------------------------------
	
	// Get random destination from selected route above
	//--------------------------------------------------------
	$addressRand=(array)$route->GetRandomAddressFromRoute($route_id);
	$route_destination_id=$addressRand['route_destination_id'];
	
	if (is_null($route_destination_id)) {
		echo "can't retrieve random address!.. Try again.";
		return;
	}
	
	echo "route_destination_id = $route_destination_id <br>";
	//--------------------------------------------------------
	
	$address=new Address();
	
	$address->route_id = $route_id;
	$address->route_destination_id = $route_destination_id;
	$result=$address->delete();
	
	var_dump($result);
?>