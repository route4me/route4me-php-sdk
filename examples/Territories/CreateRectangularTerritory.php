<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\Enum\TerritoryTypes;
	// Set the api key in the Route4Me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	// Example refers to the process of creating Territory with rectangular shape
	
	$territory = new Territory();
	$territory->type =  TerritoryTypes::RECT;
	$territory->data = array (
			"43.51668853502909,-109.3798828125",
			"46.98025235521883,-101.865234375"
	);
	
	$TerritoryParameters=Territory::fromArray(array(
		"territory_name"	=> "Test Rectangular Territory ".strval(rand(10000,99999)),
		"territory_color"	=> "ff7700",
		"territory"	=> $territory
	));
	
	$territory=new Territory();
	
	$result = $territory->addTerritory($TerritoryParameters);
	
	Route4Me::simplePrint($result);
?>