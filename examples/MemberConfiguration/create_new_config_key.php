<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Example refers to the process of creating a new account configuration key.

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

$params = Member::fromArray([
    'config_key'    => 'destination_icon_uri',
    'config_value'  => 'value',
]);

$member = new Member();

$response = $member->newMemberConfigKey($params);

Route4Me::simplePrint($response);
