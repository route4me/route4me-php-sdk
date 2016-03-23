<?php
	namespace Route4me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4me\Route4me;
	use Route4me\Enum\TerritoryTypes;
	// Set the api key in the Route4me class
	Route4me::setApiKey('11111111111111111111111111111111');
	
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
	
	$result1 = $avoidancezone->getAvoidanceZone($territory_id);
	
	Route4me::simplePrint($result1);
?>