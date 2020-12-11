<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Example refers to the process of getting of a member's capabilities.

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

$member = new Member();

$memberCapabalities = member::getMemberCapabilities();

Route4Me::simplePrint($memberCapabalities);
