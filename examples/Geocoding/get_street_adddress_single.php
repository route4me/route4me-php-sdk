<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Example refers to getting single geocoding by sequential number.

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

$gcParameters = (array) Geocoding::fromArray([
    'pk' => 4,
]);

$geoCoding = new Geocoding();

$response = $geoCoding->getStreetData($gcParameters);

Route4Me::simplePrint($response);
