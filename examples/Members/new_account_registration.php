<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Example refers to new account registration.

// Set the API key in the Route4Me class
Route4Me::setApiKey(Constants::API_KEY);

$registrParameters = Member::fromArray([
    'strEmail' => 'aaaaaaaaaaaaaaa@gmail.com',
    'strPassword_1' => 'ooo111111',
    'strPassword_2' => 'ooo111111',
    'strFirstName' => 'Driver',
    'strLastName' => 'Driverson',
    'format' => 'json',
    'strIndustry' => 'Gifting',
    'chkTerms' => 1,
    'device_type' => 'web',
    'plan' => 'free',
]);

$member = new Member();

$response = $member->newAccountRegistration($registrParameters);

Route4Me::simplePrint($response);
