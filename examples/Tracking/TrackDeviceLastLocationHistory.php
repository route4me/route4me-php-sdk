<?php
namespace Route4Me;
    
$root=realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Enum\DeviceType;
use Route4Me\Enum\Format;
use Route4Me\TrackSetParams;
use Route4Me\Track;
use Route4Me\Route;

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Set the api key in the Route4me class
// This example not available for demo API key
Route4Me::setApiKey('11111111111111111111111111111111');

// Get a random route ID
$route = new Route();

$routeId = $route->getRandomRouteId(0, 20);
assert(!is_null($routeId), "Can't retrieve a random route ID");
echo "routeId -> $routeId <br><br>"; 

// Set GPS postion to the selected route
$params = TrackSetParams::fromArray(array(
    'format'           => Format::SERIALIZED,
    'route_id'         => $routeId,
    'member_id'        => 105323,
    'course'           => 3,
    'speed'            => 100,
    'lat'              => 41.8927521,
    'lng'              => -109.0803888,
    'device_type'      => DeviceType::IPHONE,
    'device_guid'      => 'qweqweqwe',
    'device_timestamp' => date('Y-m-d H:i:s')
));

$status = Track::set($params);

assert(!is_null($status), "Can't send GPS position to the selected route");
assert(isset($status['status']), "Can't send GPS position to the selected route");
assert($status['status'], "Can't send GPS position to the selected route");

if (!$status) {
    echo "Setting of GPS position failed";
    return;
}

$params = array(
    'route_id'  =>  $routeId,
    'device_tracking_history'  =>  '1'
);

$result = $route->GetLastLocation($params);

if (isset($result->tracking_history))
foreach ($result->tracking_history as $history) {
    echo "Speed --> ".$history['s']."<br>";
    echo "course --> ".$history['d']."<br>";
    echo "Timestamp --> ".$history['ts_friendly']."<br>";
    echo "Latitude --> ".$history['lt']."<br>";
    echo "Longitude --> ".$history['lg']."<br>";
    echo "========================================<br><br>";
}
