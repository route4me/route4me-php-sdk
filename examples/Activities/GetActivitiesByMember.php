<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Set the api key in the Route4Me class
Route4Me::setApiKey('11111111111111111111111111111111');

$MamberParames =Member::fromArray([ ]);

$member = new Member();

$response = $member->getUsers($MamberParames);

assert(isset($response['results']), 'Cannot retrieve the users! <br>');
assert(sizeof($response['results'])>1, 'Cannot retrieve more than 1 users');

$memberId = $response['results'][1]["member_id"];

$activityParameters = ActivityParameters::fromArray([
    'member_id' => $memberId,
    'limit' => 10,
    'offset' => 0,
]);

$activities = new ActivityParameters();
$actResults = $activities->getActivities($activityParameters);
$results = $activities->getValue($actResults, 'results');

foreach ($results as $result) {
    Route4Me::simplePrint($result);
    echo '<br>';
}
