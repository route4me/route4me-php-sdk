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
		"route_id"  => "3A2DD89E6E1A044B2098AD1313E3138C",
		"recipient_email"  => "oleg.guchi@gmail.com"
	);
	
	$result=$route->shareRoute($params);
	
	var_dump($result); die("");
	
?>