<?php

//**********************************************************************
// Add multiple new Address Book Contacts by sending a body payload
// with the array of the corresponding Address parameters.
//**********************************************************************

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Exception\ApiError;
use Route4Me\V5\AddressBook\Address;
use Route4Me\V5\AddressBook\AddressBook;

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

try {
    $ab = new AddressBook();

    /////////////////////////////////////////////
    // add 2 adresses from array
    $arr = [[
        'address_1' => '17205 RICHMOND TNPK, MILFORD, VA, 22514',
        'cached_lat' => 38.024654,
        'cached_lng' => 77.338814,
        'address_stop_type' => 'DELIVERY',
        'address_city' => 'Tbilisi Vah',
        'first_name' => 'Tusha',
        'last_name' => 'Grigoriani I'
    ], [
        'address_1' => '17205 RICHMOND TNPK, MILFORD, VA, 22514',
        'cached_lat' => 38.024654,
        'cached_lng' => 77.338814,
        'address_stop_type' => 'DELIVERY',
        'address_city' => 'Tbilisi Vah',
        'first_name' => 'Tusha',
        'last_name' => 'Grigoriani II'
    ]];
    $res = $ab->addMultipleAddresses($arr);
    print_r($res);

    /////////////////////////////////////////////
    // add 2 adresses from Address
    $arr = [
        new Address('17205 Tbilisi Vah, GEORGIAN, GE, 22514', 38.024654, 77.338814, 'DELIVERY'),
        new Address('17206 Tbilisi Vah, GEORGIAN, GE, 22515', 38.024654, 77.338814, 'VISIT')
    ];
    $res = $ab->addMultipleAddresses($arr);
    print_r($res);
} catch (ApiError $e) {
    echo $e->getCode() . PHP_EOL;
    echo $e->getMessage() . PHP_EOL;
}
