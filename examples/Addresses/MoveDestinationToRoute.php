<?php
	namespace Route4me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4me\Route4me;
	use Route4me\Route;
	
	// Set the api key in the Route4me class
	Route4me::setApiKey('11111111111111111111111111111111');

	// Get random source route from test routes
	//--------------------------------------------------------
	$route=new Route();
	
	$route_id0=$route->getRandomRouteId(0, 10);
	
	if (is_null($route_id0)) {
		echo "can't retrieve random route_id!.. Try again.";
		return;
	}
	//--------------------------------------------------------
	
	// Get random source destination from selected source route above
	//--------------------------------------------------------
	$addressRand=(array)$route->GetRandomAddressFromRoute($route_id0);
	$route_destination_id=$addressRand['route_destination_id'];
	
	if (is_null($route_destination_id)) {
		echo "can't retrieve random address!.. Try again.";
		return;
	}
	echo "route_destination_id = $route_destination_id <br>";
	//--------------------------------------------------------	
	
	// Get random destination route from test routes
	//--------------------------------------------------------
	$to_route_id=$route->getRandomRouteId(11, 20);
	
	if (is_null($to_route_id)) {
		echo "can't retrieve random route_id!.. Try again.";
		return;
	}
	echo "to_route_id = $to_route_id <br>";
	//--------------------------------------------------------
	
	// Get random destination destination from selected source route above
	//--------------------------------------------------------
	$addressRand2=(array)$route->GetRandomAddressFromRoute($to_route_id);
	$after_destination_id=$addressRand2['route_destination_id'];
	
	if (is_null($after_destination_id)) {
		echo "can't retrieve random address!.. Try again.";
		return;
	}
	echo "after_destination_id = $after_destination_id <br>";
	//--------------------------------------------------------	
	
	$routeparams=(array)Address::fromArray(array(
		'address'	=> $addressRand['address'],
		'lat'	=> $addressRand['lat'],
		'lng'	=> $addressRand['lng'],
		'to_route_id' 	=>	$to_route_id,
		'route_destination_id'		=> strval($route_destination_id),
		'after_destination_id'		=>	strval($after_destination_id)
	));
	
	$address=new Address();
	$result = $address->MoveDestinationToRoute($routeparams);
	//$result=$route->MoveDestinationToRoute($routeparams);
	
	// ATTENTION: this module doesn't work yet. It will be updated later
	var_dump($result);
	//Route4me::simplePrint((array)$result);
?>