<?php

namespace Route4Me;

use Exception;
use Route4Me\V5\Orders\Orders;
use Route4Me\V5\Orders\Order;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// An example of searching orders.

// Set the api key in the Route4me class
// This example is not available for demo API key
Route4Me::setApiKey(Constants::API_KEY);

try {
    $orders = new Orders();

    // Get all the orders created under the specific Route4Me account
    $ordersAll = $orders->search();

    // Search orders by known IDs
    $params = [
        "filters" => [
            "order_ids" => ["B3CBB9C07D37406997EE73D9CEC18264", "D91F4962CC4C468A9563896A93DBE4D7"]
        ]
    ];
    $ordersByIds = $orders->search($params);

    // Search all the orders with specific address_alias, return only specific fields in response.
    $params = [
        "return_provided_fields_as_map" => true,
        "fields" => ["order_uuid", "address_alias", "email", "first_name", "phone"],
        "search" => [
            "matches" => ["address_alias" => "Auto test address"]
        ]
    ];
    $ordersWithAddress = $orders->search($params);

    print_r($ordersWithAddress);
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . PHP_EOL;
}
