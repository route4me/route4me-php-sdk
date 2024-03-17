<?php

//**********************************************************************
// Add a new Address Book Contact by sending a body payload with
// the corresponding parameters.
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
    // add adress from array
    $params = [
        'address_1' => '17205 RICHMOND TNPK, MILFORD, VA, 22514',
        'cached_lat' => 38.024654,
        'cached_lng' => 77.338814,
        'address_stop_type' => 'DELIVERY',
        'address_city' => 'Tbilisi Vah',
        'first_name' => 'Tusha',
        'last_name' => 'Grigoriani'
    ];
    $res = $ab->addAddress($params);
    print_r($res);

    /////////////////////////////////////////////
    // add adress from Address and array
    $params['address_stop_type'] = 'VISIT';
    $address = new Address($params);
    $res = $ab->addAddress($address);
    print_r($res);

    /////////////////////////////////////////////
    // add adress from Address
    $address = new Address('17205 Tbilisi Vah, GEORGIAN, GE, 22514', 38.024654, 77.338814, 'DELIVERY');
    $res = $ab->addAddress($address);
    print_r($res);
} catch (ApiError $e) {
    echo $e->getCode() . PHP_EOL;
    echo $e->getMessage() . PHP_EOL;
}
