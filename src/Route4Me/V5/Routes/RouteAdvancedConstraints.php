<?php


namespace Route4Me\V5\Routes;

/**
 * Class RouteAdvancedConstraints
 * @package Route4Me\V5\Routes
 */
class RouteAdvancedConstraints extends \Route4Me\Common
{
    /** Maximum cargo volume per route
     * @var double $max_cargo_volume
     */
    public $max_cargo_volume;

    /** Vehicle capacity.
     * <para>How much total cargo can be transported per route (units, e.g. cubic meters)</para>
     * @var integer $max_capacity
     */
    public $max_capacity;

    /** Legacy feature which permits a user to request an example number of optimized routes.
     * @var integer $members_count
     */
    public $members_count;

    /** An array of the available time windows (e.g. [ [25200, 75000 ] )
     * @var Array $available_time_windows
     */
    public $available_time_windows;

    /** The driver tags specified in a team member's custom data.
     * (e.g. "driver skills":
     * ["Class A CDL", "Class B CDL", "Forklift", "Skid Steer Loader", "Independent Contractor"]
     * @var string[] $tags
     */
    public $tags;

    /** An array of the skilled driver IDs.
     * @var integer[] $route4me_members_id
     */
    public $route4me_members_id;

    /**
     * A depot address.
     * @var Address
     */
    public $depot_address;

    /**
     * An array of locations.
     * @var object[]
     */
    public $location_sequence_pattern;

    /**
     * Group name of the advanced constraints.
     * @var string
     */
    public $group;

    public static function fromArray(array $params)
    {
        $routeParams = new self();
        foreach ($params as $key => $value) {
            if (property_exists($routeParams, $key)) {
                $routeParams->{$key} = $value;
            }
        }

        return $routeParams;
    }
}
