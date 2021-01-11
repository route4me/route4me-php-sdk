<?php

$root = realpath(dirname(__FILE__).'/../../');
$loader = require $root.'/Route4Me/vendor/autoload.php';

//$loader = require __DIR__.'/../vendor/autoload.php';
$loader->add('Route4Me\\', __DIR__);

use Route4Me\Constants;
use Route4Me\Route4Me;

// Set Global api key
Route4Me::setApiKey(Constants::API_KEY);
