<?php

namespace Route4Me;

use Route4Me\Members\Member;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Example refers to removing of an user.

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

$member = new Member();

// Get random member ID of the member type SUB_ACCOUNT_DRIVER
$randomMemberID = $member->getRandomMemberByType('SUB_ACCOUNT_DRIVER');

assert(!is_null($randomMemberID), "There is no member of the type SUB_ACCOUNT_DRIVER in the user's account");

// Delete member from the user's account
$params = Member::fromArray([
    'member_id' => $randomMemberID,
]);

$errorText = "";
$response = $member->deleteMember($params, $errorText);

if (!is_null($response)) {
    Route4Me::simplePrint($response);
} else {
    echo $errorText."<br>";
}
