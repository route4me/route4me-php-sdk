<?php

namespace UnitTestFiles\Test;

use Route4Me\SearchResponse;
use Route4Me\Route4Me;
use Route4Me\AddressBookLocation;
use Route4Me\Constants;

class AddressBookLocationUnitTests extends \PHPUnit\Framework\TestCase
{
    public static $createdContacts=[];

    public static $csvImportedAddressIDs=[];

    public static function setUpBeforeClass()
    {
        Route4Me::setApiKey(Constants::API_KEY);

        $abl = new AddressBookLocation();

        $AddressBookLocationParameters = AddressBookLocation::fromArray([
            'address_1'             => '1407 MCCOY, Louisville, KY, 40215',
            'address_alias'         => '1407 MCCOY 40215',
            'address_group'         => 'Scheduled weekly',
            'first_name'            => 'Bart',
            'last_name'             => 'Douglas',
            'address_email'         => 'bdouglas9514@yahoo.com',
            'address_phone_number'  => '95487454',
            'cached_lat'            => 38.202496,
            'cached_lng'            => -85.786514,
            'curbside_lat'          => 38.202496,
            'curbside_lng'          => -85.786514,
            'address_city'          => 'Louisville',
            'schedule' => [[
                'enabled'   => true,
                'mode'      => 'weekly',
                'weekly'    => [
                    'every'    => 1,
                    'weekdays' => [1, 2, 3, 4, 5],
                ],
            ]],
            'service_time' => 600,
        ]);

        self::$createdContacts[] = AddressBookLocation::fromArray(
            $abl->addAdressBookLocation($AddressBookLocationParameters)
         );

        $AddressBookLocationParameters = AddressBookLocation::fromArray([
            'address_1'             => '4805 BELLEVUE AVE, Louisville, KY, 40215',
            'address_2'             => '4806 BELLEVUE AVE, Louisville, KY, 40215',
            'address_alias'         => '4805 BELLEVUE AVE 40215',
            'address_group'         => 'Scheduled monthly',
            'first_name'            => 'Bart',
            'last_name'             => 'Douglas',
            'address_email'         => 'bdouglas9514@yahoo.com',
            'address_phone_number'  => '95487454',
            'cached_lat'            => 38.178844,
            'cached_lng'            => -85.774864,
            'curbside_lat'          => 38.178844,
            'curbside_lng'          => -85.774864,
            'address_city'          => 'Louisville',
            'address_country_id'    => 'US',
            'address_state_id'      => 'KY',
            'address_zip'           => '40215',
            'schedule' => [[
                'enabled'   => true,
                'mode'      => 'monthly',
                'monthly'   => [
                    'every' => 1,
                    'mode'  => 'dates',
                    'dates' => [20, 22, 23, 24, 25],
                ],
            ]],
            'service_time' => 750,
            'color'        => 'red',
        ]);

        self::$createdContacts[] = AddressBookLocation::fromArray(
            $abl->addAdressBookLocation($AddressBookLocationParameters)
        );
    }

    public function testAddressBookLocationFromArray()
    {
        $location = AddressBookLocation::fromArray([
            'address_1'             => '1604 PARKRIDGE PKWY, Louisville, KY, 40214',
            'cached_lat'            => 38.141598,
            'cached_lng'            => -85.793846,
            'address_alias'         => '1604 PARKRIDGE PKWY 40214',
            'address_group'         => 'Scheduled daily',
            'first_name'            => 'Peter',
            'last_name'             => 'Newman',
            'address_email'         => 'pnewman6564@yahoo.com',
            'address_phone_number'  => '65432178',
            'address_city'          => 'Louisville',
            'address_custom_data'   => ['scheduled'     => 'yes',
                                        'serice type'   => 'publishing', ],
            'schedule' => [[
                'enabled'   => true,
                'mode'      => 'daily',
                'daily'     => ['every' => 1],
            ]],
            'service_time'          => 900,
        ]);

        $this->assertEquals('1604 PARKRIDGE PKWY, Louisville, KY, 40214', $location->address_1);
        $this->assertEquals(38.141598, $location->cached_lat);
        $this->assertEquals(-85.793846, $location->cached_lng);
        $this->assertEquals('1604 PARKRIDGE PKWY 40214', $location->address_alias);

        $this->assertEquals('Peter', $location->first_name);
        $this->assertEquals('Newman', $location->last_name);
        $this->assertEquals('pnewman6564@yahoo.com', $location->address_email);
        $this->assertEquals('65432178', $location->address_phone_number);
        $this->assertEquals('Louisville', $location->address_city);
    }

