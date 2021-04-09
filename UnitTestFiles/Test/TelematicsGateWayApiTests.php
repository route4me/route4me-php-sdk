<?php

namespace UnitTestFiles\Test;

use Route4Me\Constants;
use Route4Me\Enum\TelematicsVendorsTypes;
use Route4Me\Route4Me;
use Route4Me\Members\Member;
use Route4Me\TelematicsGateway\TelematicsConnection;
use Route4Me\TelematicsGateway\TelematicsConnectionParameters;
use Route4Me\TelematicsGateway\TelematicsVendor;
use Route4Me\TelematicsGateway\TelematicsVendorParameters;
use Route4Me\TelematicsGateway\TelematicsRegisterMemberResponse;
use Route4Me\TelematicsGateway\CreateConnectionResponse;

class TelematicsGateWayApiTests extends \PHPUnit\Framework\TestCase
{
    static $createdConnections = [];
    static $firstMemberId;

    static $api_token;
    static $tomtom_vendor;
    
    public static function setUpBeforeClass()
    {
        Route4Me::setApiKey(Constants::API_KEY);
        
        $member = new Member();
        
        $results = $member->getUsers();

        self::$firstMemberId = Member::fromArray($results['results'][0])->member_id;
        
        print_r("\n member_id = ".self::$firstMemberId."\n");

        //region Get API token

        $vendorParameters = new TelematicsVendorParameters();
        $vendorParameters->member_id = self::$firstMemberId;
        $vendorParameters->api_key = Constants::API_KEY;

        $vendors = new TelematicsVendor();
        $result = $vendors->RegisterTelematicsMember($vendorParameters);

        self::assertNotNull($result);
        self::assertInstanceOf(
            TelematicsRegisterMemberResponse::class,
            TelematicsRegisterMemberResponse::fromArray($result)
        );

        self::$api_token = TelematicsRegisterMemberResponse::fromArray(
            $result
        )->api_token;

        //endregion

        //region Get TomTom vendor

        $vendorsParameters = TelematicsVendorParameters::fromArray([
            //"country"     => "GB",  // uncomment this line for searching by Country
            'is_integrated' => 1,
            //"feature"     => "satellite",  // uncomment this line for searching by Feature
            'search'        => 'tomtom',
            'page'          => 1,
            'per_page'      => 5,
        ]);

        $vendors = new TelematicsVendor();
        $vendorsResults = $vendors->GetTelematicsVendors($vendorsParameters);

        self::assertNotNull($vendorsResults);
        self::assertTrue(is_array($vendorsResults));
        self::assertTrue(sizeof($vendorsResults)>0);
        self::assertTrue(
            TelematicsVendor::fromArray($vendorsResults['vendors'][0])
                instanceof
                TelematicsVendor);

        self::$tomtom_vendor = TelematicsVendor::fromArray($vendorsResults['vendors'][0]);
        //endregion

        //region Create Test Connection

        $vendParams = new TelematicsConnectionParameters();

        $vendParams->vendor       = TelematicsVendorsTypes::GEOTAB;
        $vendParams->account_id   = '54321';
        $vendParams->username     = 'John Doe 0';
        $vendParams->password     = 'password0';
        $vendParams->vehicle_position_refresh_rate    = 60;
        $vendParams->name         = 'Test Geotab Connection from php SDK';
        $vendParams->validate_remote_credentials      = 0;

        $teleConnection = new TelematicsConnection();

        $result2 = $teleConnection->createTelematicsConnection(
            self::$api_token,
            $vendParams->toArray()
        );

        self::assertNotNull($result2);
        self::assertTrue( CreateConnectionResponse::fromArray($result2) instanceof CreateConnectionResponse);

        self::$createdConnections[] = TelematicsConnection::fromArray($result2);
        //endregion
    }

