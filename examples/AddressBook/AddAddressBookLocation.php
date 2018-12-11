<?php
namespace Route4Me;

$root = realpath(dirname(__FILE__) . '/../../');
require $root . '/vendor/autoload.php';

use Route4Me\Route4Me;
use Route4Me\Route;

// Set the api key in the Route4me class
Route4Me::setApiKey('11111111111111111111111111111111');

$AdressBookLocationParameters=AddressBookLocation::fromArray(array(
    "first_name"  => "Test FirstName ".strval(rand(10000,99999)),
    "address_1"   => "Test Address1 ".strval(rand(10000,99999)),
    "cached_lat"  => 38.024654,
    "cached_lng"  => -77.338814
));

$abContacts = new AddressBookLocation();

$abcResults = $abContacts->addAdressBookLocation($AdressBookLocationParameters);

echo "address_id = ".strval($abcResults["address_id"])."<br>";

Route4Me::simplePrint($abcResults);