    public function testToArray()
    {
        $location = AddressBookLocation::fromArray([
            'address_1'             => '1604 PARKRIDGE PKWY, Louisville, KY, 40214',
            'cached_lat'            => 38.141598,
            'cached_lng'            => -85.793846,
            'address_alias'         => '1604 PARKRIDGE PKWY 40214',
            'address_group'         => 'Scheduled daily',
            'first_name'            => 'Peter',
            'last_name'             => 'Newman',
            'address_email'         => 'pnewman6564@yahoo.com',
            'address_phone_number'  => '65432178',
            'address_city'          => 'Louisville',
            'address_custom_data'   => ['scheduled'     => 'yes',
                'serice type'   => 'publishing', ],
            'schedule' => [[
                'enabled'   => true,
                'mode'      => 'daily',
                'daily'     => ['every' => 1],
            ]],
            'service_time'          => 900,
        ]);

        $this->assertEquals($location->toArray(),
            [
                'address_1'             => '1604 PARKRIDGE PKWY, Louisville, KY, 40214',
                'cached_lat'            => 38.141598,
                'cached_lng'            => -85.793846,
                'address_alias'         => '1604 PARKRIDGE PKWY 40214',
                'address_group'         => 'Scheduled daily',
                'first_name'            => 'Peter',
                'last_name'             => 'Newman',
                'address_email'         => 'pnewman6564@yahoo.com',
                'address_phone_number'  => '65432178',
                'address_city'          => 'Louisville',
                'address_custom_data'   => ['scheduled'     => 'yes',
                    'serice type'   => 'publishing', ],
                'schedule' => [[
                    'enabled'   => true,
                    'mode'      => 'daily',
                    'daily'     => ['every' => 1],
                ]],
                'service_time'          => 900,
            ]
        );
    }

    public function testGetAddressBookLocation()
    {
        $abl = new AddressBookLocation();

        $addressID = self::$createdContacts[0]->address_id;

        $result = AddressBookLocation::fromArray(
            $abl->getAddressBookLocation($addressID)
        );

        $this->assertNotNull($addressID);
        $this->assertContainsOnlyInstancesOf(AddressBookLocation::class, [$result]);

    }

    public function testSearchAddressBookLocations()
    {
        $abl = new AddressBookLocation();

        $params = [
            'query'  => 'Douglas',
            'fields' => 'first_name,address_email',
            'offset' => 0,
            'limit'  => 5,
        ];
                                                                                                                                
        $result =  SearchResponse::fromArray(
            $abl->searchAddressBookLocations($params)
        );

        $this->assertNotNull($result);
        $this->assertTrue(sizeof($result->fields)==2);
        $this->assertContains('first_name',$result->fields);
        $this->assertContains('address_email',$result->fields);

        $this->assertNotNull($result->results);
        $this->assertStringContainsStringIgnoringCase('Douglas',implode (", ", $result->results[0]));
    }

    public function testGetAddressBookLocations()
    {
        $abl = new AddressBookLocation();

        $AddressBookLocationParameters = [
            'limit'  => 5,
            'offset' => 0,
        ];

        $result = SearchResponse::fromArray(
            $abl->getAddressBookLocations($AddressBookLocationParameters)
        );

        $firstLocation = AddressBookLocation::fromArray(
            $result->results[0]
        );

        $this->assertNotNull($result);
        $this->assertNotNull($result->results);
        $this->assertContainsOnlyInstancesOf(AddressBookLocation::class, [$firstLocation]);
    }

    public function testGetRandomAddressBookLocation()
    {
        $AddressBookLocationParameters = [
            'limit'  => 30,
            'offset' => 0,
        ];

        $result = AddressBookLocation::fromArray(
            AddressBookLocation::getRandomAddressBookLocation($AddressBookLocationParameters)
        );

        $this->assertNotNull($result);
        $this->assertContainsOnlyInstancesOf(AddressBookLocation::class, [$result]);
    }

    public function testAddAdressBookLocation()
    {
        $abl = new AddressBookLocation();

        $AddressBookLocationParameters = AddressBookLocation::fromArray([
            'first_name'    => 'Test FirstName '.strval(rand(10000, 99999)),
            'address_1'     => 'Test Address1 '.strval(rand(10000, 99999)),
            'cached_lat'    => 38.024654,
            'cached_lng'    => -77.338814,
        ]);

        $result = AddressBookLocation::fromArray(
            $abl->addAdressBookLocation($AddressBookLocationParameters)
        );

        $this->assertNotNull($result);
        $this->assertContainsOnlyInstancesOf(AddressBookLocation::class, [$result]);

        self::$createdContacts[] = $result;
    }

