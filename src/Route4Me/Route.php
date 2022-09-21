<?php

namespace Route4Me;

use Route4Me\Enum\Endpoint;
use Route4Me\Vehicles\Vehicle;
use Route4Me\RouteParameters;

/**
 * The route data structure
 * @package Route4Me
 */
class Route extends Common
{
    /**
     * The route ID
     * @var string
     */
    public $route_id;

    /**
     * Member ID of a route owner
     * @var integer
     */
    public $member_id;

    /**
     * Optimization problem ID
     * @var string
     */
    public $optimization_problem_id;

    /**
     * Vehicle alias
     * @var string
     */
    public $vehicle_alias;

    /**
     * Driver alias
     * @var string
     */
    public $driver_alias;

    /**
     * Total route's trip distance
     * @var double
     */
    public $trip_distance;

    /**
     * The UDU distance measurement unit for the route.<br>
     * @note km or mi, the route4me api will convert all distance measurements into these units.
     * @var string
     */
    public $udu_distance_unit;

    /**
     * Total route's UDU trip distance
     * @var double
     */
    public $udu_trip_distance;

    /** Miles per gallon
     * @var double
     */
    public $mpg;

    /**
     * Gas price
     * @var double
     */
    public $gas_price;

    /**
     * Total route duration (seconds)
     * @var integer
     */
    public $route_duration_sec;

    /**
     * Number of the destinations in the route.
     * @var integer
     */
    public $destination_count;

    /**
     * Notes count in the route.
     * @var integer
     */
    public $notes_count;

    /**
     * Route parameters
     * @var RouteParameters
     */
    public $parameters;

    /**
     * An array of the route addresses
     * @var Address[]
     */
    public $addresses = [];

    /**
     * An array of the links
     * @var string[]
     */
    public $links = [];

    /**
     * Edge by edge turn-by-turn directions.
     * @var Direction[]
     */
    public $directions = [];

    /**
     * Edge-wise path to be drawn on the map.
     * @var GeoPoint[]
     */
    public $path = [];

    /**
     * A collection of device tracking data with coordinates, speed, and timestamps.
     * @var Tracking\TrackingHistory[]
     */
    public $tracking_history = [];

    /**
     * HTTP headers
     * @var string
     */
    public $httpheaders;

    /**
     * If true, the route is unrouted.
     * @var Boolean
     */
    public $is_unrouted;

    /**
     * User route rating [0, 5]. A null value means no rating was given.<br>
     * Users can rate routes so that future optimizations take these ratings into account.
     * @var integer
     */
    public $user_route_rating;

    /**
     * The member's email
     * @var string
     */
    public $member_email;

    /**
     * URL to a member picture
     * @var string
     */
    public $member_picture;

    /**
     * Member tracking subheadline.
     * @var string
     */
    public $member_tracking_subheadline;

    /**
     * If true, the order is approved for execution.
     * @var Boolean
     */
    public $approved_for_execution;

    /**
     * Counter of the approved revisions.
     * @var integer
     */
    public $approved_revisions_counter;

    /**
     * The member's first name.
     * @var string
     */
    public $member_first_name;

    /**
     * The member's last name.
     * @var string
     */
    public $member_last_name;

    /**
     * Channel name
     * @var string
     */
    public $channel_name;

    /**
     * Total cost of the route.
     * @var double
     */
    public $route_cost;

    /**
     * Total route revenue
     * @var double
     */
    public $route_revenue;

    /**
     * Net revenue per distance unit.
     * @var double
     */
    public $net_revenue_per_distance_unit;

    /**
     * When route created (UNIX format timestamp).
     * @var integer
     */
    public $created_timestamp;

    /**
     * Planned total route duration (seconds).
     * @var integer
     */
    public $planned_total_route_duration;

    /**
     * Total wait time (seconds).
     * @var integer
     */
    public $total_wait_time;

    /**
     * UDU Actual travel distance.
     * @var double
     */
    public $udu_actual_travel_distance;

    /**
     * Actual travel distance.
     * @var double
     */
    public $actual_travel_distance;

    /**
     * Actual travel time (seconds).
     * @var integer
     */
    public $actual_travel_time;

    /**
     * Actual footsteps.
     * @var integer
     */
    public $actual_footsteps;

    /**
     * Working time.
     * @var integer
     */
    public $working_time;

    /**
     * Driving time.
     * @var integer
     */
    public $driving_time;

    /**
     * Idling time.
     * @var integer
     */
    public $idling_time;

