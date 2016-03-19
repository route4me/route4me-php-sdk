<?php
	namespace Route4me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4me\Route4me;
	use Route4me\Route;
	
	// Set the api key in the Route4me class
	Route4me::setApiKey('11111111111111111111111111111111');
	
	$AdressBookContactParameters=AddressBookContact::fromArray(array(
		"first_name"	=> "Test FirstName ".strval(rand(10000,99999)),
		"address_1"		=> "Test Address1 ".strval(rand(10000,99999)),
		"cached_lat"	=> 38.024654,
		"cached_lng"	=> -77.338814
	));
	
	$abContacts=new AddressBookContact();
	
	$abcResults=$abContacts->addAdressBookContact($AdressBookContactParameters);
	
	echo "address_id = ".strval($abcResults["address_id"])."<br>";
	
	Route4me::simplePrint($abcResults);
	
?>