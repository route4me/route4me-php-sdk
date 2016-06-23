<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\Order;
	
	// Example refers to updating an order.
	
	// Set the api key in the Route4me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	$jfile = file_get_contents("update_order_data.json");
	
	$body = json_decode($jfile);

	$order = new Order();
	
	$response = $order->updateOrder($body);
	
	Route4Me::simplePrint($response);
?>