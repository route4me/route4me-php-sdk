<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Set the api key in the Route4Me class
Route4Me::setApiKey(Constants::API_KEY);

// Example refers to getting the address book locations

$AddressBookLocationParameters = [
    'limit'     => 30,
    'offset'    => 0,
];

$abContacts = new AddressBookLocation();

$abcResults = $abContacts->getAddressBookLocations($AddressBookLocationParameters);

$results = $abContacts->getValue($abcResults, 'results');

foreach ($results as $result) {
    Route4Me::simplePrint($result);
    echo '<br>';
}
