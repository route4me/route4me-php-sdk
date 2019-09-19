<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Example refers to searching of the orders for specified text containing in any field.

// Set the api key in the Route4me class
// This example not available for demo API key
Route4Me::setApiKey('11111111111111111111111111111111');

$orderParameters = Order::fromArray([
    'query' => 'Auto',
    'offset' => 0,
    'limit' => 5,
]);

$order = new Order();

$response = $order->getOrder($orderParameters);

foreach ($response['results'] as $key => $order) {
    Route4Me::simplePrint($order);
    echo '<br>';
}
