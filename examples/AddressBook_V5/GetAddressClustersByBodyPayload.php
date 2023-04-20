<?php

//**********************************************************************
// Get the Address clusters by sending the corresponding body payload.
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
    // get the clusters with precision 1
    $options = [
        'clustering' => [
            'precision' => 1
        ]
    ];
    $res = $ab->getAddressClustersByBodyPayload($options);
    print_r($res);

    /////////////////////////////////////////////
    // get the clusters with precision 2 from selected area
    $options = [
        'clustering' => [
            'precision' => 2
        ],
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
        ]
    ];
    $res = $ab->getAddressClustersByBodyPayload($options);
    print_r($res);
} catch (ApiError $e) {
    echo $e->getCode() . PHP_EOL;
    echo $e->getMessage() . PHP_EOL;
}
