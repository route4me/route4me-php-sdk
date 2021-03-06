<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Set the api key in the Route4Me class
Route4Me::setApiKey(Constants::API_KEY);

$abGroup = new AddressBookGroup();

// The example refers to the process of getting the address book locations by a group ID.

$groupIds=$abGroup->getAddressBookGroupIdByName( 'Louisville Group Temp');

if ($groupIds==null) {
    include('CreateAddressBookGroup.php');
    $groupIds=$abGroup->getAddressBookGroupIdByName('Louisville Group Temp');
}

$searchParameters = [
    'fields'    => ['address_id'],
    'group_id'  => $groupIds[0],
];

$addressBookContacts = $abGroup->getAddressBookContactsByGroup($searchParameters);

Route4Me::simplePrint($addressBookContacts, true);