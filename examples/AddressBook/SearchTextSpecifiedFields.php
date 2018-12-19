<?php
namespace Route4Me;

$root = realpath(dirname(__FILE__) . '/../../');
require $root . '/vendor/autoload.php';

use Route4Me\Route4Me;

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Set the api key in the Route4Me class
Route4Me::setApiKey('11111111111111111111111111111111');

$ablocation = new AddressBookLocation();

// Example refers to the process of searching for text and specifing returned fields. 

$params = array(
    'query'  => 'David',
    'fields' => 'first_name,address_email',
    'offset'  => 0,
    'limit'   => 5
);

$abcResult = $ablocation->searchAddressBookLocations($params);

assert(isset($abcResult['results']) && isset($abcResult['total']), "Cannot done search for the locations");

Route4Me::simplePrint($abcResult, true);
