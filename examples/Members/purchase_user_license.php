<?php
namespace Route4Me;

$root = realpath(dirname(__FILE__) . '/../../');
require $root . '/vendor/autoload.php';

use Route4Me\Route4Me;
use Route4Me\Member;

// Example refers to purchasing of an userlicense.

// Set the API key in the Route4Me class
Route4Me::setApiKey('11111111111111111111111111111111');

$recordParameters=Member::fromArray(array(
    'member_id'         => 777777,
    'session_guid'      => '454563',
    'device_id'         => '54564',
    'device_type'       =>'ipad',
    'subscription_name' =>'IPAD_MONTHLY',
    'token'             =>'4/P7q7W91a-oMsCeLvIaQm6bTrgtp7',
    'payload'           =>'APA91bHun4MxP5egoKMwt2KZFBaFUH-1RYqx',
    'format'            =>'json'
));

$member = new Member();

$response = $member->purchaseUserLicense($recordParameters);

var_dump($response);
