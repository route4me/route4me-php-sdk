<?php
namespace Route4Me;

$root = realpath(dirname(__FILE__) . '/../../');
require $root . '/vendor/autoload.php';

use Route4Me\Route4Me;
use Route4Me\Geocoding;

// Example refers to getting single geocoding by sequential number.

// Set the api key in the Route4me class
Route4Me::setApiKey('11111111111111111111111111111111');

$gcParameters=(array)Geocoding::fromArray(array(
    "pk" => 4
));

$geocoding = new Geocoding();

$response = $geocoding->getStreetData($gcParameters);

Route4Me::simplePrint($response);

    