<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Enum\DeviceType;
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
    'member_id' => 105323,
    'course' => 3,
    'speed' => 100,
    'lat' => 41.8927521,
    'lng' => -109.0803888,
    'device_type' => DeviceType::IPHONE,
    'device_guid' => 'qweqweqwe',
    'device_timestamp' => date('Y-m-d H:i:s'),
]);

$status = Track::set($params);

assert(!is_null($status), "Cannot send GPS position to the selected route");
assert(isset($status['status']), "Cannot send GPS position to the selected route");
assert($status['status'], "Cannot send GPS position to the selected route");

if (!$status) {
    echo 'Setting of GPS position failed';

    return;
}

$params = [
    'route_id' => $routeId,
    'device_tracking_history' => '1',
];

$result = $route->GetLastLocation($params);

if (isset($result->tracking_history)) {
    foreach ($result->tracking_history as $history) {
        echo 'Speed --> '.$history['s'].'<br>';
        echo 'course --> '.$history['d'].'<br>';
        echo 'Timestamp --> '.$history['ts_friendly'].'<br>';
        echo 'Latitude --> '.$history['lt'].'<br>';
        echo 'Longitude --> '.$history['lg'].'<br>';
        echo '========================================<br><br>';
    }
}