    /**
     * Paying miles
     * @var double
     */
    public $paying_miles;

    /**
     * Geofence polygon type.<br>
     * enum: ["circle", "poly", "rect"]
     * @var string
     */
    public $geofence_polygon_type;

    /**
     * Geofence polygon size.
     * @var integer
     */
    public $geofence_polygon_size;

    /**
     * Route notes
     * @var AddressNote[]
     */
    public $notes=[];

    /**
     * A vehicle assigned to the route.
     * @var object of type VehicleResponseV4
     */
    public $vehicle=[];

    /**
     * Member config key-value pairs.
     * @var array
     */
    public $member_config_storage;

    /**
     * Original route
     * @var Route
     */
    public $original_route;

    /**
     * If true, the route will be unlinked from the master optimization.
     * @var Boolean
     */
    public $unlink_from_master_optimization;

    public function __construct()
    {
        Route4Me::setBaseUrl(Endpoint::BASE_URL);
    }

    public static function fromArray(array $params)
    {
        $route = new self();
        $route->route_id = Common::getValue($params, 'route_id');
        $route->member_id = Common::getValue($params, 'member_id');
        $route->member_email = Common::getValue($params, 'member_email');
        $route->member_picture = Common::getValue($params, 'member_picture');
        $route->member_tracking_subheadline = Common::getValue($params, 'member_tracking_subheadline');
        $route->approved_for_execution = Common::getValue($params, 'approved_for_execution');
        $route->approved_revisions_counter = Common::getValue($params, 'approved_revisions_counter');
        $route->member_first_name = Common::getValue($params, 'member_first_name');
        $route->member_last_name = Common::getValue($params, 'member_last_name');
        $route->channel_name = Common::getValue($params, 'channel_name');
        $route->optimization_problem_id = Common::getValue($params, 'optimization_problem_id');
        $route->user_route_rating = Common::getValue($params, 'user_route_rating');
        $route->vehicle_alias = Common::getValue($params, 'vehicle_alias');
        $route->driver_alias = Common::getValue($params, 'driver_alias');
        $route->trip_distance = Common::getValue($params, 'trip_distance');
        $route->udu_distance_unit = Common::getValue($params, 'udu_distance_unit');
        $route->udu_trip_distance = Common::getValue($params, 'udu_trip_distance');
        $route->mpg = Common::getValue($params, 'mpg');
        $route->gas_price = Common::getValue($params, 'gas_price');
        $route->route_duration_sec = Common::getvalue($params, 'route_duration_sec');
        $route->planned_total_route_duration = Common::getvalue($params, 'planned_total_route_duration');
        $route->total_wait_time = Common::getvalue($params, 'total_wait_time');
        $route->udu_actual_travel_distance = Common::getvalue($params, 'udu_actual_travel_distance');
        $route->actual_travel_distance = Common::getvalue($params, 'actual_travel_distance');
        $route->actual_travel_time = Common::getvalue($params, 'actual_travel_time');
        $route->actual_footsteps = Common::getvalue($params, 'actual_footsteps');
        $route->working_time = Common::getvalue($params, 'working_time');
        $route->driving_time = Common::getvalue($params, 'driving_time');
        $route->idling_time = Common::getvalue($params, 'idling_time');
        $route->paying_miles = Common::getvalue($params, 'paying_miles');
        $route->geofence_polygon_type = Common::getvalue($params, 'geofence_polygon_type');
        $route->geofence_polygon_size = Common::getvalue($params, 'geofence_polygon_size');
        $route->destination_count = Common::getvalue($params, 'destination_count');
        $route->notes_count = Common::getvalue($params, 'notes_count');
        $route->is_unrouted = Common::getvalue($params, 'is_unrouted');
        $route->route_cost = Common::getvalue($params, 'route_cost');
        $route->route_revenue = Common::getvalue($params, 'route_revenue');
        $route->net_revenue_per_distance_unit = Common::getvalue($params, 'net_revenue_per_distance_unit');
        $route->created_timestamp = Common::getvalue($params, 'created_timestamp');

        if (isset($params['vehicle'])) {
            $route->vehicle = new Vehicle();
            $route->vehicle = Vehicle::fromArray($params['vehicle']);
            Route4Me::setBaseUrl(Endpoint::BASE_URL);
        };

        $route->member_config_storage = Common::getvalue($params, 'member_config_storage');

        // Make RouteParameters
        if (isset($params['parameters'])) {
            $route->parameters = new RouteParameters();
            $route->parameters = RouteParameters::fromArray($params['parameters']);
            Route4Me::setBaseUrl(Endpoint::BASE_URL);
        }

        if (isset($params['addresses'])) {
            $addresses = [];

            foreach ($params['addresses'] as $address) {
                $addresses[] = Address::fromArray($address);
            }

            $route->addresses = $addresses;
        }

        $route->links = Common::getValue($params, 'links', []);
        $route->notes = Common::getValue($params, 'notes', []);
        $route->directions = Common::getValue($params, 'directions', []);
        $route->path = Common::getValue($params, 'path', []);
        $route->tracking_history = Common::getValue($params, 'tracking_history', []);

        if (isset($params['original_route'])) {
            $route->original_route = Route::fromArray($params['original_route']);
        };

        return $route;
    }

