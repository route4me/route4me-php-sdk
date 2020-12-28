<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Set the api key in the Route4Me class
Route4Me::setApiKey(Constants::API_KEY);

$abLocation = new AddressBookLocation();

// Get reandom address book location
$AddressBookLocationParameters = [
        'limit'     => 30,
        'offset'    => 0,
];

$randomLocation = $abLocation->getRandomAddressBookLocation($AddressBookLocationParameters);

if (assert(null != $randomLocation, 'Cannot get a randoma address book location'));

// Get the address book location by address_id
$addressID = $randomLocation['address_id'];
$abcResult = $abLocation->getAddressBookLocation($addressID);

$results = $abLocation->getValue($abcResult, 'results');

Route4Me::simplePrint($results);
