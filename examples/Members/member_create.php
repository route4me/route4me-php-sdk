<?php

namespace Route4Me;

use Route4Me\Members\Member;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Example refers to creating of a user.

// Set the api key in the Route4me class
// This example is not available for demo API key
Route4Me::setApiKey(Constants::API_KEY);

$params = Member::fromArray([
    'HIDE_ROUTED_ADDRESSES' => 'FALSE',
    'member_phone'          => '571-259-5939',
    'member_zipcode'        => '22102',
    'route_count'           => null,
    'member_email'          => 'rrrrrrrrrrrrrrrrr+driver1726@gmail.com',
    'HIDE_VISITED_ADDRESSES' => 'FALSE',
    'READONLY_USER'         => 'FALSE',
    'member_type'           => 'SUB_ACCOUNT_DRIVER',
    'date_of_birth'         => '1994-10-01',
    'member_first_name'     => 'Clay',
    'member_password'       => '123456',
    'HIDE_NONFUTURE_ROUTES' => 'FALSE',
    'member_last_name'      => 'Abraham',
    'SHOW_ALL_VEHICLES'     => 'FALSE',
    'SHOW_ALL_DRIVERS'      => 'FALSE',
]);

$member = new Member();

$response = $member->createMember($params);

Route4Me::simplePrint($response);