    public function testFromArray()
    {
        $vendorParameters = TelematicsVendor::fromArray([
            'id'            => 14,
            'name'          => 'Borea',
            'slug'          => 'borea',
            'description'   => 'Borea is a leading connected vehicle platform, helping our customers turn data about vehicles and their use into intelligence',
            'logo_url'      => 'https:\/\/storage.googleapis.com\/telematics-directory-production\/silent-passanger555555.png',
            'website_url'   => 'https:\/\/www.borea.com\/',
            'api_docs_url'  => 'https:\/\/www.borea.com\/docs\/',
            'is_integrated' => true,
            'size'          => 'regional',
            'features'      => [
                0 => [
                    'id'    => '1',
                    'name'  => 'Customizable Reports',
                    'slug'  => 'customizable-reports',
                    'feature_group' => 'Analytics & Reporting'
                ],
                1 => [
                    'id'            => '2',
                    'name'          => 'Publicly Accessible API Documention',
                    'slug'          => 'publicly-accessible-api-doc',
                    'feature_group' => 'API & SDK'
                ]
            ],
            'countries' => [
                0 => [
                    'id'            => '38',
                    'country_code'  => 'CA',
                    'country_name'  => 'Canada'
                ],
                1 => [
                    'id'            => '230',
                    'country_code'  => 'USA',
                    'country_name'  => 'United States'
                ]
            ]
        ]);

        $this->assertEquals(14, $vendorParameters->id);
        $this->assertEquals('Borea', $vendorParameters->name);
        $this->assertEquals('borea', $vendorParameters->slug);
        $this->assertEquals(
            'Borea is a leading connected vehicle platform, helping our customers turn data about vehicles and their use into intelligence',
            $vendorParameters->description
        );
        $this->assertEquals(
            'https:\/\/storage.googleapis.com\/telematics-directory-production\/silent-passanger555555.png',
            $vendorParameters->logo_url
        );
        $this->assertEquals('https:\/\/www.borea.com\/', $vendorParameters->website_url);
        $this->assertEquals('https:\/\/www.borea.com\/docs\/', $vendorParameters->api_docs_url);
        $this->assertEquals(true, $vendorParameters->is_integrated);
        $this->assertEquals('regional', $vendorParameters->size);
        $this->assertEquals(
            [
                0 => [
                    'id'            => '1',
                    'name'          => 'Customizable Reports',
                    'slug'          => 'customizable-reports',
                    'feature_group' => 'Analytics & Reporting'
                ],
                1 => [
                    'id'            => '2',
                    'name'          => 'Publicly Accessible API Documention',
                    'slug'          => 'publicly-accessible-api-doc',
                    'feature_group' => 'API & SDK'
                ]
            ],
            $vendorParameters->features
        );
        $this->assertEquals(
            [
                0 => [
                    'id'            => '38',
                    'country_code'  => 'CA',
                    'country_name'  => 'Canada'
                ],
                1 => [
                    'id'            => '230',
                    'country_code'  => 'USA',
                    'country_name'  => 'United States'
                ]
            ],
            $vendorParameters->countries
        );
    }

