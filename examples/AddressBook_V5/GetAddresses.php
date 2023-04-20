<?php

//**********************************************************************
// Get all Addresses filtered by specifying the corresponding
// query parameters.
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
    $res = $ab->getAddresses($options);
    print_r($res);

    /////////////////////////////////////////////
    // get only the 5 fields of address
    $options = [
        'fields' => "address_id, address_1, first_name, last_name, address_city",
        'limit' => 5,
        'offset' => 0
    ];
    $res = $ab->getAddresses($options);
    print_r($res);

    /////////////////////////////////////////////
    // get the first 5 addresses from the server that match quere 'France'
    $options = [
        'query' => 'France',
        'limit' => 10,
        'offset' => 0
    ];
    $res = $ab->getAddresses($options);
    print_r($res);
} catch (ApiError $e) {
    echo $e->getCode() . PHP_EOL;
    echo $e->getMessage() . PHP_EOL;
}
