<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Example refers to the process of updating an order custom user field.

// Set the api key in the Route4me class
// This example not available for demo API key
Route4Me::setApiKey('11111111111111111111111111111111');

$orderCustomField = new OrderCustomField();

$orderCustomFieldParameters = OrderCustomField::fromArray([
    'order_custom_field_id'        => 182,
    'order_custom_field_label'     => 'ustom Field 44',
    'order_custom_field_type'      => 'checkbox',
    'order_custom_field_type_info' => ['short_label' => 'cFl44']
]);

$response = $orderCustomField->updateOrderCustomUserField($orderCustomFieldParameters);

foreach ($response as $key => $orderCustomField) {
    Route4Me::simplePrint($orderCustomField);
    echo '<br>';
}
