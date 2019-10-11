<?php

namespace Route4Me;

use Route4Me\Enum\Endpoint;

class Route extends Common
{
    public $route_id;
    public $member_id;
    public $route_destination_id;
    public $optimization_problem_id;
    public $vehicle_alias;
    public $driver_alias;
    public $trip_distance;
    public $mpg;
    public $gas_price;
    public $route_duration_sec;
    public $destination_count;
    public $parameters;
    public $addresses = [];
    public $links = [];
    public $directions = [];
    public $path = [];
    public $tracking_history = [];
    public $recipient_email;
    public $httpheaders;
    public $is_unrouted;
    public $time;

    public $dev_lat;
    public $dev_lng;

    public $user_route_rating;
    public $member_email;
    public $member_first_name;
    public $member_last_name;
    public $channel_name;
    public $route_cost;
    public $route_revenue;
    public $net_revenue_per_distance_unit;
    public $created_timestamp;
    public $planned_total_route_duration;
    public $actual_travel_distance;
    public $actual_travel_time;
    public $actual_footsteps;
    public $working_time;
    public $driving_time;
    public $idling_time;
    public $paying_miles;
    public $geofence_polygon_type;
    public $geofence_polygon_size;
    public $notes;
    public $member_config_storage;
    public $original_route;

    public static function fromArray(array $params)
    {
        $route = new self();
        $route->route_id = Common::getValue($params, 'route_id');
        $route->member_id = Common::getValue($params, 'member_id');
        $route->optimization_problem_id = Common::getValue($params, 'optimization_problem_id');
        $route->vehicle_alias = Common::getValue($params, 'vehicle_alias');
        $route->driver_alias = Common::getValue($params, 'driver_alias');
        $route->trip_distance = Common::getValue($params, 'trip_distance');
        $route->mpg = Common::getValue($params, 'mpg');
        $route->gas_price = Common::getValue($params, 'gas_price');
        $route->route_duration_sec = Common::getvalue($params, 'route_duration_sec');
        $route->destination_count = Common::getvalue($params, 'destination_count');
        $route->is_unrouted = Common::getvalue($params, 'is_unrouted');

        // Make RouteParameters
        if (isset($params['parameters'])) {
            $route->parameters = RouteParameters::fromArray($params['parameters']);
        }

        if (isset($params['addresses'])) {
            $addresses = [];

            foreach ($params['addresses'] as $address) {
                $addresses[] = Address::fromArray($address);
            }

            $route->addresses = $addresses;
        }

        $route->links = Common::getValue($params, 'links', []);
        $route->directions = Common::getValue($params, 'directions', []);
        $route->path = Common::getValue($params, 'path', []);
        $route->tracking_history = Common::getValue($params, 'tracking_history', []);

        return $route;
    }

    public static function getRoutes($params = null)
    {
        $allQueryFields = ['route_id', 'original', 'route_path_output', 'query', 'directions', 'device_tracking_history', 'limit', 'offset','start_date','end_date'];

        $result = Route4Me::makeRequst([
            'url' => Endpoint::ROUTE_V4,
            'method' => 'GET',
            'query' => Route4Me::generateRequestParameters($allQueryFields, $params),
        ]);

        if (isset($params['route_id'])) {
            return self::fromArray($result);
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
            'url' => Endpoint::ROUTE_V4,
            'method' => 'GET',
            'query' => Route4Me::generateRequestParameters($allQueryFields, $params),
        ]);

