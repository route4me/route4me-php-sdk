<?php

namespace Route4Me;

use phpDocumentor\Reflection\Types\Boolean;
use Route4Me\V5\Addresses\RouteAdvancedConstraints;

/**
 * Route parameters object structure
 * @package Route4Me
 */
class RouteParameters extends Common
{
    /**
     * Let the R4M API know if this SDK request is comming
     * from a file upload within your environment (for analytics).
     * @var Boolean
     */
    public $is_upload;

    /**
     * The tour type of this route. rt is short for round trip,
     * the optimization engine changes its behavior for round trip
     * @var Boolean
     */
    public $rt;

    /**
     * The name of this route. this route name will be accessible in the search API,
     * and also will be displayed on the mobile device of a user.
     * @var string
     */
    public $route_name;

    /**
     * The route start date in UTC, unix timestamp seconds.
     * Used to show users when the route will begin, also used for reporting and analytics.
     * @var integer
     */
    public $route_date;

    /**
     * Offset in seconds relative to the route start date (i.e. 9AM would be 60 * 60 * 9)
     * @var integer
     */
    public $route_time;

    /**
     * @deprecated 'Always false'
     * @var string
     */
    public $shared_publicly;

    /**
     * By disabling optimization, the route optimization engine
     * will not resequence the stops in your.
     * @var disable_optimization
     */
    public $disable_optimization;

    /**
     * Gets or sets the optimize parameter.<br>
     * Availabale values:
     * - Distance,
     * - Time,
     * - timeWithTraffic
     * @var string
     */
    public $optimize;

    /**
     * When the tour type is not round trip (rt = false),
     * enable lock last so that the final destination is fixed.
     * @var Boolean
     */
    public $lock_last;

    /**
     * Vehicle capacity.
     * @var integer
     */
    public $vehicle_capacity;

    /**
     * Maximum distance for a single vehicle in the route (always in miles)
     * @var integer
     */
    public $vehicle_max_distance_mi;

    /**
     * The distance measurement unit for the route.
     * km or mi, the route4me api will convert all measurements into these units.
     * @var string
     */
    public $distance_unit;

    /**
     * The mode of travel that the directions should be optimized for.<br>
     *  Available values:
     * - Driving
     * - Walking
     * @var string
     */
    public $travel_mode;

    /**
     * Options which let the user choose which road obstacles to avoid.<br>
     * This has no impact on route sequencing.<br>
     * Available values:
     * - Highways
     * - Tolls
     * - minimizeHighways
     * - minimizeTolls
     * - highways,tolls
     * - "".
     * @var string
     */
    public $avoid;

    /**
     * The vehicle ID
     * @var string
     */
    public $vehicle_id;

    /**
     * The latitude of the device making this sdk request.
     * @var double
     */
    public $dev_lat;

    /**
     * The longitude of the device making this sdk request.
     * @var double
     */
    public $dev_lng;

    /**
     * When using a multiple driver algorithm, this is the maximum permissible duration of a generated route.<br>
     * The optimization system will automatically create more routes when the route_max_duration is exceeded for a route.<br>
     * However it will create an 'unrouted' list of addresses if the maximum number of drivers is exceeded.
     * @var long
     */
    public $route_max_duration;

    /**
     * The parameter specifies fine-tuning of an optimization process by route duration.
     * @var double
     */
    public $target_duration;

    /**
     * The parameter specifies fine-tuning of an optimization process by route distance.
     * @var double
     */
    public $target_distance;

    /**
     * The parameter specifies fine-tuning of an optimization process by waiting time.
     * @var double
     */
    public $target_wait_by_tail_size;

    /**
     * The email address to notify upon completion of an optimization request.
     * @var string
     */
    public $route_email;

    /**
     * @deprecated All routes are stored by default at this time
     * @var
     */
    public $store_route = true;

    /**
     * Metric system
     * @see Enum\Metric
     * @var integer
     */
    public $metric;

