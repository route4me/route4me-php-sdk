<?php
namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Route4Me;
use Route4Me\Member;

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Example refers to updating a user.

// Set the api key in the Route4me class
Route4Me::setApiKey('11111111111111111111111111111111');

$member = new Member();

// Get random member ID of the member type SUB_ACCOUNT_DRIVER
$randomMemberID = $member->getRandomMemberByType('SUB_ACCOUNT_DRIVER');

assert(!is_null($randomMemberID), "There is no member of the type SUB_ACCOUNT_DRIVER in the user's account");

// Update member
$params = Member::fromArray(array (
    "member_id"    => $randomMemberID,
    "member_phone" => "555-777-888"
));

$response = $member->updateMember($params);

Route4Me::simplePrint($response);