        return $result;
    }

    public function duplicateRoute($route_id)
    {
        $result = Route4Me::makeRequst([
            'url' => Endpoint::ROUTE_DUPLICATE,
            'method' => 'GET',
            'query' => [
                'route_id' => $route_id,
                'to' => 'none',
            ],
        ]);

        return $result;
    }

    public function resequenceRoute($params)
    {
        $allQueryFields = ['route_id', 'route_destination_id'];
        $allBodyFields = ['addresses'];

        $result = Route4Me::makeRequst([
            'url' => Endpoint::ROUTE_V4,
            'method' => 'PUT',
            'query' => Route4Me::generateRequestParameters($allQueryFields, $params),
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params),
        ]);

        return $result;
    }

    public function resequenceAllAddresses($params)
    {
        $allQueryFields = ['route_id', 'disable_optimization', 'optimize'];

        $result = Route4Me::makeRequst([
            'url' => Endpoint::REOPTIMIZE_V3_2,
            'method' => 'GET',
            'query' => Route4Me::generateRequestParameters($allQueryFields, $params),
        ]);

        return $result;
    }

    public function mergeRoutes($params)
    {
        $allBodyFields = ['route_ids', 'depot_address', 'remove_origin', 'depot_lat',  'depot_lng'];

        $result = Route4Me::makeRequst([
            'url' => Endpoint::ROUTES_MERGE,
            'method' => 'POST',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params),
            'HTTPHEADER' => 'Content-Type: multipart/form-data',
        ]);

        return $result;
    }

    public function shareRoute($params)
    {
        $allQueryFields = ['route_id', 'response_format'];
        $allBodyFields = ['recipient_email'];

        $result = Route4Me::makeRequst([
            'url' => Endpoint::ROUTE_SHARE,
            'method' => 'POST',
            'query' => Route4Me::generateRequestParameters($allQueryFields, $params),
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params),
            'HTTPHEADER' => 'Content-Type: multipart/form-data',
        ]);

        return $result;
    }

    // Returns random route_id from existing routes between $offset and $offset+$limit
    public function getRandomRouteId($offset, $limit)
    {
        $params = [
            'offset' => !is_null($offset) ? $offset : 0,
            'limit' => !is_null($limit) ? $limit : 30,
        ];

        $routes = $this->getRoutes($params);

        if (is_null($routes) || sizeof($routes) < 1) {
            echo '<br> There are no routes in the account. Please, create the routes first. <br>';

            return null;
        }

        $randomIndex = rand(0, sizeof($routes) - 1);

        return $routes[$randomIndex]->route_id;
    }

    public function update()
    {
        $route = Route4Me::makeRequst([
            'url' => Endpoint::ROUTE_V4,
            'method' => 'PUT',
            'query' => [
                'route_id' => isset($this->route_id) ? $this->route_id : null,
            ],
            'body' => [
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
            'url' => Endpoint::ADDRESS_V4,
            'method' => 'PUT',
            'query' => [
                'route_id' => isset($this->route_id) ? $this->route_id : null,
                'route_destination_id' => isset($this->route_destination_id) ? $this->route_destination_id : null,
            ],
            'body' => $body,
            'HTTPHEADER' => isset($this->httpheaders) ? $this->httpheaders : null,
        ]);

        return $result;
    }

    public function updateRouteAddress()
    {
        $result = Route4Me::makeRequst([
            'url' => Endpoint::ADDRESS_V4,
            'method' => 'PUT',
            'query' => [
                'route_id' => isset($this->route_id) ? $this->route_id : null,
                'route_destination_id' => isset($this->route_destination_id) ? $this->route_destination_id : null,
            ],
            'body' => [
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
            'url' => Endpoint::ROUTE_V4,
            'method' => 'PUT',
            'query' => Route4Me::generateRequestParameters($allQueryFields, $params),
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params),
            'HTTPHEADER' => isset($this->httpheaders) ? $this->httpheaders : null,
        ]);

        return self::fromArray($route);
    }

    public function insertAddressOptimalPosition(array $params)
    {
        $allQueryFields = ['route_id'];
        $allBodyFields = ['addresses', 'optimal_position'];

        $route = Route4Me::makeRequst([
            'url' => Endpoint::ROUTE_V4,
            'method' => 'PUT',
            'query' => Route4Me::generateRequestParameters($allQueryFields, $params),
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params),
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
            'url' => Endpoint::ROUTE_NOTES_ADD,
            'method' => 'POST',
            'query' => Route4Me::generateRequestParameters($allQueryFields, $params),
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params),
            'FILE' => $rpath,
            'HTTPHEADER' => [
                'Content-Type: application/x-www-form-urlencoded',
            ],
        ]);

        return $result;
    }

    public function deleteRoutes($route_id)
    {
        $result = Route4Me::makeRequst([
            'url' => Endpoint::ROUTES_DELETE,
            'method' => 'DELETE',
            'query' => [
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
            'url' => Endpoint::ROUTE_V4,
            'method' => 'GET',
            'query' => Route4Me::generateRequestParameters($allQueryFields, $params),
        ]);

        return self::fromArray($route);
    }

    public function GetTrackingHistoryFromTimeRange(array $params)
    {
        $allQueryFields = ['route_id', 'format', 'time_period', 'start_date', 'end_date'];

        $route = Route4Me::makeRequst([
            'url' => Endpoint::GET_DEVICE_LOCATION,
            'method' => 'GET',
            'query' => Route4Me::generateRequestParameters($allQueryFields, $params),
        ]);

        return $route;
    }

    public function GetAssetTracking(array $params)
    {
        $allQueryFields = ['tracking'];

        $assetResponse = Route4Me::makeRequst([
            'url' => Endpoint::STATUS_V4,
            'method' => 'GET',
            'query' => Route4Me::generateRequestParameters($allQueryFields, $params),
        ]);

        return $assetResponse;
    }
}
