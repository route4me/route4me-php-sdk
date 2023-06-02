<?php

namespace UnitTestFiles\Test;

use Route4Me\Constants;
use Route4Me\Route4Me;
use Route4Me\AddressBookGroup;
use Route4Me\SearchResponse;

class AddressBookGroupUnitTests extends \PHPUnit\Framework\TestCase
{
    public static $createdGroups = [];

    public static function setUpBeforeClass()
    {
        Route4Me::setApiKey(Constants::API_KEY);

        $abg = new AddressBookGroup();

        $createParameters= [
            'group_name'    => 'All Group',
            'group_color'   => '92e1c0',
            'filter'        => [
                'condition' => 'AND',
                'rules'     => [[
                    'id'       => 'address_1',
                    'field'    => 'address_1',
                    'operator' => 'not_equal',
                    'value'    => 'qwerty123456'
                ]]
            ]
        ];

        $createdAddressBookGroup = AddressBookGroup::fromArray(
            $abg->createAddressBookGroup($createParameters)
        );

        self::$createdGroups[] = $createdAddressBookGroup;

        $createParameters= [
            'group_name'    => 'All Group',
            'group_color'   => '92e1c0',
            'filter'        => [
                'condition' => 'AND',
                'rules'     => [[
                    'id'       => 'address_1',
                    'field'    => 'address_1',
                    'operator' => 'not_equal',
                    'value'    => 'qwerty123456'
                ]]
            ]
        ];

        $createdAddressBookGroup = AddressBookGroup::fromArray(
            $abg->createAddressBookGroup($createParameters)
        );

        self::$createdGroups[] = $createdAddressBookGroup;
    }

    public function testFromArray()
    {
        $addressBookGroup = AddressBookGroup::fromArray([
            'group_id'      => '137F9F99544DB34C160B2B9AF8FC6A12',
            'group_name'    => 'Ocassion example',
            'group_color'   => '92e1c0',
            'group_icon'    => 'emoji-pushpin',
            'member_id'     => 444333,
            'filter' => [
              'condition'   => 'AND',
              'rules'       => [
                [
                  'id'          => 'custom_data.occasion',
                  'field'       => 'custom_data.occasion',
                  'operator'    => 'equal',
                  'value'       => '100'
                ]]
            ]
        ]);

        $this->assertEquals('137F9F99544DB34C160B2B9AF8FC6A12', $addressBookGroup->group_id);
        $this->assertEquals('Ocassion example', $addressBookGroup->group_name);
        $this->assertEquals('92e1c0', $addressBookGroup->group_color);
        $this->assertEquals('emoji-pushpin', $addressBookGroup->group_icon);
        $this->assertEquals(444333, $addressBookGroup->member_id);
        $this->assertEquals([
            'condition'   => 'AND',
            'rules'       => [
                [
                    'id'          => 'custom_data.occasion',
                    'field'       => 'custom_data.occasion',
                    'operator'    => 'equal',
                    'value'       => '100'
                ]]
        ], $addressBookGroup->filter);
    }

    public function testGetAddressBookGroup()
    {
        $groupId = self::$createdGroups[0]->group_id;

        $abg = new AddressBookGroup();

        $result = AddressBookGroup::fromArray(
            $abg->getAddressBookGroup(['group_id' => $groupId])
        );

        $this->assertNotNull($result);
        $this->assertContainsOnlyInstancesOf(AddressBookGroup::class, [$result]);
    }

    public function testUpdateAddressBookGroup()
    {
        $groupId = self::$createdGroups[0]->group_id;

        $updateParameters= [
            'group_id'      => $groupId,
            'group_color'   => '7bd148'
        ];

        $result = AddressBookGroup::fromArray(
            AddressBookGroup::updateAddressBookGroup($updateParameters)
        );

        $this->assertNotNull($result);
        $this->assertContainsOnlyInstancesOf(AddressBookGroup::class, [$result]);
        $this->assertEquals('7bd148', $result->group_color);
    }

    public function testRemoveAddressBookGroup()
    {
        $groupId = end(self::$createdGroups)->group_id;

        $removeParameters= [
            'group_id' => $groupId
        ];

        $result = AddressBookGroup::removeAddressBookGroup($removeParameters);

        $this->assertNotNull($result);
        $this->assertTrue(isset($result['status']));
        $this->assertTrue($result['status']);

        self::$createdGroups[] = array_pop(self::$createdGroups);
    }

