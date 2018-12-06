<?php
namespace Route4Me;

$root = realpath(dirname(__FILE__) . '/../../');
require $root . '/vendor/autoload.php';

use Route4Me\Route4Me;
use Route4Me\Member;

// Example refers to the process of new account configuration key creation.

// Set the api key in the Route4me class
Route4Me::setApiKey('11111111111111111111111111111111');

$params = Member::fromArray(array (
    "config_key"  => "destination_icon_uri",
    "config_value"=> "value"
));

$member = new Member();

$response = $member->newMemberConfigKey($params);

Route4Me::simplePrint($response);
