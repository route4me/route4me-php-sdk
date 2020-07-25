<?php

namespace UnitTestFiles\Test;

use Route4Me\Constants;
use Route4Me\GeocodingResponse;
use Route4Me\RapidAddressSearchResponse;
use Route4Me\Route4Me;
use Route4Me\Geocoding;

class GeocodingUnitTests extends \PHPUnit\Framework\TestCase
{
    public static function setUpBeforeClass()
    {
        Route4Me::setApiKey(Constants::API_KEY);
    }

    public function testFromArray()
    {
        $geocoding = Geocoding::fromArray([
            'strExportFormat'   => 'json',
            'addresses'         => 'Los20%Angeles20%International20%Airport,20%CA',
        ]);

        $this->assertEquals('json', $geocoding->strExportFormat);
        $this->assertEquals('Los20%Angeles20%International20%Airport,20%CA', $geocoding->addresses);
    }

    public function testForwardGeocoding()
    {
        $geoCodingParameters = [
            'strExportFormat'   => 'json',
            'addresses'         => 'Los20%Angeles20%International20%Airport,20%CA',
        ];

        $fGeocoding = new Geocoding();

        $result = $fGeocoding->forwardGeocoding($geoCodingParameters);

        $this->assertNotNull($result);
        $this->assertTrue(sizeof($result)>0);

        $firstGeocoding = GeocodingResponse::fromArray(
            $result[0]
        );

        $this->assertContainsOnlyInstancesOf(GeocodingResponse::class, [$firstGeocoding]);
    }

    public function testReverseGeocoding()
    {
        $geoCodingParameters = [
            'strExportFormat'   => 'json',
            'addresses'         => '42.35863,-71.05670',
        ];

        $rGeocoding = new Geocoding();

        $result = $rGeocoding->reverseGeocoding($geoCodingParameters);

        $this->assertNotNull($result);
        $this->assertTrue(sizeof($result)>0);

        $firstGeocoding = GeocodingResponse::fromArray(
            $result[0]
        );

        $this->assertContainsOnlyInstancesOf(GeocodingResponse::class, [$firstGeocoding]);
    }

    public function testGetStreetData()
    {
        //region Get Single Street Address
        $result = RapidAddressSearchResponse::fromArray(
            Geocoding::getStreetData(['pk' => 4])
        );

        $this->assertNotNull($result);
        $this->assertContainsOnlyInstancesOf(RapidAddressSearchResponse::class, [$result]);
        //endregion

        //region Get All Street Data
        $resultAll = Geocoding::getStreetData([]);

        $this->assertNotNull($resultAll);
        $this->assertTrue(sizeof($resultAll)>0);

        $firstGeocoding = RapidAddressSearchResponse::fromArray(
            $resultAll[0]
        );

        $this->assertContainsOnlyInstancesOf(RapidAddressSearchResponse::class, [$firstGeocoding]);
        //endregion

        //region Get Street Data Limited
        $resultLimited = Geocoding::getStreetData([
            'offset' => 0,
            'limit'  => 5,
        ]);

        $this->assertNotNull($resultLimited);
        $this->assertTrue(sizeof($resultLimited)>0);

        $firstGeocoding = RapidAddressSearchResponse::fromArray(
            $resultLimited[0]
        );

        $this->assertContainsOnlyInstancesOf(RapidAddressSearchResponse::class, [$firstGeocoding]);
        //endregion
    }

    public function testGetZipCode()
    {
        //region Get All Geocodings With Specified Zipcode
        $resultZipAll = Geocoding::getZipCode(['zipcode' => '00601']);

        $this->assertNotNull($resultZipAll);
        $this->assertTrue(sizeof($resultZipAll)>0);

        $firstGeocoding = RapidAddressSearchResponse::fromArray(
            $resultZipAll[0]
        );

        $this->assertContainsOnlyInstancesOf(RapidAddressSearchResponse::class, [$firstGeocoding]);
        //endregion

        //region Get Limited Geocodings With Specified Zipcode
        $resultZipLimited = Geocoding::getZipCode([
            'zipcode' => '00601',
            'offset'  => 0,
            'limit'   => 20,
        ]);

        $this->assertNotNull($resultZipLimited);
        $this->assertTrue(sizeof($resultZipLimited)>0);

        $firstGeocoding = RapidAddressSearchResponse::fromArray(
            $resultZipLimited[0]
        );

        $this->assertContainsOnlyInstancesOf(RapidAddressSearchResponse::class, [$firstGeocoding]);
        //endregion
    }

    public function testGetService()
    {
        //region Get All Geocodings With Specified Zipcode And House Number
        $resultZipHouseAll = Geocoding::getService([
            'zipcode'     => '00601',
            'housenumber' => 17,
        ]);

        $this->assertNotNull($resultZipHouseAll);
        $this->assertTrue(sizeof($resultZipHouseAll)>0);

        $firstGeocoding = RapidAddressSearchResponse::fromArray(
            $resultZipHouseAll[0]
        );

        $this->assertContainsOnlyInstancesOf(RapidAddressSearchResponse::class, [$firstGeocoding]);
        //endregion

        //region Get Limited Geocodings With Specified Zipcode And House Number
        $resultZipHouseLimited = Geocoding::getService([
            'zipcode'       => '00601',
            'housenumber'   => 17,
            'offset'        => 0,
            'limit'         => 10,
        ]);

        $this->assertNotNull($resultZipHouseLimited);
        $this->assertTrue(sizeof($resultZipHouseLimited)>0);

        $firstGeocoding = RapidAddressSearchResponse::fromArray(
            $resultZipHouseLimited[0]
        );

        $this->assertContainsOnlyInstancesOf(RapidAddressSearchResponse::class, [$firstGeocoding]);
        //endregion
    }

    public static function tearDownAfterClass()
    {

    }
}