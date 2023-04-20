<?php

//**********************************************************************
// Delete multiple Address Book Contacts by sending a body payload with
// the array of the corresponding Address IDs.
//**********************************************************************

namespace Route4Me;

$root = realpath(dirname(__FILE__) . '/../../');
require $root . '/vendor/autoload.php';

use Route4Me\Exception\ApiError;
use Route4Me\V5\AddressBook\AddressBook;

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

try {
    $ab = new AddressBook();

    $addressIds = [96100573, 96100961];
    $res = $ab->deleteAddressesByIds($addressIds);
    print_r($res);
} catch (ApiError $e) {
    echo $e->getCode() . PHP_EOL;
    echo $e->getMessage() . PHP_EOL;
}
