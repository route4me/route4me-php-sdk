<?php

namespace Route4Me;

use Exception;
use Route4Me\V5\Orders\Orders;
use Route4Me\V5\Orders\CustomField;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// An example of creating, reading, changing and deleting an order.

// Set the api key in the Route4me class
// This example is not available for demo API key
Route4Me::setApiKey(Constants::API_KEY);

$customField = new CustomField([
    'order_custom_field_name' => 'CustomField1',
    'order_custom_field_label' => 'Custom Field 1',
    'order_custom_field_type' => 'checkbox',
    'order_custom_field_type_info' => [
        'short_label' => 'cFl1'
    ]
]);

print_r($customField);

$orders = null;
$uuid = null;

try {
    $orders = new Orders();

    // create custom field
    $newField = $orders->createOrderCustomField($customField);
    $uuid = $newField->order_custom_field_uuid;
    echo "Create Custom field, label is '" . $newField->order_custom_field_label . "'" . PHP_EOL;

    // update custom field
    $customField->order_custom_field_label = 'Custom Field New';
    $updateField = $orders->updateOrderCustomField($uuid, $customField);
    echo "Update Custom field, label is '" . $updateField->order_custom_field_label . "'" . PHP_EOL;

    // read custom fields
    $readFields = $orders->getOrderCustomFields();
    foreach ($readFields as $key => $field) {
        if ($field->order_custom_field_uuid === $uuid) {
            echo "Found Custom field with label '" . $field->order_custom_field_label . "'" . PHP_EOL;
            break;
        }
    }
    // delete custom field
    if ($orders->deleteOrderCustomField($uuid)) {
        echo "Custom field with uuid='" . $uuid . "' was deleted successful." . PHP_EOL;
    } else {
        echo "Custom field with uuid='" . $uuid . "' was not deleted." . PHP_EOL;
    }
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . PHP_EOL;

    if ($orders && $uuid) {
        try {
            $orders->deleteOrderCustomField($uuid);
            echo "Custom field with uuid='" . $uuid . "' was cleaned up successful." . PHP_EOL;
        } catch (Exception $e) {
            echo "Custom field with uuid='" . $uuid . "' was not cleaned up." . PHP_EOL;
        }
    }
}