    /**
     * @param RouteParametersQuery $params
     * @return array of the routes
     * @throws Exception\ApiError
     */
    public static function getRoutes($params = null)
    {
        $allQueryFields = ['route_id', 'original', 'route_path_output', 'query', 'directions', 'device_tracking_history', 'limit', 'offset','start_date','end_date'];

        $result = Route4Me::makeRequst([
            'url'       => Endpoint::ROUTE_V4,
            'method'    => 'GET',
            'query'     => Route4Me::generateRequestParameters($allQueryFields, $params),
        ]);

        if (isset($params['route_id'])) {
            if (strlen($params['route_id'])==32) {
                return self::fromArray($result);
            } else {
                return $result;
            }
        } else {
            $routes = [];
            foreach ($result as $route) {
                $routes[] = self::fromArray($route);
            }

            return $routes;
        }
    }

    public function getRoutePoints($params)
    {
        $allQueryFields = ['route_id', 'route_path_output', 'compress_path_points', 'directions'];

        $result = Route4Me::makeRequst([
            'url'    => Endpoint::ROUTE_V4,
            'method' => 'GET',
            'query'  => Route4Me::generateRequestParameters($allQueryFields, $params),
        ]);

        return $result;
    }

    public function duplicateRoute($routeIDs)
    {
        $result = Route4Me::makeRequst([
            'url'    => Endpoint::ROUTE_V4,
            'method' => 'POST',
            'body'   => [
                'duplicate_routes_id' => $routeIDs
            ],
        ]);

        return $result;
    }

    public function resequenceRoute($params)
    {
        $allQueryFields = ['route_id', 'route_destination_id'];
        $allBodyFields = ['addresses'];

        $result = Route4Me::makeRequst([
            'url'       => Endpoint::ROUTE_V4,
            'method'    => 'PUT',
            'query'     => Route4Me::generateRequestParameters($allQueryFields, $params),
            'body'      => Route4Me::generateRequestParameters($allBodyFields, $params),
        ]);

        return $result;
    }

    /**
     * @deprecated 'The method is obsolete, use the method ReoptimizeRoute instead.'
     * @param $params
     * @return mixed|string
     */
    public function resequenceAllAddresses($params)
    {
        $allQueryFields = ['route_id', 'disable_optimization', 'optimize'];

        $result = Route4Me::makeRequst([
            'url'       => Endpoint::REOPTIMIZE_V3_2,
            'method'    => 'GET',
            'query'     => Route4Me::generateRequestParameters($allQueryFields, $params),
        ]);

        return $result;
    }

    /**
     * Reoptimize a route
     * @param $params object of type Route
     * @return mixed|string
     * @throws Exception\ApiError
     */
    public function reoptimizeRoute($params)
    {
        $allQueryFields = ['route_id', 'reoptimize', 'remaining', 'device_type'];

        $result = Route4Me::makeRequst([
            'url'       => Endpoint::ROUTE_V4,
            'method'    => 'PUT',
            'query'     => Route4Me::generateRequestParameters($allQueryFields, $params),
        ]);

        return $result;
    }

    /**
     * Merges the routes
     * @param $params array contains:
     * @param route_ids IDs of the routes to be merged.
     * @param depot_address a depot address of the merged route.
     * @param remove_origin if true, the origin routes will be removed.
     * @param depot_lat the depot's latitude
     * @param depot_lng the depot's longitude
     * @return object of type Status
     * @throws Exception\ApiError
     */
    public function mergeRoutes($params)
    {
        $allBodyFields = ['route_ids', 'depot_address', 'remove_origin', 'depot_lat',  'depot_lng'];

        $result = Route4Me::makeRequst([
            'url'           => Endpoint::ROUTES_MERGE,
            'method'        => 'POST',
            'body'          => Route4Me::generateRequestParameters($allBodyFields, $params),
            'HTTPHEADER'    => 'Content-Type: multipart/form-data',
        ]);

        return $result;
    }

