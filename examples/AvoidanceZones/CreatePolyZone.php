<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Enum\TerritoryTypes;

// Set the api key in the Route4Me class
Route4Me::setApiKey(Constants::API_KEY);

// Example refers to the process of creating Avoidance Zone with polygonal shape

$territory = new Territory();

$territoryParams['type'] = TerritoryTypes::POLY;
$territoryParams['data'] = [
    '37.769752822786455,-77.67833251953125',
        '37.75886716305343,-77.68974800109863',
        '37.74763966054455,-77.6917221069336',
        '37.74655084306813,-77.68863220214844',
        '37.7502255383101,-77.68125076293945',
        '37.74797991274437,-77.67498512268066',
        '37.73327960206065,-77.6411678314209',
        '37.74430510679532,-77.63172645568848',
        '37.76641925847049,-77.66846199035645',
];

$AvoidanceZoneParameters = AvoidanceZone::fromArray([
    'territory_name' => 'Test Polygonal Avoidance Zone '.strval(rand(10000, 99999)),
    'territory_color' => 'ff7700',
    'territory' => $territoryParams,
]);

$avoidanceZone = new AvoidanceZone();

$result = $avoidanceZone->addAvoidanceZone($AvoidanceZoneParameters);

Route4Me::simplePrint($result, true);
