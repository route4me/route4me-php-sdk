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
		"route_ids"  => "7259435F6B650FD378C06C7A02F64D8B,851F7BC1CE20951DAB5E979F51744B59"
	);
	
	$result=$route->mergeRoutes($params);
	
	var_dump($result); die("");
	
?>