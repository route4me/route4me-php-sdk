<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Example refers to getting of an order details.

// Set the api key in the Route4me class
// This example is not available for demo API key
Route4Me::setApiKey('11111111111111111111111111111111');

// GEt random order ID
$order = new Order();

$orderID = $order->getRandomOrderId(0, 10);

assert(!is_null($orderID), "Cannot retrieve a random order ID");

// Get an order
$orderParameters = Order::fromArray([
    'order_id' => $orderID,
]);

$response = $order->getOrder($orderParameters);

Route4Me::simplePrint($response);
