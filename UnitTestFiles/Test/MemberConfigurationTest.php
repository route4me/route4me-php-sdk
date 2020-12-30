<?php

namespace UnitTestFiles\Test;

use Route4Me\Constants;
use Route4Me\Exception\BadParam;
use Route4Me\Members\MemberConfiguration;
use Route4Me\Members\Member;
use Route4Me\Route4Me;

class MemberConfigurationTest extends \PHPUnit\Framework\TestCase
{
    public static $createdConfigurationKeys;

    public static function setUpBeforeClass()
    {
        Route4Me::setApiKey(Constants::API_KEY);

        $memberConfiguration = new MemberConfiguration();

        $query = [
            'config_key' => 'Test My weight'
        ];

        $removed = $memberConfiguration->RemoveConfigurationData($query, $errorText);

        $memberConfiguration->config_key = 'Test My height';
        $memberConfiguration->config_value = '180';

        $result = $memberConfiguration->CreateNewConfigurationData($memberConfiguration->toArray(), $errorText);

        if(isset($result['affected']) && $result['affected']==1) {
            self::$createdConfigurationKeys[] = 'Test My height';
        } else {
            echo "$errorText <br>";
        }
    }

    public function testConfigurationMemberFromArray()
    {
        $memberConfiguration = MemberConfiguration::fromArray([
            'member_id'     =>  444444,
            'config_key'    =>  'test_key',
            'config_value'  =>  'test_value'
        ]);

        $this->assertEquals($memberConfiguration->member_id, 444444 ,"member_id != 444444");
        $this->assertEquals($memberConfiguration->config_key, 'test_key' ,"config_key != 'test_key'");
        $this->assertEquals($memberConfiguration->config_value, 'test_value' ,"config_value != 'test_value'");
    }

    public function testToArray()
    {
        $memberConfiguration = MemberConfiguration::fromArray([
            'member_id'     =>  444444,
            'config_key'    =>  'test_key',
            'config_value'  =>  'test_value'
        ]);

        $this->assertEquals($memberConfiguration->toArray(), [
            'member_id'     =>  444444,
            'config_key'    =>  'test_key',
            'config_value'  =>  'test_value'
         ]);
    }

    public function testBadParameter()
    {
        $this->expectException(BadParam::class);

        $memberConfiguration = MemberConfiguration::fromArray([
            'memberID'   => 44444444,
            'config_kkk' => 'test_key'
        ]);

        echo "memberConfiguration: ".$memberConfiguration->memberID." <br>";
    }

    public function testGetAllConfigurationData()
    {
        $memberConfiguration = new MemberConfiguration();

        $result = $memberConfiguration->GetConfigurationData();

        $this->assertNotNull($result);
        $this->assertTrue(isset($result['result']), "Wrong response for member configuration data.");
        $this->assertEquals($result['result'], "OK", "Cannot retrieve the member configuration data.");
    }

    public function testGetSpecificConfigurationKeyData()
    {
        $memberConfiguration = new MemberConfiguration();

        $allData = $memberConfiguration->GetConfigurationData();

        $this->assertNotNull($allData);
        $this->assertTrue(isset($allData['data']), "Wrong response for member configuration data.");
        $this->assertTrue(sizeof($allData['data'])>0, "Retrieved member data size <1");

        $query = [
            'config_key' => $allData['data'][0]['config_key']
        ];

        $result = $memberConfiguration->GetConfigurationData($query);

        $this->assertNotNull($result);
        $this->assertTrue(isset($result['data']), "Wrong response for member configuration data.");
        $this->assertTrue(sizeof($result['data'])==1, "Retrieved member data size != 1");
        $this->assertEquals($result['data'][0]['config_key'], $allData['data'][0]['config_key']);
    }

    public function testCreateConfigurationData()
    {
        $memberConfiguration = new MemberConfiguration();

        $memberConfiguration->config_key = 'Test My weight';
        $memberConfiguration->config_value = '100';

        $result = $memberConfiguration->CreateNewConfigurationData($memberConfiguration->toArray(), $errorText);

        $this->assertNotNull($result);
        $this->assertTrue(isset($result['result']), "Wrong response for member configuration data.");
        $this->assertTrue(isset($result['affected']), "Wrong response for member configuration data.");
        $this->assertEquals(1, $result['affected'], "Cannot create new member configuration data <br> $errorText");

        if($result['affected']==1) {
            self::$createdConfigurationKeys[] = 'Test My weight';
        }
    }

    public function testUpdateConfigurationData()
    {
        $memberConfiguration = new MemberConfiguration();

        $memberConfiguration->config_key = 'Test My height';
        $memberConfiguration->config_value = '120';

        $result = $memberConfiguration->UpdateConfigurationData($memberConfiguration->toArray(), $errorText);

        $this->assertNotNull($result);
        $this->assertTrue(isset($result['result']), "Wrong response for member configuration data.");
        $this->assertTrue(isset($result['affected']), "Wrong response for member configuration data.");
        $this->assertEquals(1, $result['affected'], "Cannot update member configuration data <br> $errorText");

        $query = [
            'config_key' => 'Test My height'
        ];

        $updatedResult = $memberConfiguration->GetConfigurationData($query);

        $this->assertNotNull($updatedResult);
        $this->assertTrue(isset($updatedResult['data']), "Wrong response for member configuration data.");
        $this->assertTrue(sizeof($updatedResult['data'])==1, "Retrieved member data size != 1");
        $this->assertEquals('120', $updatedResult['data'][0]['config_value'], "The config value is not updated");
    }

    public function testRemoveConfigurationData()
    {
        $memberConfiguration = new MemberConfiguration();

        $query = [
            'config_key' => 'Test My height'
        ];

        $removed = $memberConfiguration->RemoveConfigurationData($query, $errorText);

        echo (isset($removed['affected']) && $removed['affected']==1)
            ? "The config data with key 'Test My height' removed"
            : "The config data with key 'Test My height' cannot remove - ".$errorText;

        $this->assertNotNull($removed);
        $this->assertTrue(isset($removed['result']), "Wrong response for member configuration data.");
        $this->assertTrue(isset($removed['affected']), "Wrong response for member configuration data.");
        $this->assertEquals(1, $removed['affected'], "Cannot create new member configuration data");

        if($removed['affected']==1) {
            $key = array_search('Test My height', self::$createdConfigurationKeys);
            array_splice(self::$createdConfigurationKeys, $key, 1);
        }
    }

    public static function tearDownAfterClass()
    {
        $memberConfiguration = new MemberConfiguration();

        if (sizeof(self::$createdConfigurationKeys)>0) {
            foreach (self::$createdConfigurationKeys as $configKey) {
                $removed = $memberConfiguration->RemoveConfigurationData(['config_key' => $configKey], $errorText);

                echo (isset($removed['affected']) && $removed['affected']==1)
                            ? "The config data with key '$configKey' removed"
                            : "The config data with key '$configKey' cannot remove - ".$errorText;
            }
        }
    }
}
