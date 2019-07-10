<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// The example refers to the process of getting all account configuration key data

// Set the api key in the Route4me class
Route4Me::setApiKey('11111111111111111111111111111111');

$params = Member::fromArray([]);

$member = new Member();

$response = $member->getMemberConfigData($params);

foreach ($response as $key => $value) {
    if (is_array($value)) {
        foreach ($value as $v1) {
            Route4Me::simplePrint($v1);
            echo '<br>';
        }
    } else {
        echo "$key => $value <br>";
    }
    echo '<br>';
}
