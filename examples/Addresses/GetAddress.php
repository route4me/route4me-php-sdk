<?php
	namespace Route4me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4me\Route4me;
	use Route4me\Route;
	
	// Set the api key in the Route4me class
	Route4me::setApiKey('11111111111111111111111111111111');
	
	$address=new Address();
	
	$AdressParameters=Address::fromArray(array(
		"route_id"	=> "Test FirstName ".strval(rand(10000,99999)),
		"route_destination_id"		=> "Test Address1 ".strval(rand(10000,99999)),
	));
	
?>