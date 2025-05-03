<?php

namespace Route4Me\V5\Routes\AddonRoutesApi;

use Route4Me\V5\Enum\Endpoint as Endpoint;
use Route4Me\Enum\Endpoint as EndpointV4;
use Route4Me\V5\Routes\AddonRoutesApi\RouteParametersQuery as RouteParametersQuery;
use Route4Me\V5\Vehicles\DataTypes\Vehicle as Vehicle;
use Route4Me\V5\Routes\RouteParameters as RouteParameters;
use Route4Me\V5\DataObjectBase as DataObjectBase;
use Route4Me\Common as Common;
use Route4Me\Route4Me as Route4Me;
use Route4Me\V5\Addresses\Address as Address;

class Route extends DataObjectBase
{
    public $actual_footsteps;
    public $actual_travel_distance;
    public $actual_travel_time;
    public $addresses_visited_count;
    public $approved_for_execution;
    public $approved_revisions_counter;
    public $bundle_items;
    public $channel_name;
    public $day_id;
    public $depot_address_id;
    public $destination_count;
    public $directions;
    public $driver_alias;
    public $driving_time;
    public $gas_price;
    public $geofence_polygon_size;
    public $geofence_polygon_type;
    public $idling_time;
    public $is_master;
    public $is_unrouted;
    public $master_route_id;
    public $member_config_storage;
    public $member_email;
    public $member_first_name;
    public $member_id;
    public $member_last_name;
    public $member_picture;
    public $member_tracking_subheadline;
    public $mpg;
    public $notes;
    public $notes_count;
    public $organization_id;
    public $path;
    public $paying_miles;
    public $planned_total_route_duration;
    public $root_member_id;
    public $route_duration_sec;
    public $route_end_time;
    public $route_id;
    public $route_progress;
    public $route_start_time;
    public $route_status;
    public $total_wait_time;
    public $trip_distance;
    public $udu_actual_travel_distance;
    public $udu_distance_unit;
    public $udu_trip_distance;
    public $user_route_rating;
    public $vehicle;
    public $vehicle_alias;
    public $working_time;

    public function __construct()
    {
        //\Route4Me\Route4Me::setBaseUrl(EndpointV4::BASE_URL);
        \Route4Me\Route4Me::setBaseUrl("");
    }

