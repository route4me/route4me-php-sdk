<?php

//**********************************************************************
// View all existing sub-users associated with the Member’s account.
//**********************************************************************

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Exception\ApiError;
use Route4Me\V5\TeamManagement\TeamManagement;

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

try {
    $tm = new TeamManagement();
    $res = $tm->getUsers();
    print_r($res);
} catch (ApiError $e) {
    echo $e->getMessage() . PHP_EOL;
}
