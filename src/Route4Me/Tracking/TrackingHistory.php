<?php


namespace Route4Me\Tracking;

use \Route4Me\Common as Common;

/**
 * Device tracking history data structure.
 * Tracking data key names are shortened to reduce bandwidth usage.
 * @package Route4Me\Tracking
 */
class TrackingHistory extends Common
{
    /**
     * Speed at the time of the location transaction event.
     * @var type string
     */
    public $s;

    /**
     * Speed unit ('mph', 'kph')
     * @var type string
     */
    public $su;

    /**
     *  Latitude at the time of the location transaction event.
     * @var type string
     */
    public $lt;

    /**
     * Member ID
     * @var type integer
     */
    public $m;

    /**
     * Longitude at the time of the location transaction event.
     * @var type string
     */
    public $lg;

    /**
     * Direction/heading at the time of the location transaction event.
     * @var type integer
     */
    public $d;

    /**
     * The original timestamp in unix timestamp format at the moment location transaction event.
     * @var type string
     */
    public $ts;

    /**
     * The original timestamp in a human readable timestamp format at the moment location transaction event.
     * @var type string
     */
    public $ts_friendly;

    /**
     * GPS package src (e.g. 'R4M').
     * @var type string
     */
    public $src;

}