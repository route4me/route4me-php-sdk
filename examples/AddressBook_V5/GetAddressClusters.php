<?php

//**********************************************************************
// Get the Address clusters filtered by the corresponding query text,
// and with the option to filter the result by the 'routed' and 'unrouted' state.
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
    // get the clusters of unrouted addresses that match quere 'France'
    $options = [
        'display' => 'unrouted',
        'query' => 'France'
    ];
    $res = $ab->getAddressClusters($options);
    print_r($res);
} catch (ApiError $e) {
    echo $e->getCode() . PHP_EOL;
    echo $e->getMessage() . PHP_EOL;
}
