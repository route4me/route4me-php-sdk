<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Enum\TerritoryTypes;

// Set the api key in the Route4Me class
Route4Me::setApiKey(Constants::API_KEY);

// Example refers to the process of creating Territory with rectangular shape

$territory = new Territory();

$territoryParams['type'] = TerritoryTypes::RECT;
$territoryParams['data'] = [
    '43.51668853502909,-109.3798828125',
    '46.98025235521883,-101.865234375',
];

$TerritoryParameters = Territory::fromArray([
    'territory_name'    => 'Test Rectangular Territory '.strval(rand(10000, 99999)),
    'territory_color'   => 'ff7700',
    'territory'         => $territoryParams,
]);

$territory = new Territory();

$result = $territory->addTerritory($TerritoryParameters);

Route4Me::simplePrint($result, true);
