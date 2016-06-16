<?php
    namespace Route4Me;

    $vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';
    require $vdir.'/../vendor/autoload.php';

    use Route4Me\Route4Me;

    // Set the api key in the Route4Me class
    Route4Me::setApiKey('11111111111111111111111111111111');

    $ablocation=new AddressBookLocation();

    //Example for retrieving Address Book Locations by address_ids
    //--------------------------------------------------------- 
    $ids="4623361,6281217";
	//$ablocation->address_id = $ids;
    $abcResult=$ablocation->getAddressBookLocationsByIds($ids);

    $results=$ablocation->getValue($abcResult,"results");

    Route4Me::simplePrint($results);
    //--------------------------------------------------------- 
?>