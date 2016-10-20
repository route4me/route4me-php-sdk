<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\Enum\TerritoryTypes;
	// Set the api key in the Route4Me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	$territory=new Territory();
	
	$territory_id="596A2A44FE9FB19EEB9C3C072BF2D0BE";
	
	$params = array(
		"territory_id" => $territory_id,
		"addresses" => 1
	);
	
	$result1 = $territory->getTerritory($params);
	
	foreach ($result1 as $key => $value) {
		if (is_array($value)) {
			print $key.':<br>';
			Route4Me::simplePrint($value);
		} else {
			print $key.' => '.$value.'<br>';
		}
		
		
		//Route4Me::simplePrint($result1);
	}
	
?>