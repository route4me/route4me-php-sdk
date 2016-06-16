<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	
	// Set the api key in the Route4Me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	$abLocation=new AddressBookLocation();
	
	//Example for retrieving Address Book Location by address_id
	//--------------------------------------------------------- 
	$query=4621569;
	$abcResult=$abLocation->getAddressBookLocation($query);
	
	$results=$abLocation->getValue($abcResult,"results");
	
	Route4Me::simplePrint($results);
	//--------------------------------------------------------- 
?>