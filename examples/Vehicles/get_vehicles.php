<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\Vehicle;
	
	// Example refers to getting all vehicles.
	
	// Set the api key in the Route4me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	
	$vehicle = new Vehicle();
	
	$response = $vehicle->getVehicles();
	
	foreach ($response as $key => $vehicle) {
		Route4Me::simplePrint($vehicle);
	}
	
?>