    public static function fromArray(array $params)
    {
        $route = new self();

        $route->route_id = Common::getValue($params, 'route_id');
        $route->organization_id = Common::getValue($params, 'organization_id');
        $route->route_progress = Common::getValue($params, 'route_progress');
        $route->depot_address_id = Common::getValue($params, 'depot_address_id');
        $route->root_member_id = Common::getValue($params, 'root_member_id');
        $route->day_id = Common::getValue($params, 'day_id');
        $route->addresses_visited_count = Common::getValue($params, 'addresses_visited_count');
        $route->route_start_time = Common::getValue($params, 'route_start_time');
        $route->route_end_time = Common::getValue($params, 'route_end_time');
        $route->user_route_rating = Common::getValue($params, 'user_route_rating');
        $route->member_id = Common::getValue($params, 'member_id');
        $route->member_email = Common::getValue($params, 'member_email');
        $route->member_first_name = Common::getValue($params, 'member_first_name');
        $route->member_last_name = Common::getValue($params, 'member_last_name');
        $route->channel_name = Common::getValue($params, 'channel_name');
        $route->member_picture = Common::getValue($params, 'member_picture');
        $route->member_tracking_subheadline = Common::getValue($params, 'member_tracking_subheadline');
        $route->approved_for_execution = Common::getValue($params, 'approved_for_execution');
        $route->approved_revisions_counter = Common::getValue($params, 'approved_revisions_counter');
        $route->vehicle_alias = Common::getValue($params, 'vehicle_alias');
        $route->driver_alias = Common::getValue($params, 'driver_alias');
        $route->mpg = Common::getValue($params, 'mpg');
        $route->trip_distance = Common::getValue($params, 'trip_distance');
        $route->udu_distance_unit = Common::getValue($params, 'udu_distance_unit');
        $route->udu_trip_distance = Common::getValue($params, 'udu_trip_distance');
        $route->is_unrouted = Common::getValue($params, 'is_unrouted');
        $route->gas_price = Common::getValue($params, 'gas_price');
        $route->route_duration_sec = Common::getValue($params, 'route_duration_sec');
        $route->planned_total_route_duration = Common::getValue($params, 'planned_total_route_duration');
        $route->total_wait_time = Common::getValue($params, 'total_wait_time');
        $route->udu_actual_travel_distance = Common::getValue($params, 'udu_actual_travel_distance');
        $route->actual_travel_distance = Common::getValue($params, 'actual_travel_distance');
        $route->actual_travel_time = Common::getValue($params, 'actual_travel_time');
        $route->actual_footsteps = Common::getValue($params, 'actual_footsteps');
        $route->working_time = Common::getValue($params, 'working_time');
        $route->driving_time = Common::getValue($params, 'driving_time');
        $route->idling_time = Common::getValue($params, 'idling_time');
        $route->paying_miles = Common::getValue($params, 'paying_miles');
        $route->geofence_polygon_type = Common::getValue($params, 'geofence_polygon_type');
        $route->geofence_polygon_size = Common::getValue($params, 'geofence_polygon_size');
        $route->destination_count = Common::getValue($params, 'destination_count');
        $route->notes_count = Common::getValue($params, 'notes_count');
        $route->notes = Common::getValue($params, 'notes');
        $route->directions = Common::getValue($params, 'directions');
        $route->path = Common::getValue($params, 'path');
        $route->vehicle = Common::getValue($params, 'vehicle');
        $route->member_config_storage = Common::getValue($params, 'member_config_storage');
        $route->is_master = Common::getValue($params, 'is_master');
        $route->bundle_items = Common::getValue($params, 'bundle_items');
        $route->master_route_id = Common::getValue($params, 'master_route_id');
        $route->route_status = Common::getValue($params, 'route_status');

        if (isset($params['vehicle'])) {
            $route->vehicle = new Vehicle();
            $route->vehicle = Vehicle::fromArray($params['vehicle']);
            //Route4Me::setBaseUrl(Endpoint::BASE_URL);
        };

        $route->member_config_storage = Common::getvalue($params, 'member_config_storage');

        // Make RouteParameters
        if (isset($params['parameters'])) {
            $route->parameters = new RouteParameters();
            $route->parameters = RouteParameters::fromArray($params['parameters']);
            Route4Me::setBaseUrl(EndpointV4::BASE_URL);
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

    public static function getRoutes($params = null)
    {
        $allQueryFields = RouteParametersQuery::getAllProperties();

        $result = Route4Me::makeRequst([
            'url'       => Endpoint::Routes,
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

    public function getAllRoutesWithPagination($params)
    {
        $allQueryFields = RouteParametersQuery::getAllProperties();

        $result = Route4Me::makeRequst([
            'url'       => Endpoint::RoutesPaginate,
            'method'    => 'GET',
            'query'     => Route4Me::generateRequestParameters($allQueryFields, $params),
        ]);

        return $result;
    }

    public function getPaginatedRouteListWithoutElasticSearch($params)
    {
        $allQueryFields = RouteParametersQuery::getAllProperties();

        $result = Route4Me::makeRequst([
            'url'       => Endpoint::RoutesFallbackPaginate,
            'method'    => 'GET',
            'query'     => Route4Me::generateRequestParameters($allQueryFields, $params),
        ]);

        return $result;
    }

    public function getRouteDataTableWithoutElasticSearch($params)
    {
        $allBodyFields = ['query', 'filters', 'directions', 'notes', 'page',
            'per_page', 'order_by', 'timezone'];

        $result = Route4Me::makeRequst([
            'url'           => Endpoint::RoutesFallbackDatatable,
            'method'        => 'POST',
            'body'          => Route4Me::generateRequestParameters($allBodyFields, $params),
        ]);

        return $result;
    }

    public function getRouteDataTableWithElasticSearch($params)
    {
        $allBodyFields = ['query', 'filters', 'directions', 'notes', 'page',
            'per_page', 'order_by', 'timezone'];

        $result = Route4Me::makeRequst([
            'url'           => Endpoint::RoutesDatatable,
            'method'        => 'POST',
            'body'          => Route4Me::generateRequestParameters($allBodyFields, $params),
        ]);

        return $result;
    }

    public function getRouteListWithoutElasticSearch($params)
    {
        $allQueryFields = RouteParametersQuery::getAllProperties();

        $result = Route4Me::makeRequst([
            'url'       => Endpoint::RoutesFallback,
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

    public function duplicateRoute($routeIDs)
    {
        $result = Route4Me::makeRequst([
            'url'    => Endpoint::RoutesDuplicate,
            'method' => 'POST',
            'body'   => [
                'duplicate_routes_id' => $routeIDs
            ],
            'HTTPHEADER'    => 'Content-Type: application/json; Accept: application/json',
        ]);

        return $result;
    }

    public function deleteRoutes($routeIDs)
    {
        $routeId = "";
        foreach ($routeIDs as $rid) {
            $routeId.=$rid.',';
        }

        $routeId = rtrim($routeId, ',');

        $result = Route4Me::makeRequst([
            'url'    => Endpoint::Routes,
            'method' => 'DELETE',
            'query'  => [
                'route_id' => $routeId,
            ],
        ]);

        return $result;
    }

    public function getRouteDataTableConfig()
    {
        $result = Route4Me::makeRequst([
            'url'       => Endpoint::RoutesDatatableConfig,
            'method'    => 'GET',
            'query'     => null,
        ]);

        return $result;
    }

    public function getRouteDataTableFallbackConfig()
    {
        $result = Route4Me::makeRequst([
            'url'       => Endpoint::RoutesDatatableConfigFallback,
            'method'    => 'GET',
            'query'     => null,
        ]);

        return $result;
    }

    public function updateRouteParameters($queryParams, $routeParams)
    {
        $allQueryFields = RouteParametersQuery::getAllProperties();
        $allBodyFields = RouteParameters:: getAllProperties();

        $bodyParams = ['parameters' => Route4Me::generateRequestParameters($allBodyFields, $routeParams)];

        $result = Route4Me::makeRequst([
            'url'       => Endpoint::Routes,
            'method'    => 'PUT',
            'query'     => Route4Me::generateRequestParameters($allQueryFields, $queryParams),
            'body'      => $bodyParams,
            'HTTPHEADER'    => 'Content-Type: application/json; Accept: application/json',
        ]);

        return $result;
    }




    public function getRoutePoints($params)
    {
        $allQueryFields = ['route_id', 'route_path_output', 'compress_path_points', 'directions'];

        $result = Route4Me::makeRequst([
            'url'    => EndpointV4::ROUTE_V4,
            'method' => 'GET',
            'query'  => Route4Me::generateRequestParameters($allQueryFields, $params),
        ]);

        return $result;
    }



    public function resequenceRoute($params)
    {
        $allQueryFields = ['route_id', 'route_destination_id'];
        $allBodyFields = ['addresses'];

        $result = Route4Me::makeRequst([
            'url'       => EndpointV4::ROUTE_V4,
            'method'    => 'PUT',
            'query'     => Route4Me::generateRequestParameters($allQueryFields, $params),
            'body'      => Route4Me::generateRequestParameters($allBodyFields, $params),
        ]);

        return $result;
    }

    public function resequenceAllAddresses($params)
    {
        $allQueryFields = ['route_id', 'disable_optimization', 'optimize'];

        $result = Route4Me::makeRequst([
            'url'       => EndpointV4::REOPTIMIZE_V3_2,
            'method'    => 'GET',
            'query'     => Route4Me::generateRequestParameters($allQueryFields, $params),
        ]);

        return $result;
    }

    public function mergeRoutes($params)
    {
        $allBodyFields = ['route_ids', 'depot_address', 'remove_origin', 'depot_lat',  'depot_lng'];

        $result = Route4Me::makeRequst([
            'url'           => EndpointV4::ROUTES_MERGE,
            'method'        => 'POST',
            'body'          => Route4Me::generateRequestParameters($allBodyFields, $params),
            'HTTPHEADER'    => 'Content-Type: multipart/form-data',
        ]);

        return $result;
    }

    public function shareRoute($params)
    {
        $allQueryFields = ['route_id', 'response_format'];
        $allBodyFields = ['recipient_email'];

        $result = Route4Me::makeRequst([
            'url'           => EndpointV4::ROUTE_SHARE,
            'method'        => 'POST',
            'query'         => Route4Me::generateRequestParameters($allQueryFields, $params),
            'body'          => Route4Me::generateRequestParameters($allBodyFields, $params),
            'HTTPHEADER'    => 'Content-Type: multipart/form-data',
        ]);

        return $result;
    }

    // Returns random route_id from existing routes between $offset and $offset+$limit
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

    public function updateRoute($params)
    {
        $allQueryFields = ['route_id', 'reoptimize','route_destination_id'];
        $allBodyFields = ['addresses', 'parameters', 'unlink_from_master_optimization'];

        $result = Route4Me::makeRequst([
            'url'       => EndpointV4::ROUTE_V4,
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
            'url'    => EndpointV4::ROUTE_V4,
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
            'url'    => EndpointV4::ADDRESS_V4,
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
            'url'    => EndpointV4::ADDRESS_V4,
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
            'url'           => EndpointV4::ROUTE_V4,
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
            'url'    => EndpointV4::ROUTE_V4,
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
            'url'    => EndpointV4::ROUTE_NOTES_ADD,
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
            'url'    => EndpointV4::ROUTE_V4,
            'method' => 'GET',
            'query'  => Route4Me::generateRequestParameters($allQueryFields, $params),
        ]);

        return self::fromArray($route);
    }

    public function GetTrackingHistoryFromTimeRange(array $params)
    {
        $allQueryFields = ['route_id', 'format', 'time_period', 'start_date', 'end_date'];

        $route = Route4Me::makeRequst([
            'url'    => EndpointV4::GET_DEVICE_LOCATION,
            'method' => 'GET',
            'query'  => Route4Me::generateRequestParameters($allQueryFields, $params),
        ]);

        return $route;
    }

    public function GetAssetTracking(array $params)
    {
        $allQueryFields = ['tracking'];

        $assetResponse = Route4Me::makeRequst([
            'url'    => EndpointV4::STATUS_V4,
            'method' => 'GET',
            'query'  => Route4Me::generateRequestParameters($allQueryFields, $params),
        ]);

        return $assetResponse;
    }
}
