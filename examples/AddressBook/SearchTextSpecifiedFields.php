<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Set the api key in the Route4Me class
Route4Me::setApiKey(Constants::API_KEY);

$abLocation = new AddressBookLocation();

// Example refers to the process of searching for text and specifing returned fields.

$params = [
    'query' => 'David',
    'fields' => 'first_name,address_email',
    'offset' => 0,
    'limit' => 5,
];

$abcResult = $abLocation->searchAddressBookLocations($params);

assert(isset($abcResult['results']) && isset($abcResult['total']), 'Cannot done search for the locations');

Route4Me::simplePrint($abcResult, true);
