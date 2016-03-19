<?php
	namespace Route4me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4me\Route4me;
	
	// Set the api key in the Route4me class
	Route4me::setApiKey('11111111111111111111111111111111');
	
	$abContact=new AddressBookContact();
	
	//Example for retrieving Address Book Contact by address_id
	//--------------------------------------------------------- 
	$query=4621569;
	$abcResult=$abContact->getAddressBookContact($query);
	
	$results=$abContact->getValue($abcResult,"results");
	
	Route4me::simplePrint($results);
	//--------------------------------------------------------- 
	
	//Example for retrieving all records, which contains 'Richmond' in any field 
	//--------------------------------------------------------- 
	$query='Richmond';
	$abcResult=$abContact->getAddressBookContact($query);
	
	$results=$abContact->getValue($abcResult,"results");
	
	Route4me::simplePrint($results);
	//--------------------------------------------------------- 
?>