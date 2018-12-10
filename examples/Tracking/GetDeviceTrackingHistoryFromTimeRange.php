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
    'format'           => Format::JSON,
    'route_id'         => $routeId,
    'member_id'        => 1,
    'course'           => 1,
    'speed'            => 120,
    'lat'              => 41.8927521,
    'lng'              => -109.0803888,
    'device_type'      => 'android_phone',
    'device_guid'      => 'qweqweqwe',
    'device_timestamp' => date('Y-m-d H:i:s', strtotime('-2 day'))
));

$status = Track::set($params);

assert(!is_null($status), "Can't send GPS position to the selected route");
assert(isset($status['status']), "Can't send GPS position to the selected route");
assert($status['status'], "Can't send GPS position to the selected route");

// Get the device tracking history from a time range
$startDate = time() - 30*24*3600;
$endDate = time() + 1*24*3600;

$params = array(
    'route_id'     =>  $routeId,
    'format'       => Format::JSON,
    'time_period'  =>  'custom',
    'start_date'   => $startDate,
    'end_date'     => $endDate
);

$result = $route->GetTrackingHistoryFromTimeRange($params);

foreach ($result as $key => $value)
{
    if (is_array($value)) {
        Route4Me::simplePrint($value);
    } else {
        echo "$key => $value <br>";
    }
}
