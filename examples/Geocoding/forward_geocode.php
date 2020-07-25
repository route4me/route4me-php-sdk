<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

$geoCodingParameters = [
    'strExportFormat' => 'json',
    'addresses' => 'Los20%Angeles20%International20%Airport,20%CA',
];

$fGeoCoding = new Geocoding();

$fgResult = $fGeoCoding->forwardGeocoding($geoCodingParameters);

if ('json' == $geoCodingParameters['strExportFormat']) {
    Route4Me::simplePrint($fgResult);
} else {
    Route4Me::simplePrint($fgResult['destination']);
}
