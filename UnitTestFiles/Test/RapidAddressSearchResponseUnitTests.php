<?php

namespace UnitTestFiles\Test;

use Route4Me\Route4Me;
use Route4Me\RapidAddressSearchResponse;

class RapidAddressSearchResponseUnitTests extends \PHPUnit\Framework\TestCase
{
    public function testFromArray()
    {
        $rapidAddressSearch = RapidAddressSearchResponse::fromArray([
            'zipcode'       => '00601',
            'street_name'   => 'GENERAL DELIVERY',
            'county_no'     => '103'
        ]);

        $this->assertEquals('00601', $rapidAddressSearch->zipcode);
        $this->assertEquals('GENERAL DELIVERY', $rapidAddressSearch->street_name);
        $this->assertEquals('103', $rapidAddressSearch->county_no);
    }
}