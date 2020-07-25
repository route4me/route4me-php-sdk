<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Example refers to getting of orders list with details.

// Set the api key in the Route4me class
// This example not available for demo API key
Route4Me::setApiKey(Constants::API_KEY);

$order = new Order();

$orderParameters = Order::fromArray([
    'offset' => 0,
    'limit' => 5,
]);

$response = $order->getOrders($orderParameters);

foreach ($response['results'] as $key => $order) {
    Route4Me::simplePrint($order);
    echo '<br>';
}
