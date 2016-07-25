<?php
    namespace Route4Me;

    $vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';
    require $vdir.'/../vendor/autoload.php';

    use Route4Me\Route4Me;

    // Set the api key in the Route4Me class
    Route4Me::setApiKey('11111111111111111111111111111111');

    $ablocation=new AddressBookLocation();

    //Example refers to the process of search for routed addresses 
    //--------------------------------------------------------- 
    $params= array(
		'display'=> 'routed'
	);
	
    $abcResult=$ablocation->getAddressBookLocation($params);

    $results=$ablocation->getValue($abcResult,"results");

    Route4Me::simplePrint($results);
    //--------------------------------------------------------- 
?>