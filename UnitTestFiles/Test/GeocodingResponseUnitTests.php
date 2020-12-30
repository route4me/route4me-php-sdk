<?php

namespace UnitTestFiles\Test;

use Route4Me\GeocodingResponse;

class GeocodingResponseUnitTests extends \PHPUnit\Framework\TestCase
{
    public function testFromArray()
    {
        $geocodingResponse = GeocodingResponse::fromArray([
            'address'       =>  'Los Angeles International Airport (LAX), 1 World Way, Los Angeles, CA 90045, USA',
            'lat'           =>  33.9415889,
            'lng'           =>  -118.40853,
            'type'          =>  'airport, establishment, point_of_interest',
            'confidence'    =>  'medium',
            'original'      =>  'Los%20Angeles%20International%20Airport,%20CA'
        ]);

        $this->assertEquals('Los Angeles International Airport (LAX), 1 World Way, Los Angeles, CA 90045, USA', $geocodingResponse->address);
        $this->assertEquals(33.9415889, $geocodingResponse->lat);
        $this->assertEquals(-118.40853, $geocodingResponse->lng);
        $this->assertEquals('airport, establishment, point_of_interest', $geocodingResponse->type);
        $this->assertEquals('medium', $geocodingResponse->confidence);
        $this->assertEquals('Los%20Angeles%20International%20Airport,%20CA', $geocodingResponse->original);
    }
}