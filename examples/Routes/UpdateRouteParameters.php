<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\Route;
	
	// Set the api key in the Route4Me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	// Example refers to the process of update parameters of a route
	
	$route=new Route();
	
	$route->route_id = "5C15E83A4BE005BCD1537955D28D51D7";
	
	$route->parameters = new \stdClass();
	
	$route->parameters = array(
		"member_id"  => "177496",
        "optimize"   => "Distance",
        "route_max_duration"  => "82400",
        "route_name"  => "updated 07-23-2016"
	);
	
	$route->httpheaders = array(
		'Content-type: application/json'
	);
	
	$result=$route->update();
	
	var_dump($result);
	
?>