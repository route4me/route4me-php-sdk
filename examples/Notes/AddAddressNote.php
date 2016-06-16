<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\Route;
	
	// Set the api key in the Route4Me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	/*
	// Get random route from test routes
	//--------------------------------------------------------
	$route=new Route();
	
	$route_id=$route->getRandomRouteId(0, 10);
	
	if (is_null($route_id)) {
		echo "can't retrieve random route_id!.. Try again.";
		return;
	}
	//--------------------------------------------------------
	
	// Get random address's id from selected route above
	//--------------------------------------------------------
	$addressRand=(array)$route->GetRandomAddressFromRoute($route_id);
	$route_destination_id=$addressRand['route_destination_id'];
	
	if (is_null($route_destination_id)) {
		echo "can't retrieve random address!.. Try again.";
		return;
	}
	//--------------------------------------------------------
	*/
	$route_id="6EC2759FD551516356AB2C9B335CAC16";
	$route_destination_id="152555738";
	
	$noteParameters=array(
		"route_id"		=> $route_id,
		"address_id"	=> $route_destination_id,
		"dev_lat"  => 33.132675170898,
		"dev_lng" => -83.244743347168,
		"device_type" => "web",
		"strUpdateType" =>  "dropoff",
		"strNoteContents" => "Test"
	);
	//var_dump($noteParameters); die("");
	$address = new Address();
	
	echo "route_id = $route_id <br>";
	echo "route_destination_id = $route_destination_id <br><br>";
	$address1 = $address->AddAddressesNote($noteParameters);
	
	var_dump($address1);
	
?>