    public function testDeleteAdressBookLocation()
    {
        $abl = new AddressBookLocation();

        $lastContact = end(self::$createdContacts);

        $deleteResult = $abl->deleteAdressBookLocation([$lastContact->address_id]);

        $this->assertTrue(isset($deleteResult['status']), 'Address Book Location delete operation failed!.. <br>');
        $this->assertTrue($deleteResult['status'], 'Address Book Location delete operation failed!.. <br>');
    }

    public function testUpdateAddressBookLocation()
    {
        $abl = new AddressBookLocation();

        reset(self::$createdContacts);

        $firstContact = self::$createdContacts[0];

        $firstContact->first_name = $firstContact->first_name.' updated';

        $result = AddressBookLocation::fromArray(
            $abl->updateAddressBookLocation($firstContact)
        );

        $this->assertNotNull($result);
        $this->assertContainsOnlyInstancesOf(AddressBookLocation::class, [$result]);
        $this->assertEquals($firstContact->first_name, $result->first_name);
    }

    public function testValidateScheduleMode()
    {
        $this->assertTrue(AddressBookLocation::validateScheduleMode('daily'));
        $this->assertTrue(AddressBookLocation::validateScheduleMode('weekly'));
        $this->assertTrue(AddressBookLocation::validateScheduleMode('monthly'));
        $this->assertTrue(AddressBookLocation::validateScheduleMode('annually'));

        $this->assertFalse(AddressBookLocation::validateScheduleMode('wrongMode'));
    }

    public function testValidateScheduleEnable()
    {
        $this->assertTrue(AddressBookLocation::validateScheduleEnable(true));
        $this->assertTrue(AddressBookLocation::validateScheduleEnable(false));

        $this->assertFalse(AddressBookLocation::validateScheduleEnable('wrongValue'));
        $this->assertFalse(AddressBookLocation::validateScheduleEnable(null));
    }

    public function testValidateScheduleEvery()
    {
        $this->assertTrue(AddressBookLocation::validateScheduleEvery(1));
        $this->assertTrue(AddressBookLocation::validateScheduleEvery(8));

        $this->assertFalse(AddressBookLocation::validateScheduleEvery(0));
        $this->assertFalse(AddressBookLocation::validateScheduleEvery(-1));
        $this->assertFalse(AddressBookLocation::validateScheduleEvery('stringValue'));
        $this->assertFalse(AddressBookLocation::validateScheduleEvery(true));
        $this->assertFalse(AddressBookLocation::validateScheduleEvery(null));
    }

    public function testValidateScheduleWeekDays()
    {
        $this->assertTrue(AddressBookLocation::validateScheduleWeekDays('1,2,3,4,5,6,7'));

        $this->assertFalse(AddressBookLocation::validateScheduleWeekDays('1,2,3,4,5,6,7,8'));
        $this->assertFalse(AddressBookLocation::validateScheduleWeekDays('1,-2,3,4,5,6,7'));
        $this->assertFalse(AddressBookLocation::validateScheduleWeekDays(true));
        $this->assertFalse(AddressBookLocation::validateScheduleWeekDays(4));
        $this->assertFalse(AddressBookLocation::validateScheduleWeekDays('dds'));
    }

    public function testValidateScheduleMonthlyMode()
    {
        $this->assertTrue(AddressBookLocation::validateScheduleMonthlyMode('dates'));
        $this->assertTrue(AddressBookLocation::validateScheduleMonthlyMode('nth' ));

        $this->assertFalse(AddressBookLocation::validateScheduleMonthlyMode('wrongParam' ));
        $this->assertFalse(AddressBookLocation::validateScheduleMonthlyMode(4 ));
        $this->assertFalse(AddressBookLocation::validateScheduleMonthlyMode(true ));
    }

    public function testValidateScheduleMonthlyDates()
    {
        $this->assertTrue(AddressBookLocation::validateScheduleMonthlyDates('1,2,3,7,31'));
        $this->assertTrue(AddressBookLocation::validateScheduleMonthlyDates('12,21,23,24,28'));

        $this->assertFalse(AddressBookLocation::validateScheduleMonthlyDates('0,2,3,7,31'));
        $this->assertFalse(AddressBookLocation::validateScheduleMonthlyDates('0,2,3,7,33'));
        $this->assertFalse(AddressBookLocation::validateScheduleMonthlyDates('-1,2,3,7'));
        $this->assertFalse(AddressBookLocation::validateScheduleMonthlyDates('wrongText'));
        $this->assertFalse(AddressBookLocation::validateScheduleMonthlyDates(true));
        $this->assertFalse(AddressBookLocation::validateScheduleMonthlyDates(false));
    }

