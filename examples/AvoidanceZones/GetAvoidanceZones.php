<?php
	namespace Route4me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4me\Route4me;
	use Route4me\Enum\TerritoryTypes;
	// Set the api key in the Route4me class
	Route4me::setApiKey('11111111111111111111111111111111');
	
	$avoidancezone=new AvoidanceZone();
	
	$queryparameters=array (
		"offset" => 0,
		"limit" => 20
	);
	
	$azones = $avoidancezone->getAvoidanceZones($queryparameters);
	
	Route4me::simplePrint($azones);
?>