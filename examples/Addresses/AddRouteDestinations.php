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
	$route=new Route();
	
	$route_id=$route->getRandomRouteId(0, 10);
	
	if (is_null($route_id)) {
		echo "can't retrieve random route_id!.. Try again.";
		return;
	}
	//--------------------------------------------------------
	
	$addresses=array();
	
	$address1=(array)Address::fromArray(array(
		'address' 	=>	'146 Bill Johnson Rd NE Milledgeville GA 31061',
		'lat'		=>	33.143526,
		'lng'		=>	-83.240354,
		'time'		=>	0
	));
	
	$address2=(array)Address::fromArray(array(
		'address' 	=>	'222 Blake Cir Milledgeville GA 31061',
		'lat'		=>	33.177852,
		'lng'		=>	-83.263535,
		'time'		=>	0
	));
	

	$addresses[]=$address1; 
	$addresses[]=$address2;
	
	$routeParameters=(array)Route::fromArray(array(
		"route_id"	=> $route_id,
		"addresses"		=> $addresses,
	));
	
	$route1=new Route();
	
	$result=$route1->addAddresses($routeParameters);
	
	Route4Me::simplePrint((array)$result);
?>