<?php
namespace Route4Me;

$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

require $vdir.'/../vendor/autoload.php';

use Route4Me\Route4Me;
use Route4Me\Member;

// Example refers to getting of users with details.

// Set the api key in the Route4me class
Route4Me::setApiKey('11111111111111111111111111111111');

$member = new Member();

$response = $member->getUsers();

foreach ($response as $key => $member) {
    Route4Me::simplePrint($member);
}
