<?php
namespace Route4Me;

$root = realpath(dirname(__FILE__) . '/../../');
require $root . '/vendor/autoload.php';

use Route4Me\Route4Me;
use Route4Me\Enum\TerritoryTypes;

// Set the api key in the Route4Me class
Route4Me::setApiKey('11111111111111111111111111111111');

// Example refers to the process of creating Avoidance Zone with circle shape

$territory = new Territory();
$territory->type = TerritoryTypes::CIRCLE;
$territory->data = array (
    "37.569752822786455,-77.47833251953125",
    "5000"
);

$AvoisanceZoneParameters = AvoidanceZone::fromArray(array(
    "territory_name"   => "Test Circle Avoidance Zone ".strval(rand(10000,99999)),
    "territory_color"  => "ff7700",
    "territory"        => $territory
));

$avoidancezone = new AvoidanceZone();

$result = $avoidancezone->addAvoidanceZone($AvoisanceZoneParameters);

Route4Me::simplePrint($result);
