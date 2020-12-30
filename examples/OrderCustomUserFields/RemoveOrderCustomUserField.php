<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Example refers to the process of removing an order custom user field.

// Set the api key in the Route4me class
// This example not available for demo API key
Route4Me::setApiKey(Constants::API_KEY);

$orderCustomField = new OrderCustomField();

$orderCustomFieldParameters = OrderCustomField::fromArray([
    'order_custom_field_id' => 183
]);

$response = $orderCustomField->removeOrderCustomUserField($orderCustomFieldParameters);

Route4Me::simplePrint($response);
