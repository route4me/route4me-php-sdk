<?php

//**********************************************************************
// Get the asynchronous job result by specifying the 'job_id' path parameter.
//**********************************************************************

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Exception\ApiError;
use Route4Me\V5\AddressBook\AddressBook;

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

try {
    $ab = new AddressBook();

    $jobId = '434A746FF41D5572FB3D76FACB55161E';

    $res = $ab->getAddressesAsynchronousJobResult($jobId);
    print_r($res);
} catch (ApiError $e) {
    echo $e->getCode() . PHP_EOL;
    echo $e->getMessage() . PHP_EOL;
}
