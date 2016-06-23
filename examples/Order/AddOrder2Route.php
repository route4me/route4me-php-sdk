<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\Order;
	
	// Example refers to adding of an order to a route.
	
	// Set the api key in the Route4me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	
	$orderParameters=Order::fromArray(array(
		"route_id"	=> "28DAE34FE8341C30CA58726E10B6F8E9",
		"redirect"	=> 0,
	));
	
	$jfile = file_get_contents("add_order_to_route_data.json");
	
	$body = json_decode($jfile);

	$order = new Order();
	
	$response = $order->addOrder2Route($orderParameters,$body);
	
	Route4Me::simplePrint($response);
?>