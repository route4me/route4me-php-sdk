<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Set the api key in the Route4Me class
Route4Me::setApiKey(Constants::API_KEY);

$abGroup = new AddressBookGroup();

// The example refers to the process of updating an address book group.
// Note: you can find the allowed colors for the address book group at this link:
// https://github.com/route4me/route4me-json-schemas/blob/master/ColorSamples/AddressBookGroupAvailableColors.png

$groupIds=$abGroup->getAddressBookGroupIdByName('Louisville Group Temp');

if ($groupIds==null) {
    include('CreateAddressBookGroup.php');
    $groupIds=$abGroup->getAddressBookGroupIdByName('Louisville Group Temp');
}

$updateParameters= [
    'group_id'      => $groupIds[0],
    'group_color'   => '7bd148'
];

$results = $abGroup->updateAddressBookGroup($updateParameters);

Route4Me::simplePrint($results);