    public function testValidateScheduleNthN()
    {
        $this->assertTrue(AddressBookLocation::validateScheduleNthN(1));
        $this->assertTrue(AddressBookLocation::validateScheduleNthN(2));
        $this->assertTrue(AddressBookLocation::validateScheduleNthN(3));
        $this->assertTrue(AddressBookLocation::validateScheduleNthN(4));
        $this->assertTrue(AddressBookLocation::validateScheduleNthN(5));
        $this->assertTrue(AddressBookLocation::validateScheduleNthN(-1));

        $this->assertFalse(AddressBookLocation::validateScheduleNthN(-5));
        $this->assertFalse(AddressBookLocation::validateScheduleNthN(0));
        $this->assertFalse(AddressBookLocation::validateScheduleNthN(7));
        $this->assertFalse(AddressBookLocation::validateScheduleNthN(true));
        $this->assertFalse(AddressBookLocation::validateScheduleNthN(false));
        $this->assertFalse(AddressBookLocation::validateScheduleNthN('wrongText'));
    }

    public function testValidateScheduleNthWhat()
    {
        for ($i=1;$i<11;$i++) $this->assertTrue(AddressBookLocation::validateScheduleNthWhat($i));

        $this->assertFalse(AddressBookLocation::validateScheduleNthWhat(0));
        $this->assertFalse(AddressBookLocation::validateScheduleNthWhat(14));
        $this->assertFalse(AddressBookLocation::validateScheduleNthWhat(true));
        $this->assertFalse(AddressBookLocation::validateScheduleNthWhat(false));
        $this->assertFalse(AddressBookLocation::validateScheduleNthWhat('wrongText'));
    }

    public function testAddLocationsFromCsvFile()
    {
        $root = realpath(dirname(__FILE__).'/../../');
        $source_file = $root.'/UnitTestFiles/Test/addresses_10.csv';

        $locationsFieldsMapping['cached_lat'] = 0;
        $locationsFieldsMapping['cached_lng'] = 1;
        $locationsFieldsMapping['address_alias'] = 2;
        $locationsFieldsMapping['address_1'] = 3;
        $locationsFieldsMapping['address_city'] = 4;
        $locationsFieldsMapping['address_state_id'] = 5;
        $locationsFieldsMapping['address_zip'] = 6;
        $locationsFieldsMapping['address_phone_number'] = 7;
        $locationsFieldsMapping['schedule_mode'] = 8;
        $locationsFieldsMapping['schedule_enabled'] = 9;
        $locationsFieldsMapping['schedule_every'] = 10;
        $locationsFieldsMapping['schedule_weekdays'] = 11;
        $locationsFieldsMapping['monthly_mode'] = 12;
        $locationsFieldsMapping['monthly_dates'] = 13;
        $locationsFieldsMapping['monthly_nth_n'] = 14;
        $locationsFieldsMapping['monthly_nth_what'] = 15;
        $locationsFieldsMapping['anually_nth_n'] = 16;
        $locationsFieldsMapping['anually_nth_what'] = 17;

        $handle = fopen("$source_file", 'r');

        $this->assertNotNull($handle);

        $abl = new AddressBookLocation();

        $results = $abl->addLocationsFromCsvFile($handle, $locationsFieldsMapping);

        $this->assertNotNull($results);

        $this->assertTrue(isset($results['success']));

        $this->assertTrue(isset($results['fail']));

        foreach ($results['success'] as $sc) {
            self::$csvImportedAddressIDs[] = filter_var($sc, FILTER_SANITIZE_NUMBER_INT);
        }

        $this->assertTrue(sizeof(self::$csvImportedAddressIDs)==10);
    }

    public static function tearDownAfterClass()
    {
        $addressBookLocations=[];

        foreach (self::$createdContacts as $createdContact) {
            $addressBookLocations[] = $createdContact->address_id;
        }

        $addressBookLocations = array_merge($addressBookLocations,self::$csvImportedAddressIDs);

        $abl = new AddressBookLocation();

        $deleteResult = $abl->deleteAdressBookLocation($addressBookLocations);

        if (isset($deleteResult['status']) && $deleteResult['status']) {
            echo "Created contacts were removed.<br>";
        }
    }
}