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

$territory=new Territory();

// Select a terriotry with the addresses from the list
$params = array(
    "offset"    => 0,
    "limit"     => 50,
    "addresses" => 1
);

$results = $territory->getTerritories($params);
assert(!is_null($results), "Can't retrieve the territories with addresses");

$territory1 = null;

foreach ($results as $terr) {
    if (isset($terr['addresses'])) {
        if (sizeof($terr['addresses'])>0) {
            $territory1 = $terr;
            break;
        }
    }	
}

assert(isset($territory1['territory_id']), "Can't retrieve a random territory ID");
$territory_id = $territory1['territory_id'];

echo "Territory ID -> $territory_id <br><br>"; 

// Get a territory with the addresses
$params = array(
    "territory_id" => $territory_id,
    "addresses"    => 1
);

$result1 = $territory->getTerritory($params);

Route4Me::simplePrint($result1, true);
