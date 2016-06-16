<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\Enum\TerritoryTypes;
	// Set the api key in the Route4Me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	// Add Avoidance Zone and get territory_id
	//---------------------------------------------------------
	$territory = new Territory();
	$territory->type =  TerritoryTypes::CIRCLE;
	$territory->data = array (
		"37.569752822786455,-77.47833251953125",
		"5000"
	);
	
	$AvoisanceZoneParameters=AvoidanceZone::fromArray(array(
		"territory_name"	=> "Test Territory ".strval(rand(10000,99999)),
		"territory_color"	=> "ff7700",
		"territory"	=> $territory
	));
	
	$avoidancezone=new AvoidanceZone();
	
	$result = (array)$avoidancezone->addAvoidanceZone($AvoisanceZoneParameters);
	
	$territory_id="";
	if (isset($result)) {
		$territory_id = $result["territory_id"];
	} else {
		 	echo "Failed to create new Avoidance Zone. Try again";
		 return;
	}
	
	echo "New Avoidance Zone with territory_id = $territory_id created successfuly<br>";
	echo "------------------------------------------------------------------------<br><br>";
	//-----------------------------------------------------------
	
	$result1 = $avoidancezone->deleteAvoidanceZone($territory_id);
	
	if (isset($result1)) 
	{
			echo "Avoidance Zone with territory_id = $territory_id was deleted successfuly<br>";
	}
	
	Route4Me::simplePrint($result1);
?>