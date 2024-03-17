<?php


namespace Route4Me;

use Route4Me\Common as Common;

/**
 * Structure of a starting location of a direction object.
 * @package Route4Me
 */
class DirectionLocation extends Common
{
    /**
     * Direction name
     * @var string
     */
    public $name;

    /**
     * Required time for passing the segment (seconds)
     * @var integer
     */
    public $time;

    /**
     * Segment distance
     * @var double
     */
    public $segment_distance;

    /**
     * Start Location
     * @var string
     */
    public $start_location;

    /**
     * End Location
     * @var string
     */
    public $end_location;

    /**
     * Directions Error
     * @var string
     */
    public $directions_error;

    /**
     * Error Code
     * @var integer
     */
    public $error_code;
}
