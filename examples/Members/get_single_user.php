<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Example refers to getting of an user with details.

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

$member = new Member();

// Get users list
$users = $member->getUsers();

assert(!is_null($users), 'Cannot retrieve list of the users');
assert(2 == sizeof($users), 'Cannot retrieve list of the users');
assert(isset($users['results']), 'Cannot retrieve list of the users');
assert(isset($users['total']), 'Cannot retrieve list of the users');

$randIndex = rand(0, $users['total'] - 1);

$randomUserID = $users['results'][$randIndex]['member_id'];

echo "Random user ID -> $randomUserID <br><br>";

// Get a specified user with details
$param = [
    'member_id' => $randomUserID,
];

$response = $member->getUser($param);

Route4Me::simplePrint($response);
