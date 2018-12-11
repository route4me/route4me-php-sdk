<?php
namespace Route4Me;

$root = realpath(dirname(__FILE__) . '/../../');
require $root . '/vendor/autoload.php';

use Route4Me\Route4Me;

// Set the api key in the Route4Me class
Route4Me::setApiKey('11111111111111111111111111111111');

$abLocation = new AddressBookLocation();

// Get reandom address book location
$AdressBookLocationParameters = array(
        "limit"     => 30,
        "offset"    => 0
    );

 $randomLocation = $abLocation->getRandomAddressBookLocation($AdressBookLocationParameters);
 
 if (assert($randomLocation!=null, "Cannot get a randoma address book location"));

// Get the address book location by address_id
$addressID = $randomLocation["address_id"];
$abcResult = $abLocation->getAddressBookLocation($addressID);

$results = $abLocation->getValue($abcResult,"results");

Route4Me::simplePrint($results);
