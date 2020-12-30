<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Set the api key in the Route4Me class
Route4Me::setApiKey(Constants::API_KEY);

$vendors = new TelematicsVendor();

$randomVendorID = $vendors->GetRandomVendorID(0, 5);

$vendorParameters = TelematicsVendor::fromArray([
    'vendor_id' => $randomVendorID,
]);

$vendor = new TelematicsVendor();
$vendorResult = $vendor->GetTelematicsVendors($vendorParameters);

Route4Me::simplePrint($vendorResult);
    echo '<br>';
