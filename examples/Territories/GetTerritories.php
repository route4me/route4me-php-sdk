<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\Enum\TerritoryTypes;
	
	// Set the api key in the Route4Me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	$territory = new Territory();
	
	$queryparameters=array (
		"offset" => 0,
		"limit" => 20
	);
	
	$aterritory = $territory->getTerritories($queryparameters);
	
	Route4Me::simplePrint($aterritory);
?>