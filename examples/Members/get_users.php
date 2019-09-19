<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Example refers to getting of users with details.

// Set the api key in the Route4me class
Route4Me::setApiKey('11111111111111111111111111111111');

$member = new Member();

$response = $member->getUsers();

foreach ($response['results'] as $key => $member) {
    Route4Me::simplePrint($member);
    echo '<br>';
}
