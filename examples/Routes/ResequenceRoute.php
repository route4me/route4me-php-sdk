<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\Route;
	
	// Set the api key in the Route4Me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	$route=new Route();
	
	$params = array(
		"route_id"  => "5D88D72CE6B1D794DDD677AE48A05BA7",
		"route_destination_id"  => 175572555,
		"addresses"  => array(
			"0" => array(
				"lat"  => 40.285026,
            	"lng"  => -74.333839,
            	"sequence_no"  => 2
			)
		)
	);
	
	$resequence=$route->resequenceRoute($params);
	
	foreach ((array)$resequence as $key => $addresses) {
		echo "key=$key.<br>";
		if ($key=="addresses") {
			foreach ($addresses as $key1 => $address) {
				if (isset($address['route_destination_id'])) {
					echo "route_destination_id=".$address['route_destination_id']."<br>";
				}
				if (isset($address['lat'])) {
					echo "lat=".$address['lat']."<br>";
				}
				if (isset($address['lng'])) {
					echo "lng=".$address['lng']."<br>";
				}
			}
		}
		
		//var_dump($value);
		echo "<br>";
	}
	//Route4Me::simplePrint($resequence);
?>