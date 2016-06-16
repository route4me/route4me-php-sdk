<?php
    namespace Route4Me;

    $vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';
    require $vdir.'/../vendor/autoload.php';

    use Route4Me\Route4Me;

    // Set the api key in the Route4Me class
    Route4Me::setApiKey('11111111111111111111111111111111');

    $ablocation=new AddressBookLocation();

    //Example for retrieving all records, which contains 'Richmond' in any field 
    //--------------------------------------------------------- 
    $query='Richmond';
    $abcResult=$ablocation->getAddressBookLocation($query);

    $results=$ablocation->getValue($abcResult,"results");

    Route4Me::simplePrint($results);
    //--------------------------------------------------------- 
?>