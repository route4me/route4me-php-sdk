<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\Route;
	
	// Set the api key in the Route4Me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	$route=new Route();
	
	$params = array(
		"route_id"  => "5D88D72CE6B1D794DDD677AE48A05BA7",
		"disable_optimization"  => 0,
		"optimize"  => "Distance"
	);
	
	$resequence=$route->resequenceAllAddresses($params);
	
	var_dump($resequence);
?>