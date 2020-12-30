<?php

namespace UnitTestFiles\Test;

use Route4Me\Constants;
use Route4Me\Members\Member;
use Route4Me\Members\MemberCapabilities;
use Route4Me\Members\MemberResponse;
use Route4Me\Members\MemberAuthenticationResponse;
use Route4Me\Members\MemberResponseV4;
use Route4Me\Members\ResultsResponseV4;
use Route4Me\Route4Me;

class UserTests extends \PHPUnit\Framework\TestCase
{
    public static $createdMembers=[];

    public static function setUpBeforeClass()
    {
        Route4Me::setApiKey(Constants::API_KEY);
        $date = new \DateTime();

        $params = Member::fromArray([
            'HIDE_ROUTED_ADDRESSES' => 'FALSE',
            'member_phone'          => '571-259-5939',
            'member_zipcode'        => '22102',
            'route_count'           => null,
            'member_email'          => 'regression.autotests+'.$date->getTimestamp().'@gmail.com',
            'HIDE_VISITED_ADDRESSES' => 'FALSE',
            'READONLY_USER'         => 'FALSE',
            'member_type'           => 'SUB_ACCOUNT_DRIVER',
            'date_of_birth'         => '1994-10-01',
            'member_first_name'     => 'Clay',
            'member_password'       => '123456',
            'HIDE_NONFUTURE_ROUTES' => 'FALSE',
            'member_last_name'      => 'Abraham',
            'SHOW_ALL_VEHICLES'     => 'FALSE',
            'SHOW_ALL_DRIVERS'      => 'FALSE',
        ]);

        $member = new Member();

        $response = $member->createMember($params);

        self::assertNotNull($response);
        self::assertInstanceOf(
            MemberResponseV4::class,
            MemberResponseV4::fromArray($response)
        );

        self::$createdMembers[] = MemberResponseV4::fromArray($response);
    }

    public function testFromArray()
    {
        $memberResponseV4 = MemberResponseV4::fromArray([
            'member_id'                 => '18154',
            'OWNER_MEMBER_ID'           => '0',
            'member_type'               => 'PRIMARY_ACCOUNT',
            'member_first_name'         => 'Routeme',
            'member_last_name'          => 'QA',
            'member_email'              => 'aaaaaa@route4me.com',
            'preferred_units'           => 'MI',
            'preferred_language'        => 'en',
            'HIDE_ROUTED_ADDRESSES'     => 'FALSE',
            'HIDE_VISITED_ADDRESSES'    => 'FALSE',
            'HIDE_NONFUTURE_ROUTES'     => 'FALSE',
            'SHOW_ALL_DRIVERS'          => 'FALSE',
            'SHOW_ALL_VEHICLES'         => '0',
            'READONLY_USER'             => 'FALSE',
            'member_phone'              => null,
            'member_zipcode'            => '18002',
            'timezone'                  => 'US\/Arizona',
            'date_of_birth'             => null,
            'user_reg_state_id'         => null,
            'user_reg_country_id'       => null,
            'member_picture'            => 'https => \/\/apps-static.borea.com\/uploads\/44444444444444444444444444444444\/profile_77777777777777777777777777777777.png',
            'level'                     => 0,
            'custom_data'               => [
                'animal' => 'lion',
                'bird'   => 'eagle'
            ],
            'api_key'                   => '11111111111111111111111111111111'
        ]);

        $this->assertEquals('18154', $memberResponseV4->member_id);
        $this->assertEquals('0', $memberResponseV4->OWNER_MEMBER_ID);
        $this->assertEquals('PRIMARY_ACCOUNT', $memberResponseV4->member_type);
        $this->assertEquals('Routeme', $memberResponseV4->member_first_name);
        $this->assertEquals('QA', $memberResponseV4->member_last_name);
        $this->assertEquals('aaaaaa@route4me.com', $memberResponseV4->member_email);
        $this->assertEquals('MI', $memberResponseV4->preferred_units);
        $this->assertEquals('en', $memberResponseV4->preferred_language);
        $this->assertEquals('FALSE', $memberResponseV4->HIDE_ROUTED_ADDRESSES);
        $this->assertEquals('FALSE', $memberResponseV4->HIDE_VISITED_ADDRESSES);
        $this->assertEquals('FALSE', $memberResponseV4->HIDE_NONFUTURE_ROUTES);
        $this->assertEquals('FALSE', $memberResponseV4->SHOW_ALL_DRIVERS);
        $this->assertEquals('0', $memberResponseV4->SHOW_ALL_VEHICLES);
        $this->assertEquals('FALSE', $memberResponseV4->READONLY_USER);
        $this->assertEquals(null, $memberResponseV4->member_phone);
        $this->assertEquals('18002', $memberResponseV4->member_zipcode);
        $this->assertEquals('US\/Arizona', $memberResponseV4->timezone);
        $this->assertEquals(null, $memberResponseV4->date_of_birth);

        $this->assertEquals(null, $memberResponseV4->user_reg_state_id);
        $this->assertEquals(null, $memberResponseV4->user_reg_country_id);
        $this->assertEquals(
            'https => \/\/apps-static.borea.com\/uploads\/44444444444444444444444444444444\/profile_77777777777777777777777777777777.png',
            $memberResponseV4->member_picture
        );
        $this->assertEquals(0, $memberResponseV4->level);
        $this->assertEquals(
            [
                'animal' => 'lion',
                'bird'   => 'eagle'
            ],
            $memberResponseV4->custom_data);
        $this->assertEquals('11111111111111111111111111111111', $memberResponseV4->api_key);

    }

