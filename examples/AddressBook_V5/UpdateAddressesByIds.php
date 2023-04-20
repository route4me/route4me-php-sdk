<?php

//**********************************************************************
// Update multiple Address Book Contacts by sending a body payload with
// the array of the corresponding Address IDs and Address parameters.
//**********************************************************************

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Exception\ApiError;
use Route4Me\V5\AddressBook\UpdateAddress;
use Route4Me\V5\AddressBook\AddressBook;

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

try {
    $ab = new AddressBook();

    /////////////////////////////////////////////
    // update adress's by array
    $addressIds = [96121941, 96122542, 96100576];
    $params = [
        'service_time' => 16,
        'last_name' => 'Grigoriani V',
        'address_phone_number' => '+1234567890'
    ];
    $res = $ab->updateAddressesByIds($addressIds, $params);
    print_r($res);

    /////////////////////////////////////////////
    // update adress's by object UpdateAddress
    $addressIds = [96121941, 96122542, 96100576];
    $address = new UpdateAddress(17);
    $address->last_name = 'Grigoriani VI';
    $address->address_phone_number = '+0987654321';
    $res = $ab->updateAddressesByIds($addressIds, $address);
    print_r($res);
} catch (ApiError $e) {
    echo $e->getCode() . PHP_EOL;
    echo $e->getMessage() . PHP_EOL;
}
