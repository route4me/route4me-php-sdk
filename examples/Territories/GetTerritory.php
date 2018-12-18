<?php
namespace Route4Me;

$root=realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Route4Me;
use Route4Me\Enum\TerritoryTypes;

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Set the api key in the Route4Me class
Route4Me::setApiKey('11111111111111111111111111111111');

// Add Territory and get territory_id
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

$result = (array)$territory->addTerritory($TerritoryParameters);

assert(!is_null($result), "Can't create a territory");
assert(isset($result["territory_id"]), "Can't create a territory");

$territory_id = $result["territory_id"];

echo "New Territory with territory_id = $territory_id created successfuly<br>";
echo "------------------------------------------------------------------------<br><br>";

$params = array(
    "territory_id" => $territory_id
);

$result1 = $territory->getTerritory($params);

Route4Me::simplePrint($result1, true);
