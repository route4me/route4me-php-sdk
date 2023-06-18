<?php


namespace Route4Me;

use Route4Me\Common as Common;

/**
 * Structure of the DirectionStep type object.
 * @package Route4Me
 */
class DirectionStep extends Common
{
    /**
     * Name (detailed)
     * @var string
     */
    public $direction;

    /**
     * Name (brief)
     * @var strng
     */
    public $directions;

    /**
     * Distance
     * @var double
     */
    public $distance;

    /**
     * Distance unit
     * @var string
     */
    public $distance_unit;

    /**
     * Maneuver Type. Available values:
     * - Head,Go Straight,Turn Left,Turn Right,Turn Slight Left,
     * - Turn Slight Right,Turn Sharp Left,Turn Sharp Right,
     * - Roundabout Left,Roundabout Right,Uturn Left,Uturn Right,
     * - Ramp Left,Ramp Right,Fork Left,Fork Right,Keep Left,
     * - Keep Right,Ferry,Ferry Train,Merge,Reached Your Destination.
     * @var string
     */
    public $maneuverType;

    /**
     * Compass Direction. Available values:<br>
     *  N, S, W, E, NW, NE, SW, SE
     * @var string
     */
    public $compass_direction;

    /**
     * UDU Distance (UDU: User Distance Unit).
     * @var double
     */
    public $udu_distance;

    /**
     * Direction step duration(seconds)
     * @var integer
     */
    public $duration_sec;

    /**
     * Maneuver Point
     * @var GeoPoint
     */
    public $maneuverPoint;
}
