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
    'vendors' => '55,56,57',
]);

$vendors = new TelematicsVendor();
$comparisonResults = $vendors->GetTelematicsVendors($vendorsParameters);

foreach ($comparisonResults['vendors'] as $result) {
    Route4Me::simplePrint($result, true);
    echo '<br>';
}
