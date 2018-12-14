<?php
namespace Route4Me;
    
$root=realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Enum\DeviceType;
use Route4Me\Enum\Format;
use Route4Me\TrackSetParams;
use Route4Me\Track;

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
// Set right member_id corresponding to the API key
$params = TrackSetParams::fromArray(array(
    'format'           => Format::CSV,
    'route_id'         => $routeId,
    'member_id'        => 1,
    'course'           => 1,
    'speed'            => 120,
    'lat'              => 41.8927521,
    'lng'              => -109.0803888,
    'device_type'      => 'android_phone',
    'device_guid'      => 'qweqweqwe',
    'device_timestamp' => date('Y-m-d H:i:s', strtotime('-1 day'))
));

$status = Track::set($params);

assert(!is_null($status), "Can't send GPS position to the selected route");
assert(isset($status['status']), "Can't send GPS position to the selected route");
assert($status['status'], "Can't send GPS position to the selected route");

Route4Me::simplePrint($status);
