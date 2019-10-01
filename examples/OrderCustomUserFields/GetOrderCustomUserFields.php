<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Example refers to getting of all the order custom user fields list with details.

// Set the api key in the Route4me class
// This example not available for demo API key
Route4Me::setApiKey('11111111111111111111111111111111');

$orderCustomField = new OrderCustomField();

$orderCustomFieldParameters = OrderCustomField::fromArray([]);

$response = $orderCustomField->getOrderCustomUserFields($orderCustomFieldParameters);

foreach ($response as $key => $orderCustomField) {
    Route4Me::simplePrint($orderCustomField);
    echo '<br>';
}

