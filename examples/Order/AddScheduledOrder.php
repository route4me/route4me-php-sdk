<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Set the api key in the Route4me class
// This example not available for demo API key
Route4Me::setApiKey(Constants::API_KEY);

$orderParameters = Order::fromArray([
    'address_1' => '318 S 39th St, Louisville, KY 40212, USA',
    'cached_lat' => 38.259326,
    'cached_lng' => -85.814979,
    'curbside_lat' => 38.259326,
    'curbside_lng' => -85.814979,
    'address_alias' => '318 S 39th St 40212',
    'address_city' => 'Louisville',
    'EXT_FIELD_first_name' => 'Lui',
    'EXT_FIELD_last_name' => 'Carol',
    'EXT_FIELD_email' => 'lcarol654@yahoo.com',
    'EXT_FIELD_phone' => '897946541',
    'EXT_FIELD_custom_data' => ['order_type' => 'scheduled order'],
    'day_scheduled_for_YYMMDD' => date('Y-m-d'),
    'local_time_window_end' => 39000,
    'local_time_window_end_2' => 46200,
    'local_time_window_start' => 37800,
    'local_time_window_start_2' => 45000,
    'local_timezone_string' => 'America/New_York',
    'order_icon' => 'emoji/emoji-bank',
]);

$order = new Order();

$response = $order->addOrder($orderParameters);

Route4Me::simplePrint($response);
