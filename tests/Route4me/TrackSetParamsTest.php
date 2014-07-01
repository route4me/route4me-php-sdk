<?php

namespace Route4me;

use Route4me\Exception\BadParam;
use Route4me\Enum\DeviceType;
use Route4me\Enum\Format;
use Route4me\TrackSetParams;

class TrackSetParamsTest extends \PHPUnit_Framework_TestCase
{
    protected $test_route_id = '196cf29ed924523e198009cd96deada3';
    /**
     *  @expectedException Route4me\Exception\BadParam
     **/
    function testTrackWithoutParams()
    {
        TrackSetParams::fromArray(array());
    }

    /**
     *  @expectedException Route4me\Exception\BadParam
     **/
    function testTrackWithBadFormat()
    {
        TrackSetParams::fromArray(array(
            'format' => 'test format'
        ));
    }

    /**
     *  @expectedException Route4me\Exception\BadParam
     **/
    function testTrackWithoutRouteId()
    {
        TrackSetParams::fromArray(array(
            'format' => Format::CSV
        ));
    }

    /**
     *  @expectedException Route4me\Exception\BadParam
     **/
    function testTrackWithoutMemberId()
    {
        TrackSetParams::fromArray(array(
            'format'   => Format::CSV,
            'route_id' => $this->test_route_id,
        ));
    }

    /**
     *  @expectedException Route4me\Exception\BadParam
     **/
    function testTrackWithoutCourse()
    {
        TrackSetParams::fromArray(array(
            'format' => Format::CSV,
            'route_id' => $this->test_route_id,
            'member_id' => '1'
        ));
    }

    /**
     *  @expectedException Route4me\Exception\BadParam
     **/
    function testTrackWithoutSpeed()
    {
        TrackSetParams::fromArray(array(
            'format' => Format::CSV,
            'route_id' => $this->test_route_id,
            'member_id' => '1',
            'course' => '1'
        ));
    }

    /**
     *  @expectedException Route4me\Exception\BadParam
     **/
    function testTrackWithoutLat()
    {
        TrackSetParams::fromArray(array(
            'format' => Format::CSV,
            'route_id' => $this->test_route_id,
            'member_id' => '1',
            'course' => '1',
            'speed' => 120
        ));
    }

    /**
     *  @expectedException Route4me\Exception\BadParam
     **/
    function testTrackWithoutLng()
    {
        TrackSetParams::fromArray(array(
            'format' => Format::CSV,
            'route_id' => $this->test_route_id,
            'member_id' => '1',
            'course' => '1',
            'speed' => 120,
            'lat' => '33.33'
        ));
    }

    /**
     *  @expectedException Route4me\Exception\BadParam
     **/
    function testTrackWithoutDeviceType()
    {
        TrackSetParams::fromArray(array(
            'format' => Format::CSV,
            'route_id' => $this->test_route_id,
            'member_id' => '1',
            'course' => '1',
            'speed' => 120,
            'lat' => '41.8927521',
            'lng' => '-109.0803888'
        ));
    }

    /**
     *  @expectedException Route4me\Exception\BadParam
     **/
    function testTrackWithInvalidDeviceType()
    {
        TrackSetParams::fromArray(array(
            'format' => Format::CSV,
            'route_id' => $this->test_route_id,
            'member_id' => '1',
            'course' => '1',
            'speed' => 120,
            'lat' => '41.8927521',
            'lng' => '-109.0803888',
            'device_type' => 'mega iphone'
        ));
    }

    /**
     *  @expectedException Route4me\Exception\BadParam
     **/
    function testTrackWithoutDeviceGuid()
    {
        TrackSetParams::fromArray(array(
            'format' => Format::CSV,
            'route_id' => $this->test_route_id,
            'member_id' => '1',
            'course' => '1',
            'speed' => 120,
            'lat' => '41.8927521',
            'lng' => '-109.0803888',
            'device_type' => DeviceType::IPHONE,
        ));
    }

    /**
     *  @expectedException Route4me\Exception\BadParam
     **/
    function testTrackWithBadDeviceTimestamp()
    {
        TrackSetParams::fromArray(array(
            'format' => Format::CSV,
            'route_id' => $this->test_route_id,
            'member_id' => '1',
            'course' => '1',
            'speed' => 120,
            'lat' => '41.8927521',
            'lng' => '-109.0803888',
            'device_type' => DeviceType::IPHONE,
            'device_guid' => 'qweqweqwe',
            'device_timestamp' => 'asdasdasd asdaa'
        ));
    }

    /**
     *  @expectedException Route4me\Exception\BadParam
     **/
    function testBadDeviceTimestamp() 
    {
        TrackSetParams::fromArray(array(
            'format' => Format::CSV,
            'route_id' => $this->test_route_id,
            'member_id' => '1',
            'course' => '1',
            'speed' => 120,
            'lat' => '41.8927521',
            'lng' => '-109.0803888',
            'device_type' => DeviceType::IPHONE,
            'device_guid' => 'qweqweqwe',
            'device_timestamp' => date('Y-m-d 0:0:0')
        ));
    }

    function testTrackSetParams()
    {
        $paramArray = array(
            'format' => Format::CSV,
            'route_id' => $this->test_route_id,
            'member_id' => '1',
            'course' => '1',
            'speed' => 120,
            'lat' => '41.8927521',
            'lng' => '-109.0803888',
            'device_type' => DeviceType::IPHONE,
            'device_guid' => 'qweqweqwe',
            'device_timestamp' => date('Y-m-d H:i:s')
        );
        $param = TrackSetParams::fromArray($paramArray);
        $this->assertEquals($param->toArray(), $paramArray);
    }
}
