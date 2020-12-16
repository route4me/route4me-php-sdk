<?php

namespace Route4Me;

use Route4Me\Exception\BadParam;
use Route4Me\Enum\DeviceType;
use Route4Me\Enum\Format;
use Route4Me\Enum\Endpoint;

class TrackSetParams extends Common
{
    public $format;
    public $member_id;
    public $route_id;
    public $tx_id;
    public $vehicle_id;
    public $course;
    public $speed;
    public $lat;
    public $lng;
    public $altitude;
    public $device_type;
    public $device_guid;
    public $device_timestamp;
    public $app_version;

    public function __construct()
    {
        Route4Me::setBaseUrl(Endpoint::BASE_URL);
    }

    public static function fromArray(array $params)
    {
        $param = new self();

        if (!isset($params['format'])) {
            throw new BadParam('format must be provided.');
        }

        $types = [
            Format::SERIALIZED,
            Format::CSV,
            Format::XML,
        ];
        if (!in_array($params['format'], $types)) {
            throw new BadParam('format is invalid.');
        }

        if (!isset($params['route_id'])) {
            throw new BadParam('route_id must be provided.');
        }

        if (!isset($params['member_id'])) {
            throw new BadParam('member_id must be provided.');
        }

        if (!isset($params['course'])) {
            throw new BadParam('course must be provided.');
        }

        if (!isset($params['speed'])) {
            throw new BadParam('speed must be provided.');
        }

        if (!isset($params['lat'])) {
            throw new BadParam('lat must be provided.');
        }

        if (!isset($params['lng'])) {
            throw new BadParam('lng must be provided.');
        }

        if (!isset($params['device_type'])) {
            throw new BadParam('device_type must be provided.');
        }

        $deviceTypes = [
            DeviceType::IPHONE,
            DeviceType::IPAD,
            DeviceType::ANDROID_PHONE,
            DeviceType::ANDROID_TABLET,
        ];
        if (!in_array($params['device_type'], $deviceTypes)) {
            throw new BadParam('device_type is invalid.');
        }

        if (!isset($params['device_guid'])) {
            throw new BadParam('device_guid must be provided.');
        }

        if (isset($params['device_timestamp'])) {
            $template = '/[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}/i';
            if (!preg_match($template, $params['device_timestamp'])) {
                throw new BadParam('device_timestamp is invalid.');
            }
        }

        $param->format = self::getValue($params, 'format');
        $param->route_id = self::getValue($params, 'route_id');
        $param->member_id = self::getValue($params, 'member_id');
        $param->course = self::getValue($params, 'course');
        $param->speed = self::getValue($params, 'speed');
        $param->lat = self::getValue($params, 'lat');
        $param->lng = self::getValue($params, 'lng');
        $param->device_type = self::getValue($params, 'device_type');
        $param->device_guid = self::getValue($params, 'device_guid');
        $param->device_timestamp = self::getValue($params, 'device_timestamp');
        $param->vehicle_id = self::getValue($params, 'vehicle_id');
        $param->altitude = self::getValue($params, 'altitude');
        $param->app_version = self::getValue($params, 'app_version');
        $param->tx_id = self::getValue($params, 'tx_id');

        return $param;
    }
}
