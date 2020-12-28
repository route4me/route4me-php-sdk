<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Example refers to getting limited number of geocodings wirh specified zipcode.

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

$gcParameters = (array) Geocoding::fromArray([
    'zipcode'   => '00601',
    'offset'    => 0,
    'limit'     => 20,
]);

$geoCoding = new Geocoding();

$response = $geoCoding->getZipCode($gcParameters);

foreach ($response as $gCode) {
    Route4Me::simplePrint($gCode);
    echo '<br>';
}
