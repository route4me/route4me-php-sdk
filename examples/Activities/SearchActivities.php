<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Enum\ActivityTypes;

// Example refers to get activities by activity_type parameter.

// Set the api key in the Route4Me class
Route4Me::setApiKey(Constants::API_KEY);

$activityTypes = new ActivityTypes();

// Iterate through all the existing activity types
foreach ($activityTypes->getConstants() as $prop => $value) {
    $activityParameters = ActivityParameters::fromArray([
        'activity_type' => $value,
        'limit'         => 2,
        'offset'        => 0,
    ]);

    $activities = new ActivityParameters();
    $results = $activities->searchActivities($activityParameters);

    foreach ($results as $key => $activity) {
        Route4Me::simplePrint($activity);
        echo '<br>';
    }

    echo '------------------- <br><br>';
}
