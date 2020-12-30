<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Example refers to the process of creating an order custom user field.

// Set the api key in the Route4me class
// This example not available for demo API key
Route4Me::setApiKey(Constants::API_KEY);

$orderCustomField = new OrderCustomField();

$orderCustomFieldParameters = OrderCustomField::fromArray([
    'order_custom_field_name'      => 'CustomField4',
    'order_custom_field_label'     => 'Custom Field 4',
    'order_custom_field_type'      => 'checkbox',
    'order_custom_field_type_info' => ['short_label' => 'cFl4']
]);

$response = $orderCustomField->addOrderCustomUserField($orderCustomFieldParameters);

foreach ($response as $key => $orderCustomField) {
    Route4Me::simplePrint($orderCustomField);
    echo '<br>';
}
