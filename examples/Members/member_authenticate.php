<?php
namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Route4Me;
use Route4Me\Member;

// Example refers to member authentication.

// Set the API key in the Route4Me class
Route4Me::setApiKey('11111111111111111111111111111111');

$Parameters = Member::fromArray(array(
    'strEmail'    => 'rrrrrrrrrrrrr@gmail.com',
    'strPassword' => 'dddddddd',
    'format'      => 'json',
));

$member = new Member();

$response = $member->memberAuthentication($Parameters);

Route4Me::simplePrint($response);
