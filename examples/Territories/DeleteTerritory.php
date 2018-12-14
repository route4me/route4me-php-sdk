<?php
namespace Route4Me;

$root=realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Route4Me;
use Route4Me\Enum\TerritoryTypes;

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

$root=realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Set the api key in the Route4Me class
Route4Me::setApiKey('11111111111111111111111111111111');

// Create a territory and get territory_id
$territory = new Territory();
$territory->type = TerritoryTypes::CIRCLE;
$territory->data = array (
    "37.569752822786455,-77.47833251953125",
    "5000"
);

$TerritoryParameters = Territory::fromArray(array(
    "territory_name"   => "Test Territory ".strval(rand(10000,99999)),
    "territory_color"  => "ff7700",
    "territory"        => $territory
));

$territory = new Territory();

$result = (array)$territory->addTerritory($TerritoryParameters);

assert(!is_null($result), "Can't create a territory");
assert(isset($result["territory_id"]), "Can't create a territory");

$territory_id = $result["territory_id"];

echo "New Territory with territory_id = $territory_id created successfuly<br>";
echo "------------------------------------------------------------------------<br><br>";

$result1 = $territory->deleteTerritory($territory_id);
assert(isset($result), "Can't delete the territory");
echo "Territory with territory_id = $territory_id was deleted successfuly<br>";

Route4Me::simplePrint($result1);