    public function testToArray()
    {
        $vendorParameters = TelematicsVendor::fromArray([
            'id'            => 14,
            'name'          => 'Borea',
            'slug'          => 'borea',
            'description'   => 'Borea is a leading connected vehicle platform, helping our customers turn data about vehicles and their use into intelligence',
            'logo_url'      => 'https:\/\/storage.googleapis.com\/telematics-directory-production\/silent-passanger555555.png',
            'website_url'   => 'https:\/\/www.borea.com\/',
            'api_docs_url'  => 'https:\/\/www.borea.com\/docs\/',
            'is_integrated' => true,
            'size'          => 'regional',
            'features'      => [
                0 => [
                    'id'            => '1',
                    'name'          => 'Customizable Reports',
                    'slug'          => 'customizable-reports',
                    'feature_group' => 'Analytics & Reporting'
                ],
                1 => [
                    'id'            => '2',
                    'name'          => 'Publicly Accessible API Documention',
                    'slug'          => 'publicly-accessible-api-doc',
                    'feature_group' => 'API & SDK'
                ]
            ],
            'countries' => [
                0 => [
                    'id'            => '38',
                    'country_code'  => 'CA',
                    'country_name'  => 'Canada'
                ],
                1 => [
                    'id'            => '230',
                    'country_code'  => 'USA',
                    'country_name'  => 'United States'
                ]
            ]
        ]);

        $this->assertEquals(14, $vendorParameters->id);
        $this->assertEquals('Borea', $vendorParameters->name);
        $this->assertEquals('borea', $vendorParameters->slug);
        $this->assertEquals(
            'Borea is a leading connected vehicle platform, helping our customers turn data about vehicles and their use into intelligence',
            $vendorParameters->description
        );
        $this->assertEquals(
            'https:\/\/storage.googleapis.com\/telematics-directory-production\/silent-passanger555555.png',
            $vendorParameters->logo_url
        );
        $this->assertEquals('https:\/\/www.borea.com\/', $vendorParameters->website_url);
        $this->assertEquals('https:\/\/www.borea.com\/docs\/', $vendorParameters->api_docs_url);
        $this->assertEquals(true, $vendorParameters->is_integrated);
        $this->assertEquals('regional', $vendorParameters->size);
        $this->assertEquals(
            [
                0 => [
                    'id'            => '1',
                    'name'          => 'Customizable Reports',
                    'slug'          => 'customizable-reports',
                    'feature_group' => 'Analytics & Reporting'
                ],
                1 => [
                    'id'            => '2',
                    'name'          => 'Publicly Accessible API Documention',
                    'slug'          => 'publicly-accessible-api-doc',
                    'feature_group' => 'API & SDK'
                ]
            ],
            $vendorParameters->features
        );
        $this->assertEquals(
            [
                0 => [
                    'id'            => '38',
                    'country_code'  => 'CA',
                    'country_name'  => 'Canada'
                ],
                1 => [
                    'id'            => '230',
                    'country_code'  => 'USA',
                    'country_name'  => 'United States'
                ]
            ],
            $vendorParameters->countries
        );

        $this->assertEquals($vendorParameters->toArray(),
            [
                'id'            => 14,
                'name'          => 'Borea',
                'slug'          => 'borea',
                'description'   => 'Borea is a leading connected vehicle platform, helping our customers turn data about vehicles and their use into intelligence',
                'logo_url'      => 'https:\/\/storage.googleapis.com\/telematics-directory-production\/silent-passanger555555.png',
                'website_url'   => 'https:\/\/www.borea.com\/',
                'api_docs_url'  => 'https:\/\/www.borea.com\/docs\/',
                'is_integrated' => true,
                'size'          => 'regional',
                'features'      => [
                    0 => [
                        'id'            => '1',
                        'name'          => 'Customizable Reports',
                        'slug'          => 'customizable-reports',
                        'feature_group' => 'Analytics & Reporting'
                    ],
                    1 => [
                        'id'            => '2',
                        'name'          => 'Publicly Accessible API Documention',
                        'slug'          => 'publicly-accessible-api-doc',
                        'feature_group' => 'API & SDK'
                    ]
                ],
                'countries' => [
                    0 => [
                        'id'            => '38',
                        'country_code'  => 'CA',
                        'country_name'  => 'Canada'
                    ],
                    1 => [
                        'id'            => '230',
                        'country_code'  => 'USA',
                        'country_name'  => 'United States'
                    ]
                ]
            ]
        );
    }

    public function testGetAllVendors()
    {
        $vendorsParameters = TelematicsVendor::fromArray( [ ] );

        $vendors = new TelematicsVendor();
        $vendorsResults = $vendors->GetTelematicsVendors($vendorsParameters);

        $this->assertNotNull($vendorsResults);
        $this->assertTrue(is_array($vendorsResults));
        $this->assertTrue(sizeof($vendorsResults)>0);
        $this->assertInstanceOf(
            TelematicsVendor::class,
            TelematicsVendor::fromArray($vendorsResults['vendors'][0])
        );
    }

    public function testGetVendor()
    {
        $vendorResult = TelematicsVendor::getVendorById(self::$tomtom_vendor->id);

        $this->assertNotNull($vendorResult);
        $this->assertTrue(is_array($vendorResult));
        $this->assertInstanceOf(
            TelematicsVendor::class,
            TelematicsVendor::fromArray($vendorResult)
        );
    }

    public function testSearchVendors()
    {
        $vendorsParameters = TelematicsVendorParameters::fromArray([
            //"country"     => "GB",  // uncomment this line for searching by Country
            'is_integrated' => 1,
            //"feature"     => "satellite",  // uncomment this line for searching by Feature
            'search'        => 'Fleet',
            'page'          => 1,
            'per_page'      => 5,
        ]);

        $vendors = new TelematicsVendor();
        $vendorsResults = $vendors->GetTelematicsVendors($vendorsParameters);

        $this->assertNotNull($vendorsResults);
        $this->assertTrue(is_array($vendorsResults));
        $this->assertTrue(sizeof($vendorsResults)>0);
        $this->assertInstanceOf(
            TelematicsVendor::class,
            TelematicsVendor::fromArray($vendorsResults['vendors'][0])
        );
    }

