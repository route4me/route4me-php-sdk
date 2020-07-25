<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

$geoCodingParameters = [
    'format' => 'json',
    'addresses' => '42.35863,-71.05670',
];

$fGeoCoding = new Geocoding();

$fgResult = $fGeoCoding->reverseGeocoding($geoCodingParameters);

if ('json' == $geoCodingParameters['format']) {
    foreach ($fgResult as $dest) {
        Route4Me::simplePrint($dest);
        echo '<br>';
    }
} else {
    foreach ($fgResult['destination'] as $dest) {
        Route4Me::simplePrint($dest);
        echo '<br>';
    }
}
