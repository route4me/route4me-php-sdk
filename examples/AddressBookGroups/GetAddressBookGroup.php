<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Set the api key in the Route4Me class
Route4Me::setApiKey(Constants::API_KEY);

$abGroup = new AddressBookGroup();

// The example refers to the process of getting an address book group by group ID.

// Get reandom address book group
$addressBookGroupParameters = [
    'limit' => 20,
    'offset' => 0,
];

$randomGroup = $abGroup->getRandomAddressBookGroup($addressBookGroupParameters);

if (assert(null != $randomGroup, 'Cannot get a random address book group'));

// Get the address book group by group_id
$groupId = $randomGroup['group_id'];

$abgResult = $abGroup->getAddressBookGroup(['group_id' => $groupId]);

Route4Me::simplePrint($abgResult);
