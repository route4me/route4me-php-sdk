<?php
namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Route4Me;
use Route4Me\Enum\TerritoryTypes;

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Set the api key in the Route4Me class
Route4Me::setApiKey('11111111111111111111111111111111');

// Add Avoidance Zone and get territory_id
$territory = new Territory();

$territoryParams['type'] = TerritoryTypes::CIRCLE;
$territoryParams['data'] = array(
    "37.569752822786455,-77.47833251953125",
    "5000"
);

$AvoisanceZoneParameters = AvoidanceZone::fromArray(array(
    "territory_name"   => "Test Territory ".strval(rand(10000, 99999)),
    "territory_color"  => "ff7700",
    "territory"        => $territoryParams
));

$avoidancezone = new AvoidanceZone();

$result = (array)$avoidancezone->addAvoidanceZone($AvoisanceZoneParameters);

assert(isset($result), "Failed to create new Avoidance Zone");

$territory_id = $result["territory_id"];

echo "New Avoidance Zone with territory_id = $territory_id created successfuly<br>";

$result1 = $avoidancezone->deleteAvoidanceZone($territory_id);

assert(isset($result), "Failed to delete the avoidance zone with territory_id = ".$territory_id);

echo "Avoidance Zone with territory_id = $territory_id was deleted successfuly<br>";

Route4Me::simplePrint($result1);
