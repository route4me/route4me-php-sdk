<?php
namespace Route4Me;

$root=realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Route4Me;
use Route4Me\Enum\TerritoryTypes;

// Set the api key in the Route4Me class
Route4Me::setApiKey('11111111111111111111111111111111');

$territory = new Territory();

$territoryParams['type'] = TerritoryTypes::CIRCLE;
$territoryParams['data'] = array(
    "37.569752822786455,-77.47833251953125",
    "5000"
);

$TerritoryParameters = Territory::fromArray(array(
    "territory_name"   => "Test Territory ".strval(rand(10000,99999)),
    "territory_color"  => "ff7700",
    "territory"        => $territoryParams
));

$territory = new Territory();

$result = $territory->addTerritory($TerritoryParameters);

Route4Me::simplePrint($result, true);
