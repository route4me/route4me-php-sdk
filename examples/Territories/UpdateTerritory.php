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

// Add Avoidance Zone and get territory_id
$territory = new Territory();
$territory->type =  TerritoryTypes::CIRCLE;
$territory->data = array (
    "37.569752822786455,-77.47833251953125",
    "5000"
);

$TerritoryParameters=Territory::fromArray(array(
    "territory_name"  => "Test Territory ".strval(rand(10000,99999)),
    "territory_color" => "ff7700",
    "territory"       => $territory
));

$result = (array)$territory->addTerritory($TerritoryParameters);
assert(!is_null($result), "Can't create a territory");

$territory_id = $result["territory_id"];

echo "New Territory with territory_id = $territory_id created successfuly<br>";
echo "------------------------------------------------------------------------<br><br>";

// Update territory
$territoryParameters = array (
    "type" => TerritoryTypes::RECT,
    "data" => array(
        "29.6600127358956,-95.6593322753906",
        "29.8966150753098,-95.3146362304688"
       )
   );

$TerritoryParameters = Territory::fromArray(array(
    "territory_id"     => $territory_id,
    "territory_name"   => "Test Territory Updated as rectangle",
    "territory_color"  => "ff5500",
    "territory"        => $territoryParameters
));

$result1 = $territory->updateTerritory($TerritoryParameters);
assert(isset($result1), "Can't update the territory");

Route4Me::simplePrint($result1, true);
