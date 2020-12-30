<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Set the api key in the Route4Me class
Route4Me::setApiKey(Constants::API_KEY);

// Get two random locations IDs

$addressBookLocationParameters = [
    'limit'     => 30,
    'offset'    => 0,
];

$abContacts = new AddressBookLocation();

$abcResults = $abContacts->getAddressBookLocations($addressBookLocationParameters);

$results = $abContacts->getValue($abcResults, 'results');

$contactsNumber = sizeof($results);
$id1 = $results[rand(1, $contactsNumber) - 1]['address_id'];
$id2 = $results[rand(1, $contactsNumber) - 1]['address_id'];

$ids = [];
$ids['address_id'] = $id1.','.$id2;

// Retrieve address book locations by address_ids
$abLocation = new AddressBookLocation();

$abcResult = $abLocation->getAddressBookLocations($ids);

$results = $abLocation->getValue($abcResult, 'results');

foreach ($results as $result) {
    Route4Me::simplePrint($result);
    echo '<br>';
}