    public function testToArray()
    {
        $memberResponseV4 = MemberResponseV4::fromArray([
            'member_id'                 => '18154',
            'OWNER_MEMBER_ID'           => '0',
            'member_type'               => 'PRIMARY_ACCOUNT',
            'member_first_name'         => 'Routeme',
            'member_last_name'          => 'QA',
            'member_email'              => 'aaaaaa@route4me.com',
            'preferred_units'           => 'MI',
            'preferred_language'        => 'en',
            'HIDE_ROUTED_ADDRESSES'     => 'FALSE',
            'HIDE_VISITED_ADDRESSES'    => 'FALSE',
            'HIDE_NONFUTURE_ROUTES'     => 'FALSE',
            'SHOW_ALL_DRIVERS'          => 'FALSE',
            'SHOW_ALL_VEHICLES'         => '0',
            'READONLY_USER'             => 'FALSE',
            'member_zipcode'            => '18002',
            'timezone'                  => 'US\/Arizona',
            'member_picture'            => 'https => \/\/apps-static.borea.com\/uploads\/44444444444444444444444444444444\/profile_77777777777777777777777777777777.png',
            'level'                     => 0,
            'custom_data'               => [
                'animal' => 'lion',
                'bird'   => 'eagle'
            ],
            'api_key'                   => '11111111111111111111111111111111'
        ]);

        $this->assertEquals($memberResponseV4->toArray(),
            [
                'HIDE_NONFUTURE_ROUTES'     => 'FALSE',
                'HIDE_ROUTED_ADDRESSES'     => 'FALSE',
                'HIDE_VISITED_ADDRESSES'    => 'FALSE',
                'member_id'                 => '18154',
                'OWNER_MEMBER_ID'           => '0',
                'READONLY_USER'             => 'FALSE',
                'SHOW_ALL_DRIVERS'          => 'FALSE',
                'SHOW_ALL_VEHICLES'         => '0',
                'member_email'              => 'aaaaaa@route4me.com',
                'member_first_name'         => 'Routeme',
                'member_last_name'          => 'QA',
                'member_picture'            => 'https => \/\/apps-static.borea.com\/uploads\/44444444444444444444444444444444\/profile_77777777777777777777777777777777.png',
                'member_type'               => 'PRIMARY_ACCOUNT',
                'member_zipcode'            => '18002',
                'preferred_language'        => 'en',
                'preferred_units'           => 'MI',
                'timezone'                  => 'US\/Arizona',
                'level'                     => 0,
                'custom_data'               => [
                    'animal' => 'lion',
                    'bird'   => 'eagle'
                ],
                'api_key'                   => '11111111111111111111111111111111'
            ]
        );
    }

    public function testGetUsers()
    {
        $member = new Member();

        $response = $member->getUsers();

        $this->assertNotNull($response);
        $this->assertTrue(is_array($response));
        $this->assertTrue(sizeof($response)>0);
        $this->assertInstanceOf(
            ResultsResponseV4::class,
            ResultsResponseV4::fromArray($response)
        );
        $this->assertTrue(isset($response['total']));
        $this->assertTrue(isset($response['results']));
        $this->assertTrue(is_array($response['results']));
        $this->assertInstanceOf(
            MemberResponseV4::class,
            MemberResponseV4::fromArray($response['results'][0])
        );
    }

    public function testGetUserById()
    {
        $member = new Member();

        $param = [
            'member_id' => self::$createdMembers[0]->member_id,
        ];

        $response = $member->getUser($param);

        $this->assertNotNull($response);
        $this->assertInstanceOf(
            MemberResponseV4::class,
            MemberResponseV4::fromArray($response)
        );
    }

    public function testUpdateMember()
    {
        $member = new Member();

        $params = Member::fromArray([
            'member_id'     => self::$createdMembers[0]->member_id,
            'member_phone'  => '555-777-888',
        ]);

        $response = $member->updateMember($params);

        $this->assertNotNull($response);
        $this->assertInstanceOf(
            MemberResponseV4::class,
            MemberResponseV4::fromArray($response)
        );
        $this->assertEquals(
            '555-777-888',
            $response['member_phone']
        );
    }

    public function testAddEditCustomDataToUser()
    {
        $member = new Member();

        $params = Member::fromArray([
            'member_id'     => self::$createdMembers[0]->member_id,
            'custom_data'   => ['Custom Key 2' => 'Custom Value 2'],
        ]);

        $response = $member->updateMember($params);

        $this->assertNotNull($response);
        $this->assertInstanceOf(
            MemberResponseV4::class,
            MemberResponseV4::fromArray($response)
        );
        $this->assertEquals(
            ['Custom Key 2' => 'Custom Value 2'],
            $response['custom_data']
        );
    }

