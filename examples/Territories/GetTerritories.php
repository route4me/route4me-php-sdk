<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Set the api key in the Route4Me class
Route4Me::setApiKey(Constants::API_KEY);

$territory = new Territory();

$queryParameters = [
    'offset' => 0,
    'limit' => 20,
];

$response = $territory->getTerritories($queryParameters);

foreach ($response as $terr1) {
    Route4Me::simplePrint($terr1, true);
    echo '<br>';
}