    /**
     * Share a route by an email
     * @param $params RouteParametersQuery contains:
     * @param route_id a route ID to be shared.
     * @param response_format the response format.
     * @param recipient_email Recipient email.
     * @return object of type Status
     * @throws Exception\ApiError
     */
    public function shareRoute($params)
    {
        $allQueryFields = ['route_id', 'response_format'];
        $allBodyFields = ['recipient_email'];

        $result = Route4Me::makeRequst([
            'url'           => Endpoint::ROUTE_SHARE,
            'method'        => 'POST',
            'query'         => Route4Me::generateRequestParameters($allQueryFields, $params),
            'body'          => Route4Me::generateRequestParameters($allBodyFields, $params),
            'HTTPHEADER'    => 'Content-Type: multipart/form-data',
        ]);

        return $result;
    }

    /**
     * Returns random route_id from existing routes between $offset and $offset+$limit
     * @param $offset integer The page number for route listing pagination.
     * @param $limit integer The maximum number of the returned routes.
     * @return string random route ID
     * @throws Exception\ApiError
     */
    public function getRandomRouteId($offset, $limit)
    {
        $params = [
            'offset'    => !is_null($offset) ? $offset : 0,
            'limit'     => !is_null($limit) ? $limit : 30,
        ];

        $route = new self();
        $routes = $route->getRoutes($params);

        if (is_null($routes) || sizeof($routes) < 1) {
            echo '<br> There are no routes in the account. Please, create the routes first. <br>';

            return null;
        }

        $randomIndex = rand(0, sizeof($routes) - 1);

        return $routes[$randomIndex]->route_id;
    }

    /**
     * Update a route
     * @param $params array contains:
     * @param route_id string : route ID
     * @param reoptimize int : if equal to 1 the route re-optimized.
     * @param route_destination_id int : route destination ID
     * @param addresses Address[] : an array of a route addresses.
     * @param parameters RouteParameters : route parameters.
     * @param unlink_from_master_optimization  Boolean : if true, the route will be unlinked from optimization.
     * @return Route updated route
     * @throws Exception\ApiError
     */
    public function updateRoute($params)
    {
        $allQueryFields = ['route_id', 'reoptimize','route_destination_id'];
        $allBodyFields = ['addresses', 'parameters', 'unlink_from_master_optimization'];

        $result = Route4Me::makeRequst([
            'url'       => Endpoint::ROUTE_V4,
            'method'    => 'PUT',
            'query'     => Route4Me::generateRequestParameters($allQueryFields, $params),
            'body'      => (isset($params['addresses']) || isset($params['parameters']) || isset($params['unlink_from_master_optimization']))
                            ? Route4Me::generateRequestParameters($allBodyFields, $params)
                            : null,
        ]);

        return $result;
    }

    public function update()
    {
        $route = Route4Me::makeRequst([
            'url'    => Endpoint::ROUTE_V4,
            'method' => 'PUT',
            'query'  => [
                'route_id' => isset($this->route_id) ? $this->route_id : null,
            ],
            'body'   => [
                'parameters' => $this->parameters,
                ],
            'HTTPHEADER' => isset($this->httpheaders) ? $this->httpheaders : null,
        ]);

        return self::fromArray($route);
    }

    public function updateAddress($address = null)
    {
        $body = sizeof($this->addresses) < 1 ? get_object_vars($this->parameters)
            : (isset($this->addresses[0]) ? $this->addresses[0] : get_object_vars($this->parameters));

        $result = Route4Me::makeRequst([
            'url'    => Endpoint::ADDRESS_V4,
            'method' => 'PUT',
            'query'  => [
                'route_id' => isset($this->route_id) ? $this->route_id : null,
                'route_destination_id' => isset($this->route_destination_id) ? $this->route_destination_id : null,
            ],
            'body'   => $body,
            'HTTPHEADER' => isset($this->httpheaders) ? $this->httpheaders : null,
        ]);

        return $result;
    }

