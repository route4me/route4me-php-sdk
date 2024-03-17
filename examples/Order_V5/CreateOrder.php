<?php

namespace Route4Me;

use Exception;
use Route4Me\V5\Orders\Orders;
use Route4Me\V5\Orders\Order;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// An example of creating, reading, changing and deleting an order.

// Set the api key in the Route4me class
// This example is not available for demo API key
Route4Me::setApiKey(Constants::API_KEY);

$order = new Order([
    'address_1' => '1358 E Luzerne St, Philadelphia, PA 19124, US',
    'address_alias' => 'Auto test address',
    'address_city' => 'Philadelphia',
    'address_geo' => [
        'lat' => 48.335991,
        'lng' => 31.18287
    ],
    'first_name' => 'John',
    'last_name' => 'Doe',
    'email' => 'some@company.com'
]);

$orders = null;
$orderId = null;

try {
    $orders = new Orders();

    // create order
    $newOrder = $orders->create($order);
    $orderId = $newOrder->order_uuid;
    echo "Create Order with uuid='" . $orderId . "'" . PHP_EOL;

    // read order
    $readOrder = $orders->get($orderId);
    echo "Read Order first_name is '" . $readOrder->first_name . "'" . PHP_EOL;

    // update order
    $params = [
        'first_name' => 'Jane'
    ];
    $updateOrder = $orders->update($orderId, $params);
    echo "Update Order first_name is '" . $updateOrder->first_name . "'" . PHP_EOL;
    
    // delete order
    if ($orders->delete($orderId)) {
        echo "Order with uuid='" . $orderId . "' was deleted successful." . PHP_EOL;
    } else {
        echo "Order with uuid='" . $orderId . "' was not deleted." . PHP_EOL;
    }
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . PHP_EOL;

    if ($orders && $orderId) {
        try {
            $orders->delete($orderId);
            echo "Order with uuid='" . $orderId . "' was cleaned up successful." . PHP_EOL;
        } catch (Exception $e) {
            echo "Order with uuid='" . $orderId . "' was not cleaned up." . PHP_EOL;
        }
    }
}
