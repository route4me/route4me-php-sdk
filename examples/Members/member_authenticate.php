<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Example refers to member authentication.

// Set the API key in the Route4Me class
Route4Me::setApiKey(Constants::API_KEY);

$Parameters = Member::fromArray([
    'strEmail' => 'rrrrrrrrrrrrr@gmail.com',
    'strPassword' => 'dddddddd',
    'format' => 'json',
]);

$member = new Member();

$response = $member->memberAuthentication($Parameters);

Route4Me::simplePrint($response);