    public function testUserAuthentication()
    {
        $Parameters = Member::fromArray([
            'strEmail'      => self::$createdMembers[0]->member_email,
            'strPassword'   => '123456',
            'format'        => 'json',
        ]);

        $member = new Member();

        $response = $member->memberAuthentication($Parameters);

        $this->assertNotNull($response);
        $this->assertInstanceOf(
            MemberResponse::class,
            MemberResponse::fromArray($response)
        );
    }

    public function testValidateSession()
    {
        $member = new Member();

        //region -- Authenticate a user and get session guid --

        $recordParameters = Member::fromArray([
            'strEmail'      => self::$createdMembers[0]->member_email,
            'strPassword'   => '123456',
            'format'        => 'json',
        ]);

        $response = $member->memberAuthentication($recordParameters);

        $this->assertNotNull($response);
        $this->assertInstanceOf(
            MemberAuthenticationResponse::class,
            MemberAuthenticationResponse::fromArray($response)
        );

        //endregion

        $sessionGuid = $response['session_guid'];
        $memberID = $response['member_id'];

        // Validate the session
        $params = Member::fromArray([
            'session_guid'  => $sessionGuid,
            'format'        => 'json',
            'user_key'      => 1,
        ]);

        $result = $member->validateSession($params);

        $this->assertNotNull($result);
        $this->assertInstanceOf(
            MemberResponse::class,
            MemberResponse::fromArray($result)
        );
    }

    public function testUserRegistration()
    {
        $this->markTestSkipped('must be revisited.'); // This test requires valid user email
        $registrParameters = Member::fromArray([
            'strEmail'      => 'aaaaaaaaaaaaaaa@gmail.com',
            'strPassword_1' => 'ooo111111',
            'strPassword_2' => 'ooo111111',
            'strFirstName'  => 'Driver',
            'strLastName'   => 'Driverson',
            'format'        => 'json',
            'strIndustry'   => 'Gifting',
            'chkTerms'      => 1,
            'device_type'   => 'web',
            'plan'          => 'free',
        ]);

        $member = new Member();
        $errorText = "";

        $response = $member->newAccountRegistration($registrParameters, $errorText);

        $this->assertNotNull($response);
        $this->assertInstanceOf(MemberResponse::class, $response);
    }

    public function testCreateUser()
    {
        $date = new \DateTime();

        $params = Member::fromArray([
            'HIDE_ROUTED_ADDRESSES'     => 'FALSE',
            'member_phone'              => '571-259-5939',
            'member_zipcode'            => '22102',
            'route_count'               => null,
            'member_email'              => 'regression.autotests+'.$date->getTimestamp().'@gmail.com',
            'HIDE_VISITED_ADDRESSES'    => 'FALSE',
            'READONLY_USER'             => 'FALSE',
            'member_type'               => 'SUB_ACCOUNT_DRIVER',
            'date_of_birth'             => '1994-10-01',
            'member_first_name'         => 'John',
            'member_password'           => '123456',
            'HIDE_NONFUTURE_ROUTES'     => 'FALSE',
            'member_last_name'          => 'Doe',
            'SHOW_ALL_VEHICLES'         => 'FALSE',
            'SHOW_ALL_DRIVERS'          => 'FALSE',
        ]);

        $member = new Member();

        $response = $member->createMember($params);

        self::assertNotNull($response);
        self::assertInstanceOf(
            MemberResponseV4::class,
            MemberResponseV4::fromArray($response)
        );

        self::$createdMembers[] = MemberResponseV4::fromArray($response);
    }

    public function testDeleteUser()
    {
        $member = new Member();
        $errorText = "";

        $memberID = self::$createdMembers[sizeof(self::$createdMembers)-1]->member_id;

        // Delete member from the user's account
        $params = Member::fromArray([
            'member_id' => $memberID,
        ]);

        $response = $member->deleteMember($params, $errorText);

        $this->assertNotNull($response, $errorText);
        $this->assertTrue(isset($response['status']));
        $this->assertTrue($response['status']);

        self::$createdMembers[] = array_pop(self::$createdMembers);
    }

    public function testGetMemberCapabilities()
    {
        $member = new Member();

        $memberCapabalities = member::getMemberCapabilities();

        $this->assertNotNull($memberCapabalities);
        $this->assertInstanceOf(
            MemberCapabilities::class,
            MemberCapabilities::fromArray($memberCapabalities)
        );
    }

    public static function tearDownAfterClass()
    {
        if (sizeof(self::$createdMembers)>0) {
            $member = new Member();
            $errorText = "";

            foreach (self::$createdMembers as $createdMember) {
                $params = Member::fromArray([
                    'member_id' => $createdMember->member_id,
                ]);

                $response = $member->deleteMember($params, $errorText);

                if (!is_null($response) && isset($response['status']) && $response['status']) {
                    echo "The member ".$createdMember->member_id." removed <br>";
                } else {
                    echo "Cannot remove the member ".$createdMember->member_id." <br>".$errorText;
                }
            }
        }
    }
}