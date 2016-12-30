<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\Route;
	
	// Set the api key in the Route4Me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	// The example refers to the process of searching for the specified text throughout all routes belonging to the user's account.
	
	$RouteParameters=array(
		"query"		=> 'Tbilisi'
	);
	
	$route=new Route();
	
	$routeResults=$route->getRoutes(null,$RouteParameters);
	
	foreach ($routeResults as $routeResult)
	{
		$results=(array)$routeResult;

		Route4Me::simplePrint($results);
		
		echo "<br>";
	}
?>