<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Set the api key in the Route4Me class
Route4Me::setApiKey(Constants::API_KEY);

$abLocation = new AddressBookLocation();

// Example refers to the process of searching for the routed locations

$params = [
    'offset' => 0,
    'limit' => 5,
    'display' => 'routed',
];

$abcResult = $abLocation->searchAddressBookLocations($params);

assert(isset($abcResult['results']) && isset($abcResult['total']), 'Cannot done search for the locations');

echo 'Was found '.$abcResult['total'].' routed locations';
