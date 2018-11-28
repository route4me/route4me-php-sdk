<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\Route;
	
	// Set the api key in the Route4Me class
	Route4Me::setApiKey('51d0c0701ce83855c9f62d0440096e7c');
	
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
	$route_id='6EC2759FD551516356AB2C9B335CAC16';
	$route_destination_id='152555738';
	$noteParameters=array(
		"route_id"		=> $route_id,
		"route_destination_id"	=> $route_destination_id
	);
	
	$address=new Address();
	
	$notes=$address->GetAddressesNotes($noteParameters);
	
	echo "destination_note_count --> ".$notes['destination_note_count']."<br>";
	foreach ($notes['notes'] as $note) {
		echo "========== Notes ==================<br>";
		echo "note_id --> ".$note['note_id']."<br>";
        $content = isset($note['contents']) ? $note['contents'] : "";
        if (strlen($content)>0) echo "contents --> $content"."<br>";
	}

	//var_dump($notes);
	//Route4Me::simplePrint($notes)
?>