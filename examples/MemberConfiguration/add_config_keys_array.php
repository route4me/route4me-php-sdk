<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Example refers to the process of adding array of the new account configuration keys to the user's account.

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

$params = [
    Member::fromArray([
        'config_key'    => 'hide_sharing_in_route_parameters_dialog',
        'config_value'  => 'false',
    ]),
    Member::fromArray([
        'config_key'    => 'disable_telematics_popup_overlay',
        'config_value'  => 'false',
    ])
 ];

$member = new Member();

$response = $member->newMemberConfigKey($params);

Route4Me::simplePrint($response);