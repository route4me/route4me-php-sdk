<?php
namespace Route4Me;

$root = realpath(dirname(__FILE__) . '/../../');
require $root . '/vendor/autoload.php';

use Route4Me\Route4Me;
use Route4Me\Route;

// Example refers to the process of batch geocoding of the addresses

// Set the api key in the Route4me class
Route4Me::setApiKey('11111111111111111111111111111111');

$addressList = array(
    "Los Angeles International Airport, CA",
    "n512,Florida Pl,Barberton,OH,44203",
    "3495,Purdue St,Cuyahoga Falls,OH,44221"
);

$addressesString = implode('\n', $addressList);

$geocodingParameters = array(
    'strExportFormat'  => 'json',
    'addresses'        => $addressesString
);

$fGeoCoding = new Geocoding();

$bgResults = $fGeoCoding->forwardGeocoding($geocodingParameters);

if ($geocodingParameters['strExportFormat'] == 'json') {
    foreach ($bgResults as $bgResult) {
        Route4Me::simplePrint($bgResult);
        echo "<br>";
    } 
} else {
    foreach ($bgResults['destination'] as $bgResult) {
        Route4Me::simplePrint($bgResult);
        echo "<br>";
    } 
} 
