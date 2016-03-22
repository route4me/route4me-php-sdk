<?php
	namespace Route4me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4me\Route4me;
	use Route4me\Route;
	
	// Set the api key in the Route4me class
	Route4me::setApiKey('11111111111111111111111111111111');
	
	$route=new Route();
	
	$route_id1=$route->getRandomRouteId(0, 10);
	echo "route_id1=$route_id1 <br>";
	
	$route_id2=$route->getRandomRouteId(0, 10);
	echo "route_id2=$route_id2 <br><br>";
	
	$route_ids=join(',',array($route_id1,$route_id2));
	
	$result=$route->delete($route_ids);
	
	Route4me::simplePrint($result);
?>