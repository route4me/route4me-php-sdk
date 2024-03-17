<?php

//**********************************************************************
// Export the Address Book Contacts located in the selected areas
// by sending the corresponding body payload.
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
        ]],
        'filename' => 'test_export.csv'
    ];

    $res = $ab->exportAddressesByAreas($filter);
    print_r($res);
} catch (ApiError $e) {
    echo $e->getCode() . PHP_EOL;
    echo $e->getMessage() . PHP_EOL;
}
