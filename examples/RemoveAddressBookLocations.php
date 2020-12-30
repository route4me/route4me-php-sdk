<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Set the api key in the Route4Me class
Route4Me::setApiKey(Constants::API_KEY);

$AddressBookLocationParameters = AddressBookLocation::fromArray([
    'first_name'    => 'Test FirstName '.strval(rand(10000, 99999)),
    'address_1'     => 'Test Address1 '.strval(rand(10000, 99999)),
    'cached_lat'    => 38.024654,
    'cached_lng'    => -77.338814,
]);

$abContacts = new AddressBookLocation();

$createdContact = $abContacts->addAdressBookLocation($AddressBookLocationParameters);

$address_id = -1;

if (isset($createdContact['address_id'])) {
    $address_id = $createdContact['address_id'];
}

assert($address_id != -1, 'Creating of Address Book Location was failed. Try again!.. <br>');

echo 'Address Book Location with address_id = '.strval($address_id).' was successfully added<br>';

$addressBookLocations = [$address_id];

$abLocations = new AddressBookLocation();

$deleteResult = $abLocations->deleteAdressBookLocation($addressBookLocations);

assert(isset($deleteResult['status']), 'Address Book Location delete operation failed!.. <br>');
assert($deleteResult['status'], 'Address Book Location delete operation failed!.. <br>');

echo 'Address Book Location with address_id = '.strval($address_id).' was successfully deleted<br>';
