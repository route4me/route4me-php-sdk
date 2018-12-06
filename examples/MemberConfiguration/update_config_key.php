<?php
namespace Route4Me;

$root = realpath(dirname(__FILE__) . '/../../');
require $root . '/vendor/autoload.php';

use Route4Me\Route4Me;
use Route4Me\Member;

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Example refers to the process of updating existing configuration key data.

// Set the api key in the Route4me class
Route4Me::setApiKey('11111111111111111111111111111111');

$member = new Member();

// Get a random member config key
$randomParams = Member::fromArray(array (
));

$response = $member->getMemberConfigData($randomParams);

assert(!is_null($response), "Cannot retrieve all config data");
assert(sizeof($response)==2, "Cannot retrieve all config data");
assert(isset($response['data']), "Cannot retrieve all config data");

$randIndex = rand(0, sizeof($response['data'])-1);

$randomKey = $response['data'][$randIndex]['config_key'];
$randomValue = $response['data'][$randIndex]['config_value'];
echo "Random key -> $randomKey,  random value -> $randomValue <br><br>";

// Update existing configuration key data
$params = Member::fromArray(array (
    "config_key"=> $randomKey,
    "config_value"=> $randomValue . " Updated"
));

$response = $member->updateMemberConfigKey($params);

assert(isset($response['affected']), "Cannot update a config data");
assert(isset($response['affected'])=='1', "Cannot update a config data");

Route4Me::simplePrint($response);


