<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\Order;
	
	// Example refers to adding of an order to an optimization.
	
	// Set the api key in the Route4me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	$orderParameters=Order::fromArray(array(
		"optimization_problem_id"	=> "E0883C1A2C7B3AAA9397BDDF90C9CFF8",
		"redirect"	=> 0,
	));
	
	$jfile = file_get_contents("add_order_to_optimization_data.json");
	
	$body = json_decode($jfile);

	$order = new Order();
	
	$response = $order->addOrder2Destination($orderParameters,$body);
	
	Route4Me::simplePrint($response);
?>