<?php

namespace Route4Me;

use Route4Me\Members\Member;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Example refers to validating of user's session.

// Set the API key in the Route4Me class
Route4Me::setApiKey(Constants::API_KEY);

$member = new Member();

// Authenticate a user and get session guid
$recordParameters = Member::fromArray([
    'strEmail' => 'aaaaaaaaaaa@gmail.com',
    'strPassword' => 'ddddddddddd',
    'format' => 'json',
]);

$response = $member->memberAuthentication($recordParameters);

assert(!is_null($response), 'Cannot authenticate a user');
assert(isset($response['session_guid']), 'Cannot authenticate a user');
assert(isset($response['member_id']), 'Cannot authenticate a user');

$sessionGuid = $response['session_guid'];
$memberID = $response['member_id'];

echo "Member ID -> $memberID <br> Session GUID -> $sessionGuid <br>";

// Validate the session
$params = Member::fromArray([
    'session_guid' => $sessionGuid,
    'member_id' => $memberID,
    'format' => 'json',
]);

$response = $member->validateSession($params);

var_dump($response);
