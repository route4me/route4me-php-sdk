<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Enum\TerritoryTypes;

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Set the api key in the Route4Me class
Route4Me::setApiKey('11111111111111111111111111111111');

// Add Avoidance Zone and get territory_id
$territory = new Territory();

$territoryParams['type'] = TerritoryTypes::CIRCLE;
$territoryParams['data'] = [
    '37.569752822786455,-77.47833251953125',
    '5000',
];

$avoidanceZoneParameters = AvoidanceZone::fromArray([
    'territory_name' => 'Test Territory '.strval(rand(10000, 99999)),
    'territory_color' => 'ff7700',
    'territory' => $territoryParams,
]);

$avoidanceZone = new AvoidanceZone();

$result = (array) $avoidanceZone->addAvoidanceZone($avoidanceZoneParameters);

assert(isset($result), 'Failed to create new Avoidance Zone');

$territory_id = $result['territory_id'];

echo "New Avoidance Zone with territory_id = $territory_id created successfuly<br>";

$result1 = $avoidanceZone->getAvoidanceZone($territory_id);
var_dump($result1);die("<br>STOP<br>");
Route4Me::simplePrint($result1, true);
