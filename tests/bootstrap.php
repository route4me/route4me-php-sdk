<?php

$loader = require __DIR__.'/../vendor/autoload.php';
$loader->add('Route4Me\\', __DIR__);

use Route4Me\Route4Me;

// Set Global api key
Route4Me::setApiKey($GLOBALS['TEST_APIKEY']);
