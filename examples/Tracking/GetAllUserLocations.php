<?php

namespace Route4Me;

use Route4Me\Tracking\Track;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

$track = new Track();

$userLocations = $track->getUserLocations();

foreach ($userLocations As $memberId => $userLocation) {
    echo $userLocation['member_data']['member_first_name'].' '.$userLocation['member_data']['member_last_name']." --> ";
    if (isset($userLocation['tracking']['position_lng'])) {
        echo "Longitude: ".$userLocation['tracking']['position_lng'].", Latitude: ".$userLocation['tracking']['position_lat'];
    }
    echo "<br>";
}