    public function testVendorsComparison()
    {
        $vendorsParameters = TelematicsVendorParameters::fromArray([
            'vendors' => '55,56,57',
        ]);

        $vendors = new TelematicsVendor();
        $comparisonResults = $vendors->GetTelematicsVendors($vendorsParameters);

        $this->assertNotNull($comparisonResults);
        $this->assertTrue(is_array($comparisonResults));
        $this->assertTrue(sizeof($comparisonResults)>0);
        $this->assertInstanceOf(
            TelematicsVendor::class,
            TelematicsVendor::fromArray($comparisonResults['vendors'][0])
        );
    }
    
    public function testRegisterTelematicsVendor() 
    {
        $vendorParameters = new TelematicsVendorParameters();
        $vendorParameters->member_id = self::$firstMemberId;
        $vendorParameters->api_key = Constants::API_KEY;
        
        $vendors = new TelematicsVendor();
        $result = $vendors->RegisterTelematicsMember($vendorParameters);
        
        $this->assertNotNull($result);
        $this->assertInstanceOf(
            TelematicsRegisterMemberResponse::class,
            TelematicsRegisterMemberResponse::fromArray($result)
        );
    }

    public function testGetTelematicsConnections()
    {
        $teleConnection = new TelematicsConnection();

        $connections = $teleConnection->getTelematicsConnections(self::$api_token);

        $this->assertNotNull($connections);
        $this->assertTrue(
            TelematicsConnection::fromArray($connections[0])
            instanceof
            TelematicsConnection);
    }

    public function testGetTelematicsConnection()
    {
        $teleConnection = new TelematicsConnection();

        $connection = $teleConnection->getTelematicsConnection(
            self::$api_token,
            self::$createdConnections[sizeof(self::$createdConnections)-1]->connection_token
        );

        $this->assertNotNull($connection);
        $this->assertTrue(
            TelematicsConnection::fromArray($connection)
            instanceof
            TelematicsConnection);
    }

    public function testCreateTelematicsConnection()
    {
        $vendorParameters = new TelematicsConnectionParameters();

        $vendorParameters->vendor_id    = self::$tomtom_vendor->id;
        $vendorParameters->vendor       = self::$tomtom_vendor->slug;
        $vendorParameters->account_id   = '12345';
        $vendorParameters->username     = 'John Doe';
        $vendorParameters->password     = 'password';
        $vendorParameters->vehicle_position_refresh_rate    = 60;
        $vendorParameters->name         = 'Test Telematics Connection from php SDK';
        $vendorParameters->validate_remote_credentials      = 0;

        $teleConnection = new TelematicsConnection();

       $result = $teleConnection->createTelematicsConnection(
           self::$api_token,
           $vendorParameters->toArray()
       );

        $this->assertNotNull($result);
        $this->assertTrue( CreateConnectionResponse::fromArray($result) instanceof CreateConnectionResponse);

        self::$createdConnections[] = TelematicsConnection::fromArray($result);
    }

    public function testUpdateTelematicsConnection()
    {
        $teleConParams = new TelematicsConnectionParameters();

        $teleConParams->vehicle_position_refresh_rate    = 50;
        $teleConParams->name         = 'Test Telematics Connection from php SDK Updated';
        $teleConParams->validate_remote_credentials      = 0;

        $teleConnection = new TelematicsConnection();

        $result = $teleConnection->updateTelematicsConnection(
            self::$api_token,
            self::$createdConnections[0]->connection_token,
            $teleConParams->toArray()
        );

        $this->assertNotNull($result);
        $this->assertTrue(
            TelematicsConnection::fromArray($result)
            instanceof
            TelematicsConnection);
    }

    public static function tearDownAfterClass()
    {
        if (sizeof(self::$createdConnections)>0) {

            $teleConn = new TelematicsConnection();

            foreach (self::$createdConnections as $createdConn) {
                $deleted = $teleConn->deleteTelematicsConnection(
                    self::$api_token,
                    $createdConn->connection_token
                );
            }
        }
    }

}