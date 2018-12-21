<?php
namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Route4Me;
use Route4Me\Route;

// Set the api key in the Route4me class
Route4Me::setApiKey('11111111111111111111111111111111');

#region // Add a location, scheduled daily with custom data.
$AdressBookLocationParameters = AddressBookLocation::fromArray(array(
    "address_1"            => "1604 PARKRIDGE PKWY, Louisville, KY, 40214",
    "address_alias"        => "1604 PARKRIDGE PKWY 40214",
    "address_group"        => "Scheduled daily",
    "first_name"           => "Peter",
    "last_name"            => "Newman",
    "address_email"        => "pnewman6564@yahoo.com",
    "address_phone_number" => "65432178",
    "cached_lat"           => 38.141598,
    "cached_lng"           => -85.793846,
    "address_city"         => "Louisville",
    "address_custom_data"  => array("scheduled"   => "yes", 
                                    "serice type" => "publishing"),
    "schedule" => array(array(
        "enabled" => true,
        "mode"    => "daily",
        "daily"   => array("every" => 1)
    )),
    "service_time" => 900
));

$abContacts1 = new AddressBookLocation();

$abcResults1 = $abContacts1->addAdressBookLocation($AdressBookLocationParameters);

echo "address_id = ".strval($abcResults1["address_id"])."<br>";

Route4Me::simplePrint($abcResults1);
echo "<br>";
#endregion

#region // Add a location, scheduled weekly.
$AdressBookLocationParameters = AddressBookLocation::fromArray(array(
    "address_1"            => "1407 MCCOY, Louisville, KY, 40215",
    "address_alias"        => "1407 MCCOY 40215",
    "address_group"        => "Scheduled weekly",
    "first_name"           => "Bart",
    "last_name"            => "Douglas",
    "address_email"        => "bdouglas9514@yahoo.com",
    "address_phone_number" => "95487454",
    "cached_lat"           => 38.202496,
    "cached_lng"           => -85.786514,
    "curbside_lat"         => 38.202496,
    "curbside_lng"         => -85.786514,
    "address_city"         => "Louisville",
    "schedule" => array(array(
        "enabled" => true,
        "mode"    => "weekly",
        "weekly"  => array(
            "every"    => 1,
            "weekdays" => array(1,2,3,4,5)
        )
    )),
    "service_time" => 600
));

$abContacts2 = new AddressBookLocation();

$abcResults2 = $abContacts2->addAdressBookLocation($AdressBookLocationParameters);

echo "address_id = ".strval($abcResults2["address_id"])."<br>";

Route4Me::simplePrint($abcResults2);
echo "<br>";
#endregion

#region // Add a location, scheduled monthly (dates mode).
$AdressBookLocationParameters = AddressBookLocation::fromArray(array(
    "address_1"            => "4805 BELLEVUE AVE, Louisville, KY, 40215",
    "address_2"            => "4806 BELLEVUE AVE, Louisville, KY, 40215",
    "address_alias"        => "4805 BELLEVUE AVE 40215",
    "address_group"        => "Scheduled monthly",
    "first_name"           => "Bart",
    "last_name"            => "Douglas",
    "address_email"        => "bdouglas9514@yahoo.com",
    "address_phone_number" => "95487454",
    "cached_lat"           => 38.178844,
    "cached_lng"           => -85.774864,
    "curbside_lat"         => 38.178844,
    "curbside_lng"         => -85.774864,
    "address_city"         => "Louisville",
    "address_country_id"   => "US",
    "address_state_id"     => "KY",
    "address_zip"          => "40215",
    "schedule" => array(array(
        "enabled" => true,
        "mode"    => "monthly",
        "monthly" => array(
            "every" => 1,
            "mode"  => "dates",
            "dates" => array(20,22,23,24,25)
        )
    )),
    "service_time" => 750,
    "color" => "red"
));

$abContacts3 = new AddressBookLocation();

$abcResults3 = $abContacts3->addAdressBookLocation($AdressBookLocationParameters);

echo "address_id = ".strval($abcResults3["address_id"])."<br>";

Route4Me::simplePrint($abcResults3);
echo "<br>";
#endregion

#region // AAdd a location, scheduled monthly (nth mode).
$AdressBookLocationParameters = AddressBookLocation::fromArray(array(
    "address_1"            => "730 CECIL AVENUE, Louisville, KY, 40211",
    "address_alias"        => "730 CECIL AVENUE 40211",
    "address_group"        => "Scheduled monthly",
    "first_name"           => "David",
    "last_name"            => "Silvester",
    "address_email"        => "dsilvester5874@yahoo.com",
    "address_phone_number" => "36985214",
    "cached_lat"           => 38.248684,
    "cached_lng"           => -85.821121,
    "curbside_lat"         => 38.248684,
    "curbside_lng"         => -85.821121,
    "address_city"         => "Louisville",
    "address_custom_data" => array(
        "scheduled"    => "yes",
        "service type" => "library"
    ),
    "schedule" => array(array(
        "enabled" => true,
        "mode"    => "monthly",
        "monthly" => array(
            "every" => 1,
            "mode"  => "nth",
            "nth"   => array(
                "n"    => 1,
                "what" => 4
            )
        )
    )),
    "service_time" => 450,
    "address_icon" => "emoji/emoji-bus"
));

$abContacts4 = new AddressBookLocation();

$abcResults4 = $abContacts4->addAdressBookLocation($AdressBookLocationParameters);

echo "address_id = ".strval($abcResults4["address_id"])."<br>";

Route4Me::simplePrint($abcResults4);
echo "<br>";
#endregion

#region // Add a location with the daily scheduling and blacklist.
$AdressBookLocationParameters = AddressBookLocation::fromArray(array(

    "address_1"            => "4629 HILLSIDE DRIVE, Louisville, KY, 40216",
    "address_alias"        => "4629 HILLSIDE DRIVE 40216",
    "address_group"        => "Scheduled daily",
    "first_name"           => "Kim",
    "last_name"            => "Shandor",
    "address_email"        => "kshand8524@yahoo.com",
    "address_phone_number" => "9874152",
    "cached_lat"           => 38.176067,
    "cached_lng"           => -85.824638,
    "curbside_lat"         => 38.176067,
    "curbside_lng"         => -85.824638,
    "address_city"         => "Louisville",
    "address_custom_data"  => array(
        "scheduled"   => "yes",
        "serice type" => "appliance"
    ),
    "schedule" => array(
        "enabled" => true,
        "mode"    => "daily",
        "daily"   => array("every" => 1)
    ),
    "schedule_blacklist" => array("2017-02-24","2017-02-25"),
    "service_time"       => 300
));

$abContacts5 = new AddressBookLocation();

$abcResults5 = $abContacts5->addAdressBookLocation($AdressBookLocationParameters);

echo "address_id = ".strval($abcResults5["address_id"])."<br>";

Route4Me::simplePrint($abcResults5);
#endregion
