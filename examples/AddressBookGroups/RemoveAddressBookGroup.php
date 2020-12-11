<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Set the api key in the Route4Me class
Route4Me::setApiKey(Constants::API_KEY);

$abGroup = new AddressBookGroup();

// The example refers to the process of removing an address book group from a user's account.

$groupIds=$abGroup->getAddressBookGroupIdByName('Louisville Group Temp');

if ($groupIds==null) {
    include('CreateAddressBookGroup.php');
    $groupIds=$abGroup->getAddressBookGroupIdByName('Louisville Group Temp');
}

$updateParameters= [
    'group_id' => $groupIds[0]
];

$result = $abGroup->removeAddressBookGroup($updateParameters);

Route4Me::simplePrint($result);