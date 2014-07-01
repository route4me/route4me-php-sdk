<?php

$loader = require __DIR__ . '/../vendor/autoload.php';
$loader->add('Route4me\\', __DIR__);

use Route4me\Route4me;

// Set Global api key
Route4me::setApiKey($GLOBALS['TEST_APIKEY']);
