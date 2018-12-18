<?php
namespace Route4Me;

$root = realpath(dirname(__FILE__) . '/../../');
require $root . '/vendor/autoload.php';

use Route4Me\Route4Me;
use Route4Me\Enum\TerritoryTypes;

// Set the api key in the Route4Me class
Route4Me::setApiKey('11111111111111111111111111111111');

// Example refers to the process of creating Avoidance Zone with rectangular shape

$territory = new Territory();

$territoryParams['type'] = TerritoryTypes::RECT;
$territoryParams['data'] = array(
    "43.51668853502909,-109.3798828125",
    "46.98025235521883,-101.865234375"
);

$AvoidanceZoneParameters = AvoidanceZone::fromArray(array(
    "territory_name"   => "Test Rectangular Avoidance Zone ".strval(rand(10000,99999)),
    "territory_color"  => "ff7700",
    "territory"        => $territoryParams
));

$avoidancezone = new AvoidanceZone();

$result = $avoidancezone->addAvoidanceZone($AvoidanceZoneParameters);

Route4Me::simplePrint($result, true);
