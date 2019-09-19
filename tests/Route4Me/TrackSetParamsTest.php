<?php

namespace Route4Me;

use Route4Me\Enum\DeviceType;
use Route4Me\Enum\Format;

class TrackSetParamsTest extends \PHPUnit_Framework_TestCase
{
    protected $test_route_id = '196cf29ed924523e198009cd96deada3';

    /**
     *  @expectedException \Route4Me\Exception\BadParam
     **/
    public function testTrackWithoutParams()
    {
        TrackSetParams::fromArray([]);
    }

    /**
     *  @expectedException \Route4Me\Exception\BadParam
     **/
    public function testTrackWithBadFormat()
    {
        TrackSetParams::fromArray([
            'format' => 'test format',
        ]);
    }

    /**
     *  @expectedException \Route4Me\Exception\BadParam
     **/
    public function testTrackWithoutRouteId()
    {
        TrackSetParams::fromArray([
            'format' => Format::CSV,
        ]);
    }

    /**
     *  @expectedException \Route4Me\Exception\BadParam
     **/
    public function testTrackWithoutMemberId()
    {
        TrackSetParams::fromArray([
            'format' => Format::CSV,
            'route_id' => $this->test_route_id,
        ]);
    }

    /**
     *  @expectedException \Route4Me\Exception\BadParam
     **/
    public function testTrackWithoutCourse()
    {
        TrackSetParams::fromArray([
            'format' => Format::CSV,
            'route_id' => $this->test_route_id,
            'member_id' => '1',
        ]);
    }

    /**
     *  @expectedException \Route4Me\Exception\BadParam
     **/
    public function testTrackWithoutSpeed()
    {
        TrackSetParams::fromArray([
            'format' => Format::CSV,
            'route_id' => $this->test_route_id,
            'member_id' => '1',
            'course' => '1',
        ]);
    }

    /**
     *  @expectedException \Route4Me\Exception\BadParam
     **/
    public function testTrackWithoutLat()
    {
        TrackSetParams::fromArray([
            'format' => Format::CSV,
            'route_id' => $this->test_route_id,
            'member_id' => '1',
            'course' => '1',
            'speed' => 120,
        ]);
    }

    /**
     *  @expectedException \Route4Me\Exception\BadParam
     **/
    public function testTrackWithoutLng()
    {
        TrackSetParams::fromArray([
            'format' => Format::CSV,
            'route_id' => $this->test_route_id,
            'member_id' => '1',
            'course' => '1',
            'speed' => 120,
            'lat' => '33.33',
        ]);
    }

    /**
     *  @expectedException \Route4Me\Exception\BadParam
     **/
    public function testTrackWithoutDeviceType()
    {
        TrackSetParams::fromArray([
            'format' => Format::CSV,
            'route_id' => $this->test_route_id,
            'member_id' => '1',
            'course' => '1',
            'speed' => 120,
            'lat' => '41.8927521',
            'lng' => '-109.0803888',
        ]);
    }

    /**
     *  @expectedException \Route4Me\Exception\BadParam
     **/
    public function testTrackWithInvalidDeviceType()
    {
        TrackSetParams::fromArray([
            'format' => Format::CSV,
            'route_id' => $this->test_route_id,
            'member_id' => '1',
            'course' => '1',
            'speed' => 120,
            'lat' => '41.8927521',
            'lng' => '-109.0803888',
            'device_type' => 'mega iphone',
        ]);
    }

    /**
     *  @expectedException \Route4Me\Exception\BadParam
     **/
    public function testTrackWithoutDeviceGuid()
    {
        TrackSetParams::fromArray([
            'format' => Format::CSV,
            'route_id' => $this->test_route_id,
            'member_id' => '1',
            'course' => '1',
            'speed' => 120,
            'lat' => '41.8927521',
            'lng' => '-109.0803888',
            'device_type' => DeviceType::IPHONE,
        ]);
    }

    /**
     *  @expectedException \Route4Me\Exception\BadParam
     **/
    public function testTrackWithBadDeviceTimestamp()
    {
        TrackSetParams::fromArray([
            'format' => Format::CSV,
            'route_id' => $this->test_route_id,
            'member_id' => '1',
            'course' => '1',
            'speed' => 120,
            'lat' => '41.8927521',
            'lng' => '-109.0803888',
            'device_type' => DeviceType::IPHONE,
            'device_guid' => 'qweqweqwe',
            'device_timestamp' => 'asdasdasd asdaa',
        ]);
    }

    /**
     *  @expectedException \Route4Me\Exception\BadParam
     **/
    public function testBadDeviceTimestamp()
    {
        TrackSetParams::fromArray([
            'format' => Format::CSV,
            'route_id' => $this->test_route_id,
            'member_id' => '1',
            'course' => '1',
            'speed' => 120,
            'lat' => '41.8927521',
            'lng' => '-109.0803888',
            'device_type' => DeviceType::IPHONE,
            'device_guid' => 'qweqweqwe',
            'device_timestamp' => date('Y-m-d 0:0:0'),
        ]);
    }

    public function testTrackSetParams()
    {
        $paramArray = [
            'format' => Format::CSV,
            'route_id' => $this->test_route_id,
            'member_id' => '1',
            'course' => '1',
            'speed' => 120,
            'lat' => '41.8927521',
            'lng' => '-109.0803888',
            'device_type' => DeviceType::IPHONE,
            'device_guid' => 'qweqweqwe',
            'device_timestamp' => date('Y-m-d H:i:s'),
        ];
        $param = TrackSetParams::fromArray($paramArray);
        $this->assertEquals($param->toArray(), $paramArray);
    }
}
