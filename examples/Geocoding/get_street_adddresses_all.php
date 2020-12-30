<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Example refers to getting all geocodings.

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

$gcParameters = [];

$geoCoding = new Geocoding();

$response = $geoCoding->getStreetData($gcParameters);

foreach ($response as $gCode) {
    Route4Me::simplePrint($gCode);
    echo '<br>';
}
