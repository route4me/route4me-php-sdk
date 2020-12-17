<?php

namespace Route4Me;

use Route4Me\Tracking\Track;
use Route4Me\Tracking\UserLocation;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

$track = new Track();
$userLocations = $track->getUserLocations();
$userLocation = reset($userLocations);

$email = $userLocation['member_data']['member_email'];
$queriedUserLocations = $track->getUserLocations($email);

foreach ($queriedUserLocations As $memberId => $userLocation) {
    echo $userLocation['member_data']['member_first_name'].' '.$userLocation['member_data']['member_last_name']." --> ";
    if (isset($userLocation['tracking']['position_lng'])) {
        echo "Longitude: ".$userLocation['tracking']['position_lng'].", Latitude: ".$userLocation['tracking']['position_lat'];
    }
    echo "<br>";
}
