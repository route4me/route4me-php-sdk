<?php

//**********************************************************************
// Optimization profile Workflow fulflow sample.
//**********************************************************************

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Exception;
use Route4Me\Exception\ApiError;
use Route4Me\V5\OptimizationProfiles\OptimizationProfiles;

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

$op = new OptimizationProfiles();

try {
    // get default optimization profile id
    $profiles = $op->getAll();
    $default_profile = null;

    foreach ($profiles->items as $key => $value) {
        if ($value->is_default) {
            $default_profile = $value;
            break;
        }
    }

    if ($default_profile === null) {
        echo 'Default profile is absent.' . PHP_EOL;
    } else {
        echo 'Found default optimization profile: ' . $default_profile->optimization_profile_id . PHP_EOL;

        // data to save
        $params = [
            'items' => [[
                'guid' => 'eaa',
                'parts' => [[
                    'guid' => 'pav',
                    'data' => [ 'append_date_to_route_name' => true ]
                ]],
                'id' => $default_profile->optimization_profile_id
            ]]
        ];

        $res = $op->save($params);
        echo 'Data for optimization_profile_id: ' . $default_profile->optimization_profile_id
            . ' was saved successful.' . PHP_EOL;

        // id to delete
        $params = [
            'items' => [[
                'id' => $default_profile->optimization_profile_id
            ]]
        ];

        $res = $op->delete($params);
        echo 'Optimization profile with optimization_profile_id: ' . $default_profile->optimization_profile_id
            . ' was deleted successful.' . PHP_EOL;
    }
} catch (Exception | ApiError $e) {
    echo 'Error, Code: ' . $e->getCode() . PHP_EOL . 'Message: ' . $e->getMessage() . PHP_EOL;
}
