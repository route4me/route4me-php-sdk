<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Example refers to getting all geocodings with specified zipcode and house number.

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

$gcParameters = (array) Geocoding::fromArray([
    'zipcode' => '00601',
    'housenumber' => 17,
]);

$geoCoding = new Geocoding();

$response = $geoCoding->getService($gcParameters);

foreach ($response as $gCode) {
    Route4Me::simplePrint($gCode);
    echo '<br>';
}
