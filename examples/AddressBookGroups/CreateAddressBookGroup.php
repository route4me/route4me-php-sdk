<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Set the api key in the Route4Me class
Route4Me::setApiKey(Constants::API_KEY);

$abGroup = new AddressBookGroup();

// The example refers to the process of creating address book group.
// Note: you can find the allowed colors for the address book group at this link:
// https://github.com/route4me/route4me-json-schemas/blob/master/ColorSamples/AddressBookGroupAvailableColors.png

$createParameters= [
    'group_name'   => 'Louisville Group Temp',
    'group_color'  => '92e1c0',
    'filter' => [
        'condition' => 'AND',
        'rules' => [[
            'id'       => 'address_1',
            'field'    => 'address_1',
            'operator' => 'contains',
            'value'    => 'Luisville'
        ]]
    ]
];

$createdAddressBookGroup = $abGroup->createAddressBookGroup($createParameters);

Route4Me::simplePrint($createdAddressBookGroup);
