<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\Route;
	
	// Set the api key in the Route4Me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	$route=new Route();
	
	$route_id=$route->getRandomRouteId(0, 10);
	
	//$route_id='8B4E277A54990986CD80BE36977517E2';
	
	if (is_null($route_id)) {
		echo "can't retrieve random route_id!.. Try again.";
		return;
	}
	
	$routeResults=(array)$route->getRoutes($route_id,null);

	Route4Me::simplePrint($routeResults);
	//------------------------------------
?>