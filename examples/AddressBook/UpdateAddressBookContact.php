<?php
	namespace Route4me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4me\Route4me;

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
	
	$address_id=-1;
	if (is_array($abcResults)) {
		if (isset($abcResults["address_id"])) {
			$address_id=$abcResults["address_id"];
		}
	}
	
	if ($address_id==-1) {
		echo "Creating of Address Book Contavt was failed. Try again!.. <br><br>";
		return;
	}
	echo "Address Book Contact with address_id = ".strval($address_id)." was successfully added<br>";
	$abcResults["first_name"]="Test Firstname Updated";
	//$abcResults["address_1"]="Test address Updated";
	$abcResults=$abContacts->updateAdressBookContact($abcResults);
	
	Route4me::simplePrint($abcResults);
	
	
?>