<?php

namespace Route4Me;

use Route4Me\Enum\AddressType;

$root = realpath(dirname(__FILE__) . '/../../');
require $root . '/vendor/autoload.php';

// Example refers to creating a new Order.

// Set the api key in the Route4me class
// This example not available for demo API key
Route4Me::setApiKey(Constants::API_KEY);

$orderParameters = Order::fromArray([
    'address_1' => '1358 E Luzerne St, Philadelphia, PA 19124, US',
    'cached_lat' => 48.335991,
    'cached_lng' => 31.18287,
    'address_alias' => 'Auto test address',
    'address_city' => 'Philadelphia',
    'day_scheduled_for_YYMMDD' => date('Y-m-d'),
    'address_stop_type' => AddressType::VISIT,
]);

$order = new Order();

$response = $order->addOrder($orderParameters);

Route4Me::simplePrint($response);
