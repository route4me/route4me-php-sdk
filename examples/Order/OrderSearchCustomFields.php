<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\Order;
	
	// Example refers to searching of the orders by specified custom fields.
	
	// Set the api key in the Route4me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	$orderParameters=Order::fromArray(array(
		"fields"  => "order_id,member_id"
	));

	$order = new Order();
	
	$response = $order->getOrder($orderParameters);
	
	foreach ($response as $key => $order) {
		Route4Me::simplePrint($order);
	}
?>