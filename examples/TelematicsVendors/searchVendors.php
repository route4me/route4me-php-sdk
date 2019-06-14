<?php
namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Route4Me;
use Route4Me\TelematicsVendor;

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Set the api key in the Route4Me class
Route4Me::setApiKey('11111111111111111111111111111111');

$vendorsParameters = TelematicsVendor::fromArray(array(
    //"country"       => "GB",  // uncomment this line for searching by Country
    "is_integrated" => 1,
    //"feature"       => "satelite",  // uncomment this line for searching by Feature
    "search"        => "Fleet",
    "page"          => 1,
    "per_page"      => 5
));

$vendors = new TelematicsVendor();
$vendorsResults = $vendors->GetTelematicsVendors($vendorsParameters);

foreach ($vendorsResults['vendors'] as $result) {
    Route4Me::simplePrint($result);
    echo "<br>";
}
