<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// The example refers to the process of an asset tracking by sending HTTP parameters.

Route4Me::setApiKey('11111111111111111111111111111111');

$trackingNumber = null;

// Get a tracking number from a random route destination
$route = new Route();

$routeId = $route->getRandomRouteId(0, 20);
assert(!is_null($routeId), "Cannot retrieve a random route ID");

$addresses = $route->GetAddressesFromRoute($routeId);
assert(!is_null($addresses), "Cannot retrieve a random route ID");

foreach ($addresses as $addr1) {
    if (!is_null($addr1->tracking_number)) {
        $trackingNumber = $addr1->tracking_number;
        break;
    }
}

assert(!is_null($trackingNumber), "Cannot select a tracking number");

$params = [
    'tracking' => $trackingNumber,
];

$route = new Route();

$result = $route->GetAssetTracking($params);

foreach ($result as $key => $value) {
    if (is_array($value)) {
        Route4Me::simplePrint($value, true);
    } else {
        echo "$key => $value <br>";
    }
}
