<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Set the api key in the Route4Me class
Route4Me::setApiKey(Constants::API_KEY);

$avoidanceZone = new AvoidanceZone();

$queryParameters = [];

$avZones = $avoidanceZone->getAvoidanceZones($queryParameters);

foreach ($avZones as $avZone) {
    Route4Me::simplePrint($avZone);
    echo '<br>';
}
