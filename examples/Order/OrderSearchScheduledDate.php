<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Example refers to searching of the orders by specified scheduled date.

// Set the api key in the Route4me class
// This example not available for demo API key
Route4Me::setApiKey(Constants::API_KEY);

$orderParameters = Order::fromArray([
    'scheduled_for_YYMMDD' => date('Y-m-d', strtotime('-1 days')),
    'offset' => 0,
    'limit' => 5,
]);

$order = new Order();

$response = $order->getOrder($orderParameters);

foreach ($response['results'] as $key => $order) {
    Route4Me::simplePrint($order);
    echo '<br>';
}
