<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\Route;
	
	// Set the api key in the Route4Me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	$AdressBookLocationParameters=AddressBookLocation::fromArray(array(
		"first_name"	=> "Test FirstName ".strval(rand(10000,99999)),
		"address_1"		=> "Test Address1 ".strval(rand(10000,99999)),
		"cached_lat"	=> 38.024654,
		"cached_lng"	=> -77.338814
	));
	
	$abContacts=new AddressBookLocation();
	
	$abcResults=$abContacts->addAdressBookLocation($AdressBookLocationParameters);
	
	$address_id=-1;
	if (is_array($abcResults)) {
		if (isset($abcResults["address_id"])) {
			$address_id=$abcResults["address_id"];
		}
	}
	
	if ($address_id==-1) {
		echo "Creating of Address Book Location was failed. Try again!.. <br>";
		return;
	}
	echo "Address Book Location with address_id = ".strval($address_id)." was successfully added<br>";
	
	$addressBookLocations=array(6305950);
	
	$abLocations=new AddressBookLocation();
	
	$deleteResult=$abLocations->deleteAdressBookLocation($addressBookLocations);
	
	if (is_array($deleteResult)){
		if (sizeof($deleteResult)>0) {
			echo "Address Book Location with address_id = ".strval($address_id)." was successfully deleted<br>";
		} else {
			echo "Address Book Location delete operation failed!.. <br>";
		} 
	} else {
		echo "Address Book Location delete operation failed!.. <br>";
	}

?>