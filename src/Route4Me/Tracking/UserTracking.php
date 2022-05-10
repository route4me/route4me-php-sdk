<?php


namespace Route4Me\Tracking;


class UserTracking extends \Route4Me\Common
{
    /** @var string $route_id */
    public $route_id;

    /** @var string $device_id */
    public $device_id;

    /** @var integer $activity_timestamp */
    public $activity_timestamp;

    /** @var string $activity_timestamp */
    public $device_timestamp;

    /** @var int $device_type */
    public $device_type;

    /** @var int $member_id */
    public $member_id;

    /** @var int $root_member_id */
    public $root_member_id;

    /** @var string $vehicle_id */
    public $vehicle_id;

    /** @var int $direction */
    public $direction;

    /** @var int $speed */
    public $speed;

    /** @var string $calculated_speed */
    public $calculated_speed;

    /** @var string $speed_accuracy */
    public $speed_accuracy;

    /** @var string $speed_unit */
    public $speed_unit;

    /** @var int $bearing */
    public $bearing;

    /** @var string $bearing_accuracy */
    public $bearing_accuracy;

    /** @var string $accuracy */
    public $accuracy;

    /** @var int $day_id */
    public $day_id;

    /** @var double $position_lat */
    public $position_lat;

    /** @var double $position_lng */
    public $position_lng;

    /** @var int $altitude */
    public $altitude;

    /** @var int $footsteps */
    public $footsteps;

    /** @var string $data_source_name */
    public $data_source_name;

    /** @var string $custom_data */
    public $custom_data;

    /** @var string $device_timezone */
    public $device_timezone;

    /** @var int $device_timezone_offset */
    public $device_timezone_offset;

    /** @var string $activity_timestamp_friendly */
    public $activity_timestamp_friendly;

    /** @var integer $LAST_KNOWN */
    public $LAST_KNOWN;

    public static function fromArray(array $params)
    {
        $userTracking = new self();

        foreach ($params as $key => $value) {
            if (property_exists($userTracking, $key)) {
                $userTracking->{$key} = $value;
            }
        }

        return $userTracking;
    }
}