<?php
namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Route4Me;
use Route4Me\Route;

// Set the api key in the Route4Me class
Route4Me::setApiKey('11111111111111111111111111111111');

// Create a custom note type
$noteParameters=array(
    "type"   => 'To Do',
    "values" => array(
                  'Pass a package',
                  'Pickup package',
                  'Do a service'
                )
);

$address = new Address();

$response = $address->createCustomNoteType($noteParameters);

Route4Me::simplePrint($response);
