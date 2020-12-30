<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// The example demonstrates process of creating an order with a custom user field by sending HTPP POST data.

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

$orderParameters = Order::fromArray([
    'address_1'                => '1358 E Luzerne St, Philadelphia, PA 19124, US',
    'cached_lat'               => 48.335991,
    'cached_lng'               => 31.18287,
    'day_scheduled_for_YYMMDD' => '2019-10-11',
    'address_alias'            => 'Auto test address',
    'custom_user_fields' => [
        OrderCustomField::fromArray([
                'order_custom_field_id'    => 93,
                'order_custom_field_value' => 'false'
            ])
    ]
]);

$order = new Order();

$response = $order->addOrder($orderParameters);

Route4Me::simplePrint($response, true);