    /**
     * The algorithm type to use when optimizing the route.
     * @see Enum\AlgorithmType
     * @var integer
     */
    public $algorithm_type;

    /**
     * The route owner's member ID.<br>
     * In order for users in your organization to have routes assigned to them,
     * you must provide their member ID within the Route4Me system.<br>
     * A list of member IDs can be retrieved with view_users API method.
     * @var integer
     */
    public $member_id;

    /**
     * Specify the ip address of the remote user making this optimization request.
     * @var long
     */
    public $ip;

    /**
     * The method to use when compute the distance between the points in a route.<br>
     * Available values: from 1 to 12.
     * @var integer
     */
    public $dm;

    /**
     * Directions method.
     * @var integer
     */
    public $dirm;

    /**
     * Legacy feature which permits a user to request an example number of optimized routes.
     * @var integer
     */
    public $parts;

    /**
     * 32 Character MD5 String ID of the device that was used to plan this route.
     * @deprecated Always null
     * @var string
     */
    public $device_id;

    /**
     * The type of device making this request.
     * @see Enum\DeviceType
     * @var string
     */
    public $device_type;

    /**
     * If true, the vehicle has a trailer.<br>
     * For routes that have trucking directions enabled, directions generated<br>
     * will ensure compliance so that road directions generated do not take the vehicle
     * where trailers are prohibited.
     * @var Boolean
     */
    public $has_trailer;

    /**
     * The vehicle's trailer weight.<br>
     * For routes that have trucking directions enabled, directions generated<br>
     * will ensure compliance so that road directions generated do not take the vehicle<br>
     * on roads where the weight of the vehicle in tons exceeds this value.
     * @var double
     */
    public $trailer_weight_t;

    /**
     * If travel_mode is Trucking, specifies the truck weight.
     * @var double
     */
    public $limited_weight_t;

    /**
     * The vehicle's weight per axle (tons)
     * @var double
     */
    public $weight_per_axle_t;

    /**
     * Comma-delimited list of the truck hazardous goods.
     * @var string
     */
    public $truck_hazardous_goods;

    /**
     * Truck axles number.
     * @var integer
     */
    public $truck_axles;

    /**
     * Truck toll road usage. enum: ["YES", "NO"]
     * @var string
     */
    public $truck_toll_road_usage;

    /**
     * Truck avoid ferries. enum: ["YES", "NO"]
     * @var string
     */
    public $truck_avoid_ferries;

    /**
     * Truck highway only. enum: ["YES", "NO"]
     * @var string
     */
    public $truck_hwy_only;

    /**
     * Truck of the type Long Combination Vehicle. enum: ["YES", "NO"]
     * @var string
     */
    public $truck_lcv;

    /**
     * Avoid international borders. enum: ["YES", "NO"]
     * @var string
     */
    public $truck_borders;

    /**
     * Truck side street adherence.<br>
     *  enum: ["OFF", "MINIMAL","MODERATE","AVERAGE","STRICT","ADHERE","STRONGLYHERE"]
     * @var string
     */
    public $truck_side_street_adherence;

    /**
     * Truck configuration.
     * enum: ["NONE","PASSENGER","28_DOUBLETRAILER","48_STRAIGHT_TRUCK",
     * "48_SEMI_TRAILER","53_SEMI_TRAILER","FULLSIZEVAN","26_STRAIGHT_TRUCK"]
     * @var string
     */
    public $truck_config;

    /**
     * Truck dimension unit. enum: ["mi","km"]
     * @var string
     */
    public $truck_dim_unit;

    /**
     * Truck type.
     *  enum: ["suv","pickup_truck","van","18wheeler","cabin","waste_disposal",
     * "tree_cutting","bigrig","cement_mixer","livestock_carrier","dairy", "tractor_trailer"]
     * @var string
     */
    public $truck_type;

    /**
     * If travel_mode = 'Trucking', specifies the truck weight (required)
     * @var double
     */
    public $truck_weight;

    /**
     * Maximum cargo weight a vehicle can cary.
     * @var double
     */
    public $vehicle_max_cargo_weight;

