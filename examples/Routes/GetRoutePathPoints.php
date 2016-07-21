<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\Route;
	
	// Set the api key in the Route4Me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	$route=new Route();
	
	$route_id="5C15E83A4BE005BCD1537955D28D51D7";
	
	// Note: not every optimization includes information about path points, only thus, which was generated with the parameter route_path_output = "Points"  
	
	$params = array(
		"route_path_output" => "Points"
	);
	
	$routeResults=(array)$route->getRoutePoints($route_id,$params);

	if (isset($routeResults['addresses'])) {

		foreach ($routeResults['addresses'] as $key => $address) {
			$araddress = (array)$address;

			if (isset($araddress['route_destination_id'])) echo "route_destination_id=".$araddress['route_destination_id']."<br>";
			
			if (isset($araddress['path_to_next'])) {
				echo "path_to_next:<br>";
				Route4Me::simplePrint($araddress['path_to_next']);
			}
			echo "<br>";
		}

	}
?>