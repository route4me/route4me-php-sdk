<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Example refers to searching of the orders by specified custom fields.

// Set the api key in the Route4me class
// This example not available for demo API key
Route4Me::setApiKey(Constants::API_KEY);

$orderParameters = Order::fromArray([
    'fields' => 'order_id,member_id',
    'offset' => 0,
    'limit' => 5,
]);

$order = new Order();

$response = $order->getOrder($orderParameters);

foreach ($response as $key => $order) {
    Route4Me::simplePrint($order);
}