    /**
     * Maximum cargo volume a vehicle can cary.
     * @var double
     */
    public $vehicle_max_cargo_volume;

    /**
     * Maximum allowed revenue from a subtour.
     * @var integer
     */
    public $subtour_max_revenue;

    /**
     * An array of the Avoidance zones IDs.
     * @var string[]
     */
    public $avoidance_zones = [];

    /**
     * The vehicle ID, to be assigned to the route.
     * @deprecated All new routes should be assigned to a member_id
     * @var string
     */
    public $driver_id;

    /**
     * Minimum number of optimized routes.
     * @var integer
     */
    public $parts_min;

    /**
     * If true, the vehicle will first drive then wait between stops.
     * @var Boolean
     */
    public $first_drive_then_wait_between_stops;

    /**
     * The truck height.<br>
     * For routes that have trucking directions enabled, directions generated<br>
     * will ensure compliance of this maximum height of truck when generating
     * road network driving directions.
     * @var double
     */
    public $truck_height;

    /**
     * The truck width.<br>
     * For routes that have trucking directions enabled, directions generated
     * will ensure compliance of this width of the truck when generating road network
     * driving directions.
     * @var double
     */
    public $truck_width;

    /**
     * The truck length.<br>
     * For routes that have trucking directions enabled, directions generated
     * will ensure compliance of this length of the truck when generating
     * road network driving directions.
     * @var double
     */
    public $truck_length;

    /**
     * The optimization quality.<br>
     * Available values:
     * - 1 - Generate Optimized Routes As Quickly as Possible;
     * - 2 - Generate Routes That Look Better On A Map;
     * - 3 - Generate The Shortest And Quickest Possible Routes.
     * @var integer
     */
    public $optimization_quality;

    /**
     * The maximum number of stops permitted per created subroute.
     * @var integer
     */
    public $max_tour_size;

    /**
     * The minimum number of stops permitted per created subroute.
     * @var integer
     */
    public $min_tour_size;

    /**
     * If equal to 1, uturn is allowed for the vehicle.
     * @var integer
     */
    public $uturn;

    /**
     * If equal to 1, leftturn is allowed for the vehicle.
     * @var integer
     */
    public $leftturn;

    /**
     * If equal to 1, rightturn is allowed for the vehicle.
     * @var integer
     */
    public $rightturn;

    /**
     * Route travel time slowdown (e.g. 25 (means 25% slowdown)).
     * @note the parameter is read-only and it can be set
     * with the parameter Slowdowns.TravelTime.
     * @var integer
     */
    public $route_time_multiplier;

    /**
     * Route service time slowdown (e.g. 10 (means 10% slowdown)).
     * @note the parameter is read-only and it can be set
     * with the parameter Slowdowns.TravelTime.
     * @var integer
     */
    public $route_service_time_multiplier;

    /**
     * Optimization engine (e.g. '1','2' etc)
     * @var string
     */
    public $optimization_engine;

    /**
     * Override addresses
     * @var OverrideAddresses
     */
    public $override_addresses;

    /**
     * Address bundling rules
     * @var V5\Addresses\AddressBundling
     */
    public $bundling;

    /**
     * Advanced route constraints
     * @var RouteAdvancedConstraints
     */
    public $advanced_constraints = [];

    /**
     * If true, the time windows ignored.
     * @var Boolean
     */
    public $ignore_tw;

    /**
     * If true, the start time is dynamic.
     * @var Boolean
     */
    public $is_dynamic_start_time;

    /**
     * @deprecated The parameter 'route_type' isn't included in route parameters.
     * @var string
     */
    public $route_type;

    /**
     * Slowdown of the optimization parameters.
     * @note This is only query parameter.
     * @note This parameter is used in the optimization creation/generation process.
     * @var SlowdownParams
     */
    public $slowdowns;

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

    public function setAddressBundle($addressBundle)
    {
        $this->bundling = $addressBundle;
    }

    public function getAddressBundle()
    {
        return $this->bundling;
    }
}
