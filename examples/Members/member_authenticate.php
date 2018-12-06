<?php
namespace Route4Me;

$root = realpath(dirname(__FILE__) . '/../../');
require $root . '/vendor/autoload.php';

use Route4Me\Route4Me;
use Route4Me\Member;

// Example refers to member authentication.

// Set the API key in the Route4Me class
Route4Me::setApiKey('11111111111111111111111111111111');

$recordParameters=Member::fromArray(array(
    'strEmail' => 'aaaaaaaaa@yahoo.com',
    'strPassword' => 'pppppppp',
    'format' => 'json',
));

$member = new Member();

$response = $member->memberAuthentication($recordParameters);

var_dump($response);
