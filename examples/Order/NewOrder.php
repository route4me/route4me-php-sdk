<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\Order;
	
	// Example refers to creating a new Order.
	
	// Set the api key in the Route4me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	$orderParameters=Order::fromArray(array(
		"address_1"	=> "1358 E Luzerne St, Philadelphia, PA 19124, US",
		"cached_lat"	=> 48.335991,
		"cached_lng"	=> 31.18287,
		"address_alias"		=> "Auto test address",
		"address_city"		=> "Philadelphia",
		"EXT_FIELD_first_name"		=> "Igor",
		"EXT_FIELD_last_name"		=> "Progman",
		"EXT_FIELD_email"		=> "progman@gmail.com",
		"EXT_FIELD_phone"		=> "380380380380",
		"EXT_FIELD_custom_data"		=> array(
			0 => 
		    array(
		       'order_id' => '10',
		       'name' => 'Bill Soul',
		    )
		)
	));
	
	$order = new Order();
	
	$response = $order->addOrder($orderParameters);
	
	Route4Me::simplePrint($response);
?>