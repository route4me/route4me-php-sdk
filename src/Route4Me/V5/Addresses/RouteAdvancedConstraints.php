<?php


namespace Route4Me\V5\Addresses;

use Route4Me\Common as Common;

/**
 * Data structure of the property RouteParameters.advanced_constraints
 * @package Route4Me\V5\Addresses
 */
class RouteAdvancedConstraints extends Common
{
    /**
     * Maximum cargo volume per route.
     * @var double
     */
    public $max_cargo_volume;

    /**
     * Vehicle capacity.<br>
     * How much total cargo can be transported per route (units, e.g. cubic meters)
     * @var integer
     */
    public $max_capacity;

    /**
     * Legacy feature which permits a user to request an example number of optimized routes.
     * @var integer
     */
    public $members_count;

    /**
     * An array of the available time windows (e.g. [ [25200, 75000 ] )
     * @var integer[]
     */
    public $available_time_windows;

    /**
     * The driver tags specified in a team member's custom data.<br>
     * e.g. "driver skills":<br>
     * ["Class A CDL", "Class B CDL", "Forklift", "Skid Steer Loader", "Independent Contractor"]
     * @var string[]
     */
    public $tags;

    /**
     * An array of the skilled driver IDs.
     * @var integer[]
     */
    public $route4me_members_id;

    /**
     * An array containing Address objects.
     * @var Address
     */
    public $depot_address;

    /**
     * An array of locations.
     * @var object[]
     */
    public $location_sequence_pattern;

    /**
     * Group.
     * @var string
     */
    public $group;
}
