<?php

namespace Route4Me;

use Route4Me\Members\Member;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Example refers to creating of a mobile device license record.

// Set the API key in the Route4Me class
Route4Me::setApiKey(Constants::API_KEY);

$recordParameters = Member::fromArray([
    'device_id' => '546546516',
    'device_type' => 'IPAD',
    'format' => 'json',
]);

$member = new Member();

$response = $member->addDeviceRecord($recordParameters);

var_dump($response);