    public function updateRouteAddress()
    {
        $result = Route4Me::makeRequst([
            'url'    => Endpoint::ADDRESS_V4,
            'method' => 'PUT',
            'query'  => [
                'route_id' => isset($this->route_id) ? $this->route_id : null,
                'route_destination_id' => isset($this->route_destination_id) ? $this->route_destination_id : null,
            ],
            'body'   => [
                'parameters' => isset($this->parameters) ? get_object_vars($this->parameters) : null,
                'addresses' => isset($this->addresses) ? $this->addresses : null,
            ],
            'HTTPHEADER' => isset($this->httpheaders) ? $this->httpheaders : null,
        ]);

        return $result;
    }

    public function addAddresses($params)
    {
        $allQueryFields = ['route_id'];
        $allBodyFields = ['addresses'];

        $route = Route4Me::makeRequst([
            'url'           => Endpoint::ROUTE_V4,
            'method'        => 'PUT',
            'query'         => Route4Me::generateRequestParameters($allQueryFields, $params),
            'body'          => Route4Me::generateRequestParameters($allBodyFields, $params),
            'HTTPHEADER'    => isset($this->httpheaders) ? $this->httpheaders : null,
        ]);

        return self::fromArray($route);
    }

    public function insertAddressOptimalPosition(array $params)
    {
        $allQueryFields = ['route_id'];
        $allBodyFields = ['addresses', 'optimal_position'];

        $route = Route4Me::makeRequst([
            'url'    => Endpoint::ROUTE_V4,
            'method' => 'PUT',
            'query'  => Route4Me::generateRequestParameters($allQueryFields, $params),
            'body'   => Route4Me::generateRequestParameters($allBodyFields, $params),
        ]);

        return self::fromArray($route);
    }

    public function addNoteFile($params)
    {
        $fname = isset($params['strFilename']) ? $params['strFilename'] : null;
        $rpath = realpath($fname);

        $allQueryFields = ['route_id', 'address_id', 'dev_lat', 'dev_lng', 'device_type'];
        $allBodyFields = ['strUpdateType', 'strFilename', 'strNoteContents'];

        $result = Route4Me::makeRequst([
            'url'    => Endpoint::ROUTE_NOTES_ADD,
            'method' => 'POST',
            'query'  => Route4Me::generateRequestParameters($allQueryFields, $params),
            'body'   => Route4Me::generateRequestParameters($allBodyFields, $params),
            'FILE'   => $rpath,
            'HTTPHEADER' => [
                'Content-Type: application/x-www-form-urlencoded',
            ],
        ]);

        return $result;
    }

    public function deleteRoutes($route_id)
    {
        $result = Route4Me::makeRequst([
            'url'    => Endpoint::ROUTE_V4,
            'method' => 'DELETE',
            'query'  => [
                'route_id' => $route_id,
            ],
        ]);

        return $result;
    }

    public function GetAddressesFromRoute($route_id)
    {
        $route1 = self::getRoutes(['route_id' => $route_id]);

        if (isset($route1)) {
            return $route1->addresses;
        } else {
            return null;
        }
    }

    public function GetRandomAddressFromRoute($route_id)
    {
        $route1 = self::getRoutes(['route_id' => $route_id]);

        if (isset($route1)) {
            $addresses = $route1->addresses;

            $rnd = rand(0, sizeof($addresses) - 1);

            return $addresses[$rnd];
        } else {
            return null;
        }
    }

    public function getRouteId()
    {
        return $this->route_id;
    }

    public function getOptimizationId()
    {
        return $this->optimization_problem_id;
    }

    public function GetLastLocation(array $params)
    {
        $allQueryFields = ['route_id', 'device_tracking_history'];

        $route = Route4Me::makeRequst([
            'url'    => Endpoint::ROUTE_V4,
            'method' => 'GET',
            'query'  => Route4Me::generateRequestParameters($allQueryFields, $params),
        ]);

        return self::fromArray($route);
    }

    public function GetTrackingHistoryFromTimeRange(array $params)
    {
        $allQueryFields = ['route_id', 'format', 'time_period', 'start_date', 'end_date'];

        $route = Route4Me::makeRequst([
            'url'    => Endpoint::GET_DEVICE_LOCATION,
            'method' => 'GET',
            'query'  => Route4Me::generateRequestParameters($allQueryFields, $params),
        ]);

        return $route;
    }

    public function GetAssetTracking(array $params)
    {
        $allQueryFields = ['tracking'];

        $assetResponse = Route4Me::makeRequst([
            'url'    => Endpoint::STATUS_V4,
            'method' => 'GET',
            'query'  => Route4Me::generateRequestParameters($allQueryFields, $params),
        ]);

        return $assetResponse;
    }
}
