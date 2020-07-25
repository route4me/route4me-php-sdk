<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Enum\Format;

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Set the api key in the Route4me class
// This example not available for demo API key
Route4Me::setApiKey(Constants::API_KEY);

// Get a random route ID
$route = new Route();

$routeId = $route->getRandomRouteId(0, 20);
assert(!is_null($routeId), "Cannot retrieve a random route ID");
echo "routeId -> $routeId <br><br>";

// Set GPS postion to the selected route
// Set right member_id corresponding to the API key
$params = TrackSetParams::fromArray([
    'format' => Format::SERIALIZED,
    'route_id' => $routeId,
    'member_id' => 1,
    'course' => 1,
    'speed' => 120,
    'lat' => 41.8927521,
    'lng' => -109.0803888,
    'device_type' => 'android_phone',
    'device_guid' => 'qweqweqwe',
    'device_timestamp' => date('Y-m-d H:i:s', strtotime('-2 day')),
]);

$status = Track::set($params);

assert(!is_null($status), "Cannot send GPS position to the selected route");
assert(isset($status['status']), "Cannot send GPS position to the selected route");
assert($status['status'], "Cannot send GPS position to the selected route");

// Get the device tracking history from a time range
$startDate = time() - 30 * 24 * 3600;
$endDate = time() + 1 * 24 * 3600;

$params = [
    'route_id' => $routeId,
    'format' => Format::JSON,
    'time_period' => 'custom',
    'start_date' => $startDate,
    'end_date' => $endDate,
];

$result = $route->GetTrackingHistoryFromTimeRange($params);

foreach ($result as $key => $value) {
    if (is_array($value)) {
        Route4Me::simplePrint($value);
    } else {
        echo "$key => $value <br>";
    }
}
