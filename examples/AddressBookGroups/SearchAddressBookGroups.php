<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Set the api key in the Route4Me class
Route4Me::setApiKey(Constants::API_KEY);

$abGroup = new AddressBookGroup();

// The example refers to the process of searching for the locations by sending JSON payload.

$searchParameters = [
    'fields' => ['address_id', 'address_1', 'address_group'],
    'limit' => 10,
    'offset' => 0,
    'filter' => [
        'query' => "Louisville",
        "display" => "all"
    ]
];

$addressBookGroups = $abGroup->searchAddressBookGroups($searchParameters);

Route4Me::simplePrint($addressBookGroups, true);