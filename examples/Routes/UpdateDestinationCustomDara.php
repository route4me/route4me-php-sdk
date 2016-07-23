<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\Route;
	
	// Set the api key in the Route4Me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	// Example refers to the process of set custom data of an address
	
	$route=new Route();
	
	$route->route_id = "5C15E83A4BE005BCD1537955D28D51D7";
	$route->route_destination_id = 160940135;
	
	$route->parameters = new \stdClass();
	
	$route->parameters->custom_fields = array(
			"animal"  => "tiger",
			"bird"  => "canary"
	);
	
	$route->httpheaders = array(
		'Content-type: application/json'
	);
	
	$result=$route->updateAddress();
	
	var_dump($result);
	
?>