    public function testCreateAddressBookGroup()
    {
        $createParameters= [
            'group_name'    => 'All Group',
            'group_color'   => '92e2cd',
            'filter'        => [
                'condition' => 'AND',
                'rules'     => [[
                    'id'       => 'address_1',
                    'field'    => 'address_1',
                    'operator' => 'not_equal',
                    'value'    => 'qwerty654321'
                ]]
            ]
        ];

        $createdAddressBookGroup = AddressBookGroup::fromArray(
            AddressBookGroup::createAddressBookGroup($createParameters)
        );

        $this->assertNotNull($createdAddressBookGroup);
        $this->assertContainsOnlyInstancesOf(AddressBookGroup::class, [$createdAddressBookGroup]);
        $this->assertEquals('92e2cd', $createdAddressBookGroup->group_color);

        self::$createdGroups[] = $createdAddressBookGroup;
    }

    public function testSearchAddressBookGroups()
    {
        $searchParameters = [
            'fields' => ['address_id', 'address_1', 'address_group'],
            'limit' => 10,
            'offset' => 0,
            'filter' => [
                'query' => "Louisville",
                "display" => "all"
            ]
        ];

        $addressBookGroups = SearchResponse::fromArray(
            AddressBookGroup::searchAddressBookGroups($searchParameters)
        );

        $this->assertNotNull($addressBookGroups);
        $this->assertTrue(sizeof($addressBookGroups->fields)==3);
        $this->assertContains('address_id', $addressBookGroups->fields);
        $this->assertContains('address_1', $addressBookGroups->fields);
        $this->assertContains('address_group', $addressBookGroups->fields);

        $this->assertNotNull($addressBookGroups->results);

        if (sizeof($addressBookGroups->results)>0) {
            $this->assertContains('Louisville', implode(", ", $addressBookGroups->results[0]));
        }
    }

    public function testGetAddressBookContactsByGroup()
    {
        //$this->markTestSkipped('must be revisited.');

        $groupId = self::$createdGroups[0]->group_id;

        $searchParameters = [
            'fields'    => ['address_id'],
            'group_id'  => $groupId,
        ];

        $result = AddressBookGroup::getAddressBookContactsByGroup($searchParameters);

        $this->assertNotNull($result);
        $this->assertTrue(isset($result['total']));
        $this->assertTrue(isset($result['results']));
        $this->assertTrue(is_array($result['results']));
    }

    public function testGetAddressBookGroups()
    {
        $addressBookGroupParameters = [
            'limit'  => 20,
            'offset' => 0,
        ];

        $addressBookGroups = AddressBookGroup::getAddressBookGroups($addressBookGroupParameters);

        $this->assertNotNull($addressBookGroups);

        $firstGroup = AddressBookGroup::fromArray(
            $addressBookGroups[0]
        );

        $this->assertTrue(sizeof($addressBookGroups)>0);
        $this->assertContainsOnlyInstancesOf(AddressBookGroup::class, [$firstGroup]);
    }

    public function testgGetRandomAddressBookGroup()
    {
        $addressBookGroupParameters = [
            'limit'  => 20,
            'offset' => 0,
        ];

        $randomGroup = AddressBookGroup::fromArray(
            AddressBookGroup::getRandomAddressBookGroup($addressBookGroupParameters)
        );

        $this->assertNotNull($randomGroup);
        $this->assertContainsOnlyInstancesOf(AddressBookGroup::class, [$randomGroup]);
    }

    public function testGetAddressBookGroupIdByName()
    {
        $firstGroup = self::$createdGroups[0];

        $groupIds = AddressBookGroup::getAddressBookGroupIdByName($firstGroup->group_name);

        $this->assertNotNull($groupIds);
        $this->assertTrue(in_array($firstGroup->group_id, $groupIds));
    }

    public static function tearDownAfterClass()
    {
        foreach (self::$createdGroups as $createdGroup) {
            $groupId = $createdGroup->group_id;

            $removeParameters= [
                'group_id' => $groupId
            ];

            $result = AddressBookGroup::removeAddressBookGroup($removeParameters);

            if ($result!=null && isset($result['status']) && isset($result['status'])) {
                echo "The address book group ".$groupId." removed successfully <br>";
            } else {
                echo "Cannot remove the address book group ".$groupId."<br>";
            }
        }
    }
}
