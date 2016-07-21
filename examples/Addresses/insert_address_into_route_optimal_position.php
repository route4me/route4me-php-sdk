<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\Route;
	
	// Example refers to the process of an address inserting into specified route's optimal position 
	
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
	
	$addresses=array();
	
	$params=array(
		"route_id" => "5C15E83A4BE005BCD1537955D28D51D7",
		"addresses" => array(
			"0" => array(
				"address" => "Cabo Rojo, Cabo Rojo 00623, Puerto Rico",
				"alias" => "",
				"lat" => 18.086627,
				"lng" => -67.145735,
				"curbside_lat" => 18.086627,
				"curbside_lng" => -67.145735,
				"is_departed" => false,
				"is_visited" => false
			)
		),
		"optimal_position" => true
	);
	
	$route1=new Route();
	
	$result=$route1->insertAddressOptimalPosition($params);
	
	Route4Me::simplePrint((array)$result);
?>