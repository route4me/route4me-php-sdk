<?php
namespace Route4Me;

$root=realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Route4Me;
use Route4Me\Order;

// Example refers to getting of orders list with details.

// Set the api key in the Route4me class
// This example not available for demo API key
Route4Me::setApiKey('11111111111111111111111111111111');

$order = new Order();

$orderParameters=Order::fromArray(array(
    "offset" => 0,
    'limit'  => 5,
));

$response = $order->getOrders($orderParameters);

foreach ($response['results'] as $key => $order) {
    Route4Me::simplePrint($order);
    echo "<br>";
}
