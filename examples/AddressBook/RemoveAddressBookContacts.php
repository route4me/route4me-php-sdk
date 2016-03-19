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
	
	$address_id=-1;
	if (is_array($abcResults)) {
		if (isset($abcResults["address_id"])) {
			$address_id=$abcResults["address_id"];
		}
	}
	
	if ($address_id==-1) {
		echo "Creating of Address Book Contavt was failed. Try again!.. <br>";
		return;
	}
	echo "Address Book Contact with address_id = ".strval($address_id)." was successfully added<br>";
	
	$addressBookContacts=array(6305950);
	
	$abContacts=new AddressBookContact();
	
	$deleteResult=$abContacts->deleteAdressBookContact($addressBookContacts);
	
	if (is_array($deleteResult)){
		if (sizeof($deleteResult)>0) {
			echo "Address Book Contact with address_id = ".strval($address_id)." was successfully deleted<br>";
		} else {
			echo "Address Book Contact delete operation failed!.. <br>";
		} 
	} else {
		echo "Address Book Contact delete operation failed!.. <br>";
	}

?>