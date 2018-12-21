<?php
namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Route4Me;
use Route4Me\Route;

// Set the api key in the Route4Me class
Route4Me::setApiKey('11111111111111111111111111111111');

// Get two random locations IDs

$adressBookLocationParameters = array(
    "limit"   => 30,
    "offset"  => 0
); 

$abContacts = new AddressBookLocation();

$abcResults = $abContacts->getAddressBookLocations($adressBookLocationParameters);

$results = $abContacts->getValue($abcResults,"results");

$contactsNumber = sizeof($results);
$id1 = $results[rand(1, $contactsNumber)-1]['address_id'];
$id2 = $results[rand(1, $contactsNumber)-1]['address_id'];

$ids = array();
$ids['address_id'] = $id1.",".$id2;

// Retrieve address book locations by address_ids
$ablocation = new AddressBookLocation();

$abcResult = $ablocation->getAddressBookLocations($ids);

$results = $ablocation->getValue($abcResult, "results");

foreach ($results as $result) {
    Route4Me::simplePrint($result);
    echo "<br>";
}
