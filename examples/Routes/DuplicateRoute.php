<?php
	namespace Route4me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4me\Route4me;
	use Route4me\Route;
	
	// Set the api key in the Route4me class
	Route4me::setApiKey('11111111111111111111111111111111');
	
	$route=new Route();
	
	$route_id=$route->getRandomRouteId(0, 10);

	//$route_id='5D88D72CE6B1D794DDD677AE48A05BA7';
	$routeDuplicate=$route->duplicateRoute($route_id);
	
	Route4me::simplePrint($routeDuplicate);
?>