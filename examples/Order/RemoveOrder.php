<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Example refers to adding of an order to a route.

// Set the api key in the Route4me class
// This example not available for demo API key
Route4Me::setApiKey('11111111111111111111111111111111');

// Get 2 random orders IDs
$order = new Order();

$randomOrderID1 = $order->getRandomOrderId(0, 30);
assert(!is_null($randomOrderID1), "Cannot retrieve 1st random order ID");

$randomOrderID2 = $order->getRandomOrderId(0, 30);
assert(!is_null($randomOrderID2), "Cannot retrieve 2nd random order ID");

echo "Random order ID 1 -> $randomOrderID1 <br> Random order ID 2 -> $randomOrderID2 <br>";

// Remove 2 random orders
$orderParameters = Order::fromArray([
    'order_ids' => [
        0 => $randomOrderID1,
        1 => $randomOrderID2,
      ],
]);

$response = $order->removeOrder($orderParameters);

Route4Me::simplePrint($response);
