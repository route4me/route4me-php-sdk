<?php
namespace Route4Me;

$root = realpath(dirname(__FILE__) . '/../../');
require $root . '/vendor/autoload.php';

use Route4Me\Route4Me;
use Route4Me\Member;

// Example refers to new account registration.

// Set the API key in the Route4Me class
Route4Me::setApiKey('11111111111111111111111111111111');

$registrParameters=Member::fromArray(array(
    'strEmail'      => 'aaaaaaaaaaaaa@gmail.com',
    'strPassword_1' => 'ooo111111',
    'strPassword_2' => 'ooo111111',
    'strFirstName'  => 'Driver',
    'strLastName'   => 'Driverson',
    'format'        => 'json',
    'strIndustry'   => 'Gifting',
    'chkTerms'      => 1,
    'device_type'   => 'web',
    'plan'          => 'free'
));

$member = new Member();

$response = $member->newAccountRegistration($registrParameters);

Route4Me::simplePrint($response);
