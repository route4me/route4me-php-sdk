<?php

namespace Route4Me;

use Exception;
use Route4Me\Exception\ApiError;
use Route4Me\V5\Orders\Order;
use Route4Me\V5\Orders\Orders;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Example refers to getting of an order details by UUID.

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
    $orderId = $newOrder->order_id;
    $orderUuid = $newOrder->order_uuid;
    echo "Create Order with id='" . $orderId . "' and uuid='" . $orderUuid . "'" . PHP_EOL;

    // get order by ID
    $orderById = $orders->get($orderId);
    echo "Read Order by id, id='" . $orderId . "' and uuid='" . $orderUuid . "'" . PHP_EOL;

    // get order by UUID
    $orderByUuid = $orders->get($orderUuid);
    echo "Read Order by uuid, id='" . $orderId . "' and uuid='" . $orderUuid . "'" . PHP_EOL;

    // compare orders
    if ($orderById == $orderByUuid) {
        echo "The Orders are equal." . PHP_EOL;
    } else {
        echo "The Orders are not equal." . PHP_EOL;
    }

    // delete order
    if ($orders->delete($orderUuid)) {
        echo "Order with uuid='" . $orderUuid . "' was deleted successful." . PHP_EOL;
    } else {
        echo "Order with uuid='" . $orderUuid . "' was not deleted." . PHP_EOL;
    }
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . PHP_EOL;

    if ($orders && $orderId) {
        try {
            $orders->delete($orderUuid);
            echo "Order with uuid='" . $orderUuid . "' was cleaned up successful." . PHP_EOL;
        } catch (Exception $e) {
            echo "Order with uuid='" . $orderUuid . "' was not cleaned up." . PHP_EOL;
        }
    }
}
