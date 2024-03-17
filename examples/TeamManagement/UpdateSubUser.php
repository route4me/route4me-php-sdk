<?php

//**********************************************************************
// Update the sub-user by specifying the path parameter ID and by sending the
// corresponding body payload with the sub-user's parameters..
//**********************************************************************

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Exception\ApiError;
use Route4Me\V5\TeamManagement\TeamManagement;

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

$userId = 2565363;
$params = [
    'HIDE_ROUTED_ADDRESSES' => true,
    'member_type' => 'SUB_ACCOUNT_DISPATCHER'
];

try {
    $tm = new TeamManagement();
    $res = $tm->update($userId, $params);
    print_r($res);
} catch (ApiError $e) {
    echo $e->getMessage() . PHP_EOL;
}
