<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Set the api key in the Route4Me class
Route4Me::setApiKey(Constants::API_KEY);

// Get all custom note types
$addressNote = new AddressNote();

$response = $addressNote->getAllCustomNoteTypes();

Route4Me::simplePrint($response);
