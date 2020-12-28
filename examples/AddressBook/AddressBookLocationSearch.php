<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Set the api key in the Route4Me class
Route4Me::setApiKey(Constants::API_KEY);

//Example refers to the process of retrieving specified fields by containig specified text in any field

$abLocation = new AddressBookLocation();

$params = [
    'query'     => 'Test',
    'fields'    => 'address_1,address_group,first_name,last_name',
    'offset'    => 0,
    'limit'     => 20,
];

$abcResult = $abLocation->searchAddressBookLocations($params);

$results = $abLocation->getValue($abcResult, 'results');

Route4Me::simplePrint($results);
