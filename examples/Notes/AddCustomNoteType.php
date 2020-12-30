<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Set the api key in the Route4Me class
Route4Me::setApiKey(Constants::API_KEY);

// Create a custom note type
$noteParameters = [
    'type'   => 'To Do',
    'values' => [
                  'Pass a package',
                  'Pickup package',
                  'Do a service',
                ],
];

$addressNote = new AddressNote();

$response = $addressNote->createCustomNoteType($noteParameters);

Route4Me::simplePrint($response);
