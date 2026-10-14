<?php

namespace Route4Me\Tracking;

class UserTracking extends \Route4Me\Common
{
    /**
     * @var string
     */
    public $route_id;

    /**
     * @var string
     */
    public $device_id;

    /**
     * @var long
     */
    public $activity_timestamp;

    /**
     * @var string
     */
    public $device_timestamp;

    /**
     * @var int
     */
    public $device_type;

    /**
     * @var int
     */
    public $member_id;

    /**
     * @var int
     */
    public $root_member_id;

    /**
     * @var string
     */
    public $vehicle_id;

    /**
     * @var int
     */
    public $direction;

    /**
     * @var int
     */
    public $speed;

    /**
     * @var string
     */
    public $calculated_speed;

    /**
     * @var string
     */
    public $speed_accuracy;

    /**
     * @var string
     */
    public $speed_unit;

    /**
     * @var int
     */
    public $bearing;

    /**
     * @var string
     */
    public $bearing_accuracy;

    /**
     * @var string
     */
    public $accuracy;

    /**
     * @var int
     */
    public $day_id;

    /**
     * @var float
     */
    public $position_lat;

    /**
     * @var float
     */
    public $position_lng;

    /**
     * @var int
     */
    public $altitude;

    /**
     * @var int
     */
    public $footsteps;

    /**
     * @var string
     */
    public $data_source_name;

    /**
     * @var string
     */
    public $custom_data;

    /**
     * @var string
     */
    public $device_timezone;

    /**
     * @var int
     */
    public $device_timezone_offset;

    /**
     * @var string
     */
    public $activity_timestamp_friendly;

    /**
     * @var long
     */
    public $LAST_KNOWN;
}
