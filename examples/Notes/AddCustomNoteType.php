<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Set the api key in the Route4Me class
Route4Me::setApiKey('11111111111111111111111111111111');

// Create a custom note type
$noteParameters = [
    'type' => 'To Do',
    'values' => [
                  'Pass a package',
                  'Pickup package',
                  'Do a service',
                ],
];

$address = new Address();

$response = $address->createCustomNoteType($noteParameters);

Route4Me::simplePrint($response);
