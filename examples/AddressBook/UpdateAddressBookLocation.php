<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;

	// Set the api key in the Route4Me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	$AdressBookLocationParameters=AddressBookLocation::fromArray(array(
		"first_name"	=> "Test FirstName ".strval(rand(10000,99999)),
		"address_1"		=> "Test Address1 ".strval(rand(10000,99999)),
		"cached_lat"	=> 38.024654,
		"cached_lng"	=> -77.338814
	));
	
	$abLocations=new AddressBookLocation();
	
	$abcResults=$abLocations->addAdressBookLocation($AdressBookLocationParameters);
	
	$address_id=-1;
	if (is_array($abcResults)) {
		if (isset($abcResults["address_id"])) {
			$address_id=$abcResults["address_id"];
		}
	}
	
	if ($address_id==-1) {
		echo "Creating of Address Book Location was failed. Try again!.. <br><br>";
		return;
	}
	echo "Address Book Location with address_id = ".strval($address_id)." was successfully added<br>";
	$abcResults["first_name"]="Test Firstname Updated";
	//$abcResults["address_1"]="Test address Updated";
	$abcResults=$abLocations->updateAdressBookLocation($abcResults);
	
	Route4Me::simplePrint($abcResults);
	
	
?>