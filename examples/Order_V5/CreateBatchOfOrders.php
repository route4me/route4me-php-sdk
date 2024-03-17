<?php

namespace Route4Me;

use Exception;
use Route4Me\V5\Orders\Orders;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// An example of creating a batch of orders.

// Set the api key in the Route4me class
// This example is not available for demo API key
Route4Me::setApiKey(Constants::API_KEY);

$ordersParams = [
    [
        'address_1' => '1358 E Luzerne St, Philadelphia, PA 19124, US',
        'address_alias' => 'Address for batch workflow 0',
        'address_city' => 'Philadelphia',
        'address_geo' => [
            'lat' => 48.335991,
            'lng' => 31.18287
        ],
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'some@company.com'
    ], [
        'address_1' => '1358 E Luzerne St, Philadelphia, PA 19124, US',
        'address_alias' => 'Address for batch workflow 1',
        'address_city' => 'Philadelphia',
        'address_geo' => [
            'lat' => 48.335991,
            'lng' => 31.18287
        ],
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'some@company.com'
    ]
];

try {
    $orders = new Orders();

    // create a batch of orders
    $res = $orders->batchCreate($ordersParams);
    if ($res) {
        echo "Create a batch of orders." . PHP_EOL;
    } else {
        echo "Error to create a batch of orders." . PHP_EOL;
    }
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . PHP_EOL;
}
