<?php
namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Route4Me;
use Route4Me\Route;

// Set the api key in the Route4Me class
Route4Me::setApiKey('11111111111111111111111111111111');

// Example refers to getting the address book locations

$AdressBookLocationParameters = array(
    "limit"   => 30,
    "offset"  => 0
);

$abContacts = new AddressBookLocation();

$abcResults = $abContacts->getAddressBookLocations($AdressBookLocationParameters);

$results = $abContacts->getValue($abcResults, "results");

foreach ($results as $result) {
	Route4Me::simplePrint($result);
    echo "<br>";
}
