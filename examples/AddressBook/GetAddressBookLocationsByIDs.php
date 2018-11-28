<?php
    namespace Route4Me;

    $vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';
    require $vdir.'/../vendor/autoload.php';

    use Route4Me\Route4Me;
    use Route4Me\Route;

    // Set the api key in the Route4Me class
    Route4Me::setApiKey('11111111111111111111111111111111');

    // Get two random locations IDs
    //---------------------------------------------------------
    $ids="";
    $adressBookLocationParameters=array(
        "limit"     => 30,
        "offset"    => 0
    ); 
    
    $abContacts=new AddressBookLocation();
    
    $abcResults=$abContacts->getAddressBookLocations($adressBookLocationParameters);
    
    $results=$abContacts->getValue($abcResults,"results");
    
    $contactsNumber = sizeof($results);
    $id1=$results[rand(1, $contactsNumber)-1]['address_id'];
    $id2=$results[rand(1, $contactsNumber)-1]['address_id'];
    $ids=$id1.",".$id2;
    
    //Example for retrieving Address Book Locations by address_ids
    //--------------------------------------------------------- 
    $ablocation=new AddressBookLocation();

    $abcResult=$ablocation->getAddressBookLocationsByIDs($ids);

    $result=$ablocation->getValue($abcResult,"results");

    Route4Me::simplePrint($result);
    //--------------------------------------------------------- 
?>