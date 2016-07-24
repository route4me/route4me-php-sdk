<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\Address;
	
	// Set the api key in the Route4Me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	$address=new Address();
	
	$params = array(
		"route_id"  => "5C15E83A4BE005BCD1537955D28D51D7",
		"address_id"  =>  160940135,
		"is_departed"  => 1,
		"member_id"  => 1
	);
	
	$result=$address->markAsDeparted($params);
	
	var_dump($result); 
?>