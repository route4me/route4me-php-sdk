<?php

//**********************************************************************
// Add multiple sub-users to the User account by sending the corresponding
// body payload with the array of the sub-users' parameters
//**********************************************************************

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Exception;
use Route4Me\Exception\ApiError;
use Route4Me\Members\Member;
use Route4Me\V5\TeamManagement\TeamManagement;

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

try {
    // get OWNER_MEMBER_ID
    $owner_member_id = null;
    $member = new Member();
    $res_members = $member->getUsers();

    if (is_array($res_members) && isset($res_members['results'])) {
        foreach ($res_members['results'] as $key => $value) {
            if ($value['OWNER_MEMBER_ID'] == 0) {
                $owner_member_id = $value['member_id'];
                break;
            }
        }
    }

    if (!$owner_member_id) {
        throw new Exception("Cannot find OWNER_MEMBER_ID.");
    }

    // insert new sub-users
    $params = [
        [
            'new_password' => '12345&Qwerty',
            'member_first_name' => 'Tusha I',
            'member_last_name' => 'Pupkindzes',
            'member_email' => 'the_I@best.com',
            'member_type' => 'SUB_ACCOUNT_DRIVER',
            'OWNER_MEMBER_ID' => $owner_member_id
        ], [
            'new_password' => '12345&Qwerty',
            'member_first_name' => 'Tusha II',
            'member_last_name' => 'Pupkindzes',
            'member_email' => 'the_II@best.com',
            'member_type' => 'SUB_ACCOUNT_DRIVER',
            'OWNER_MEMBER_ID' => $owner_member_id
            ]
    ];

    $options = [
        'conflicts' => 'overwrite'
    ];

    $tm = new TeamManagement();
    $res = $tm->bulkInsert($params, $options);
    //print_r($res);
    echo "Insert two sub-users." . PHP_EOL;
} catch (Exception | ApiError $e) {
    echo $e->getMessage() . PHP_EOL;
}
