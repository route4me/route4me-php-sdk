<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\Enum\TerritoryTypes;
	// Set the api key in the Route4Me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	// Add Territory and get territory_id
	//---------------------------------------------------------
	$territory = new Territory();
	$territory->type =  TerritoryTypes::CIRCLE;
	$territory->data = array (
		"37.569752822786455,-77.47833251953125",
		"5000"
	);
	
	$TerritoryParameters=Territory::fromArray(array(
		"territory_name"	=> "Test Territory ".strval(rand(10000,99999)),
		"territory_color"	=> "ff7700",
		"territory"	=> $territory
	));
	
	$territory=new Territory();
	
	$result = (array)$territory->addTerritory($TerritoryParameters);
	
	$territory_id="";
	if (isset($result)) {
		$territory_id = $result["territory_id"];
	} else {
		 	echo "Failed to create new Territory. Try again";
		 return;
	}
	
	echo "New Territory with territory_id = $territory_id created successfuly<br>";
	echo "------------------------------------------------------------------------<br><br>";
	//-----------------------------------------------------------
	
	$params = array(
		"territory_id" => $territory_id
	);
	$result1 = $territory->getTerritory($params);
	
	Route4Me::simplePrint($result1);
?>