<?php
namespace Route4Me;

$root = realpath(dirname(__FILE__) . '/../../');
require $root . '/vendor/autoload.php';

use Route4Me\Route4Me;
use Route4Me\Route;

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Set the api key in the Route4Me class
Route4Me::setApiKey('11111111111111111111111111111111');

$activityParameters = ActivityParameters::fromArray(array(
    "limit" => 10,
    "offset" => 0
));

$activities = new ActivityParameters();
$actresults = $activities->get($activityParameters);
$results = $activities->getValue($actresults, "results");

Route4Me::simplePrint($results);
