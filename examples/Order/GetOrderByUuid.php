<?php

namespace Route4Me;

use Exception;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Example refers to getting of an order details by UUID.

// Set the api key in the Route4me class
// This example is not available for demo API key
Route4Me::setApiKey(Constants::API_KEY);

$orderParams = Order::fromArray([
    'address_1'                 => '1358 E Luzerne St, Philadelphia, PA 19124, US',
    'cached_lat'                => 48.335991,
    'cached_lng'                => 31.18287,
    'address_alias'             => 'Auto test address',
    'address_city'              => 'Philadelphia',
    'EXT_FIELD_first_name'      => 'John',
    'EXT_FIELD_last_name'       => 'Doe',
    'EXT_FIELD_email'           => 'some@company.com'
]);

$order = null;
$orderId = null;

try {
    $order = new Order();

    // create order
    $newOrder = $order->addOrder($orderParams);
    $orderId = $newOrder['order_id'];
    $orderUuid = $newOrder['order_uuid'];
    echo "Create Order with id='" . $orderId . "' and uuid='" . $orderUuid . "'" . PHP_EOL;

    // get order by ID
    $orderById = $order->getOrder(['order_id' => $orderId]);
    echo "Read Order by id, id='" . $orderId . "' and uuid='" . $orderUuid . "'" . PHP_EOL;

    // get order by UUID
    $orderByUuid = $order->getOrder(['order_id' => $orderUuid]);
    echo "Read Order by uuid, id='" . $orderId . "' and uuid='" . $orderUuid . "'" . PHP_EOL;

    // compare orders
    if ($orderById == $orderByUuid) {
        echo "The Orders are equal." . PHP_EOL;
    } else {
        echo "The Orders are not equal." . PHP_EOL;
    }

    // delete order
    $res = $order->removeOrder(['order_ids' => [$orderUuid]]);
    if ($res) {
        echo "Order with uuid='" . $orderUuid . "' was deleted successful." . PHP_EOL;
    } else {
        echo "Order with uuid='" . $orderUuid . "' was not deleted." . PHP_EOL;
    }
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . PHP_EOL;

    if ($order && $orderId) {
        try {
            $order->removeOrder(['order_ids' => [$orderUuid]]);
            echo "Order with uuid='" . $orderUuid . "' was cleaned up successful." . PHP_EOL;
        } catch (Exception $e) {
            echo "Order with uuid='" . $orderUuid . "' was not cleaned up." . PHP_EOL;
        }
    }
}
