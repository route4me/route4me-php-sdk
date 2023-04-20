<?php

//**********************************************************************
// Update Address Book Contacts by sending a body payload with the
// corresponding query text and specified territory areas.
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
    // update adresses in circle aria
    $filter = [
        'query' => "Tusha",
        'bounding_box' => null,
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
    ];

    $params = [
        'last_name' => 'Grigoriani VII'
    ];
    $res = $ab->updateAddressesByAreas($filter, $params);
    print_r($res);
} catch (ApiError $e) {
    echo $e->getCode() . PHP_EOL;
    echo $e->getMessage() . PHP_EOL;
}
