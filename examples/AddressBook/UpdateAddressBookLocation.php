<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Set the api key in the Route4Me class
Route4Me::setApiKey('11111111111111111111111111111111');

$AddressBookLocationParameters = AddressBookLocation::fromArray([
    'first_name' => 'Test FirstName '.strval(rand(10000, 99999)),
    'address_1' => 'Test Address1 '.strval(rand(10000, 99999)),
    'cached_lat' => 38.024654,
    'cached_lng' => -77.338814,
]);

$abLocation = new AddressBookLocation();

$abcResult = $abLocation->addAdressBookLocation($AddressBookLocationParameters);

$address_id = -1;

assert(isset($abcResult['address_id']), 'Cannot create an address book location. <br><br>');

if (isset($abcResult['address_id'])) {
    $address_id = $abcResult['address_id'];
}

assert($address_id != -1, 'Cannot create an address book location. <br><br>');

echo 'Address Book Location with <b>address_id = '.strval($address_id).'</b> and <b>first_name = '.$abcResult['first_name'].'</b> was successfully added<br>';

$abcResult['first_name'] = 'Test First Name Updated';

$abcResult = $abLocation->updateAddressBookLocation(AddressBookLocation::fromArray($abcResult));

assert(isset($abcResult['first_name']), 'Cannot update the address book location. <br><br>');

assert('Test First Name Updated' == $abcResult['first_name'], 'Cannot update the address book location. <br><br>');

echo 'The field <b>first_name</b> in the address book location <b>'.$address_id.'</b> was update to <b>Test First Name Updated</b> successfuly <br>';
