<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Set the api key in the Route4Me class
Route4Me::setApiKey('11111111111111111111111111111111');

$abGroup = new AddressBookGroup();

// The example refers to the process of getting limited number of the address book groups.

$addressBookGroupParameters = [
    'limit' => 20,
    'offset' => 0,
];

$addressBookGroups = $abGroup->getAddressBookGroups($addressBookGroupParameters);

Route4Me::simplePrint($addressBookGroups);
