<?php

namespace Route4Me;

use Route4Me\TelematicsGateway\TelematicsVendor As TelematicsVendor;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Set the api key in the Route4Me class
Route4Me::setApiKey(Constants::API_KEY);

$vendorsParameters = TelematicsVendor::fromArray([
    //"country"       => "GB",  // uncomment this line for searching by Country
    'is_integrated' => 1,
    //"feature"       => "satellite",  // uncomment this line for searching by Feature
    'search'        => 'Fleet',
    'page'          => 1,
    'per_page'      => 5,
]);

$vendors = new TelematicsVendor();
$vendorsResults = $vendors->GetTelematicsVendors($vendorsParameters);

foreach ($vendorsResults['vendors'] as $result) {
    Route4Me::simplePrint($result);
    echo '<br>';
}
