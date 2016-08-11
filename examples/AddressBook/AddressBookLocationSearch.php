<?php
    namespace Route4Me;

    $vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';
    require $vdir.'/../vendor/autoload.php';

    use Route4Me\Route4Me;

    // Set the api key in the Route4Me class
    Route4Me::setApiKey('11111111111111111111111111111111');

    $ablocation=new AddressBookLocation();

    //Example refers to the process of retrieving sepcified fields by containg specified text in any field 
    //--------------------------------------------------------- 
	
	$params = array(
		"query"  => "David",
		"fields"  => "first_name,address_email",
		"offset"  => 0,
		"limit"  => 20,
	);
	
    $abcResult=$ablocation->searchRoutedLocation($params);

    $results=$ablocation->getValue($abcResult,"results");

    Route4Me::simplePrint($results);
    //--------------------------------------------------------- 
?>