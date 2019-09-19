<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Set the api key in the Route4Me class
Route4Me::setApiKey('11111111111111111111111111111111');

// Get random custom note type
$address = new Address();

$customNotes = $address->getAllCustomNoteTypes();

assert(!is_null($customNotes), "Cannot retrieve all custom note types");
assert(sizeof($customNotes) > 0, "There is no custom note type in the user's account");

$randomCustomNoteID = $customNotes[rand(0, sizeof($customNotes) - 1)]['note_custom_type_id'];

// Remove a custom note type
$noteParameters = [
    'id' => $randomCustomNoteID,
];

$address = new Address();

$response = $address->removeCustomNoteType($noteParameters);

Route4Me::simplePrint($response);
