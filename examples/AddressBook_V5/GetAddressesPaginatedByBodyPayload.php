<?php

//**********************************************************************
// Get the paginated list of all Addresses filtered and sorted by sending
// the corresponding body payload, with the option to search by the specified areas.
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
    // get the first page of addresses from server
    $res = $ab->getAddressesPaginatedByBodyPayload();
    print_r($res);

    /////////////////////////////////////////////
    // get only the 5 fields of addresses from server
    $options = [
        'fields' => ['address_id', 'address_1', 'first_name', 'last_name', 'address_city'],
        'page' => 2,
        'per_page' => 10
    ];
    $res = $ab->getAddressesPaginatedByBodyPayload($options);
    print_r($res);

    /////////////////////////////////////////////
    // get the first 5 addresses in the selected area from the server
    $options = [
        'filter' => [
            'selected_areas' => [[
                'type' => 'circle',
                'value' => [
                    'center' => [
                        'lat' => 52.4025,
                        'lng' => 4.5601
                    ],
                    'distance' => 10000
                ]
            ]]
        ],
        'page' => 2,
        'per_page' => 10
    ];
    $res = $ab->getAddressesPaginatedByBodyPayload($options);
    print_r($res);
} catch (ApiError $e) {
    echo $e->getCode() . PHP_EOL;
    echo $e->getMessage() . PHP_EOL;
}
