<?php

//**********************************************************************
// Get all Addresses filtered and sorted by sending the corresponding
// body payload, with the option to search by the specified areas.
//**********************************************************************

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Exception\ApiError;
use Route4Me\V5\AddressBook\AddressBook;

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

try {
    $ab = new AddressBook();

    /////////////////////////////////////////////
    // get the first 5 addresses
    $options = [
        'limit' => 5,
        'offset' => 0
    ];
    $res = $ab->getAddressesByBodyPayload($options);
    print_r($res);

    /////////////////////////////////////////////
    // get the first 5 addresses in the selected area from the server
    $options = [
        'filter' => [
            'query' => 'Tusha',
            'selected_areas' => [[
                'type' => 'circle',
                'value' => [
                    'center' => [
                        'lat' => 38.024654,
                        'lng' => 77.338814
                        ],
                    'distance' => 10000
                ]
            ]]
        ],
        'limit' => 5,
        'offset' => 0
    ];
    $res = $ab->getAddressesByBodyPayload($options);
    print_r($res);
} catch (ApiError $e) {
    echo $e->getCode() . PHP_EOL;
    echo $e->getMessage() . PHP_EOL;
}
