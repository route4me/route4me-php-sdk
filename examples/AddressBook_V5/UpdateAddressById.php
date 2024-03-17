<?php

//**********************************************************************
// Update the Address Book Contact by specifying the 'address_id'
// path parameter and by sending a body payload with the corresponding
// Address parameters.
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
    // update adress's last_name
    $addressId = 96100576;
    $params = [
        'last_name' => 'Grigoriani III'
    ];
    $res = $ab->updateAddressById($addressId, $params);
    print_r($res);
} catch (ApiError $e) {
    echo $e->getCode() . PHP_EOL;
    echo $e->getMessage() . PHP_EOL;
}
