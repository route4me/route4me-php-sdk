<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\Route;
	
	// Set the api key in the Route4Me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	$route=new Route();
	
	$route_id="5C15E83A4BE005BCD1537955D28D51D7";
	
	// Note: not every optimization includes information about directions, only thus, which was generated with the parameter directions = 1    
	
	$params = array(
		"directions" => 1
	);
	
	$routeResults=(array)$route->getRoutePoints($route_id,$params);
	if (isset($routeResults['directions'])) {
		foreach ($routeResults['directions'] as $direction) {
			Route4Me::simplePrint($direction);
			echo "<br>";
		}
		
	}
?>