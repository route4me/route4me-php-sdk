<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Example refers to the process of removing of a specified configuration key belonging to an account.

// Set the api key in the Route4me class
Route4Me::setApiKey('11111111111111111111111111111111');

$member = new Member();

// Create a config key
$createParams = Member::fromArray([
    'config_key' => 'My height',
    'config_value' => '182',
]);

$response = $member->newMemberConfigKey($createParams);

// Delete a config key
$removeParams = Member::fromArray([
    'config_key' => 'My height',
]);

$response = $member->removeMemberConfigKey($removeParams);

Route4Me::simplePrint($response);
