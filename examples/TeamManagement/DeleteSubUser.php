<?php

//**********************************************************************
// Delete the sub-user by specifying the path parameter ID.
//**********************************************************************

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Exception\ApiError;
use Route4Me\V5\TeamManagement\TeamManagement;

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

$userId = 2567512;

try {
    $tm = new TeamManagement();
    $res = $tm->delete($userId);
    print_r($res);
} catch (ApiError $e) {
    echo 'Cannot delete user with ID: ' . $userId . PHP_EOL;
}
