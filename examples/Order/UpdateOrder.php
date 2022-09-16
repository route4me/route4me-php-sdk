<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Example refers to updating an order.

// Set the api key in the Route4me class
// This example not available for demo API key
Route4Me::setApiKey(Constants::API_KEY);

// Get random order
$order = new Order();

$randomOrder = $order->getRandomOrder(0, 30);

assert(!is_null($randomOrder), "Cannot retrieve a random order");

// Update the order
$randomOrder['address_2'] = 'Lviv';
$randomOrder['EXT_FIELD_phone'] = '032268593';
$randomOrder['EXT_FIELD_custom_data'] = [
               'customer_no' => '11'
        ];

$response = $order->updateOrder($randomOrder);

Route4Me::simplePrint($response, true);
