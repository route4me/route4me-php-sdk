<?php
namespace Route4Me;

$root = realpath(dirname(__FILE__) . '/../../');
require $root . '/vendor/autoload.php';

use Route4Me\Route4Me;
use Route4Me\Enum\TerritoryTypes;

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Set the api key in the Route4Me class
Route4Me::setApiKey('11111111111111111111111111111111');

// Add Avoidance Zone and get territory_id
$territory = new Territory();
$territory->type =  TerritoryTypes::CIRCLE;
$territory->data = array (
    "37.569752822786455,-77.47833251953125",
    "5000"
);

$AvoidanceZoneParameters = AvoidanceZone::fromArray(array(
    "territory_name"   => "Test Territory ".strval(rand(10000,99999)),
    "territory_color"  => "ff7700",
    "territory"        => $territory
));

$avoidancezone = new AvoidanceZone();

$result = (array)$avoidancezone->addAvoidanceZone($AvoidanceZoneParameters);

assert(isset($result), "Failed to create new Avoidance Zone");

$territory_id = $result["territory_id"];

echo "New Avoidance Zone with territory_id = $territory_id created successfuly<br>";

$territory = new Territory();
$territory->type = TerritoryTypes::RECT;
$territory->data = array (
    "37.869752822786455,-77.49833251953125",
    "5000"
);

$AvoidanceZoneParameters = array(
    "territory_id"     => $territory_id,
    "territory_name"   => "Test Territory Updated",
    "territory_color"  => "ff5500",
    "territory"        => $territory
);

$result1 = $avoidancezone->updateAvoidanceZone($AvoidanceZoneParameters);

assert(isset($result), "Cannot updated the avoidance zone with territory_id = $territory_id");

echo "Avoidance Zone with territory_id = $territory_id was updated successfuly<br>";

Route4Me::simplePrint($result1);
