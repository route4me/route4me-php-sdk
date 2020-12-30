<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// The example refers to the process of getting a specified single configuration key data.

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

$member = new Member();

// Get a random member config key
$randomParams = Member::fromArray([]);

$response = $member->getMemberConfigData($randomParams);

assert(!is_null($response), 'Cannot retrieve all config data');
assert(2 == sizeof($response), 'Cannot retrieve all config data');
assert(isset($response['data']), 'Cannot retrieve all config data');

$randomKey = $response['data'][rand(0, sizeof($response['data']) - 1)]['config_key'];

// Get a specified single configuration key data
echo "randomKey -> $randomKey <br><br>";

$params = Member::fromArray([
    'config_key' => $randomKey,
]);

$response = $member->getMemberConfigData($params);

foreach ($response as $key => $value) {
    if (is_array($value)) {
        Route4Me::simplePrint($value);
    } else {
        echo "$key => $value <br>";
    }
}
