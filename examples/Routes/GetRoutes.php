<?php
	namespace Route4me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4me\Route4me;
	use Route4me\Route;
	
	// Set the api key in the Route4me class
	Route4me::setApiKey('11111111111111111111111111111111');
	
	$RouteParameters=array(
		"limit"		=> 30,
		"offset"	=> 0
	);
	
	$route=new Route();
	
	$routeResults=$route->getRoutes(null,$RouteParameters);
	
	foreach ($routeResults as $routeResult)
	{
		$results=(array)$routeResult;

		Route4me::simplePrint($results);
		
		echo "<br>";
	}

?>