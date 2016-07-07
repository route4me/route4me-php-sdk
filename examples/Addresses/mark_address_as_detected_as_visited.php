<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\Route;
	use Route4Me\Address;
	
	// Set the api key in the Route4Me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	// Get random route from test routes
	//--------------------------------------------------------
	$route=new Route();
	
	$route_id=$route->getRandomRouteId(0, 10);
	
	if (is_null($route_id)) {
		echo "can't retrieve random route_id!.. Try again.";
		return;
	}
	//--------------------------------------------------------
	
	// Get random address's id from selected route above
	//--------------------------------------------------------
	$addressRand=(array)$route->GetRandomAddressFromRoute($route_id);
	
	if (isset($addressRand['is_depot']))
	{
		if ($addressRand['is_depot'])
		{
			echo "Random choosed address is depot, it can't be marked!.. Try again.";
			return;
		}
	}
	
	$address_id = $addressRand['route_destination_id'];
	
	if (is_null($address_id)) {
		echo "can't retrieve random address!.. Try again.";
		return;
	}
	//--------------------------------------------------------
	
	$addressParameters=(array)Address::fromArray(array(
		"route_id"	=> $route_id,
		"route_destination_id"	=> $address_id,
	));
	
	$body= array(
		"is_visited"	=> TRUE,
	);
	
	$address=new Address();
	
	$result=$address->markAddress($addressParameters, $body);
	
	Route4Me::simplePrint($result);
?>