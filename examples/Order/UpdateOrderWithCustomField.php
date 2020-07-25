<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// The example demonstrates process of updating an order with a custom user field by sending HTPP PUT data.

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

$orderParameters = Order::fromArray([
    'order_id'  => 65936,
    'custom_user_fields' => [
        OrderCustomField::fromArray([
            'order_custom_field_id'    => 93,
            'order_custom_field_value' => 'true'
        ])
    ]
]);

$order = new Order();

$response = $order->updateOrder($orderParameters);

Route4Me::simplePrint($response, true);
