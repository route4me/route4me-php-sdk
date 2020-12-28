<?php

namespace UnitTestFiles\Test;

use Route4Me\Constants;
use Route4Me\Route4Me;
use Route4Me\TelematicsVendor;

class TelematicsGateWayApiTests extends \PHPUnit\Framework\TestCase
{
    public static function setUpBeforeClass()
    {
        Route4Me::setApiKey(Constants::API_KEY);
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
        $vendors = new TelematicsVendor();

        $randomVendorID = $vendors->GetRandomVendorID(0, 5);

        $vendorParameters = TelematicsVendor::fromArray([
            'vendor_id' => $randomVendorID,
        ]);

        $vendor = new TelematicsVendor();
        $vendorResult = $vendor->GetTelematicsVendors($vendorParameters);

        $this->assertNotNull($vendorResult);
        $this->assertTrue(is_array($vendorResult));
        $this->assertInstanceOf(
            TelematicsVendor::class,
            TelematicsVendor::fromArray($vendorResult)
        );
    }

    public function testSearchVendors()
    {
        $vendorsParameters = TelematicsVendor::fromArray([
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
        $vendorsParameters = TelematicsVendor::fromArray([
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
}