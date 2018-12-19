<?php
namespace Route4Me;

use Route4Me\Common;
use Route4Me\Address;
use Route4Me\RouteParameters;
use Route4Me\Route4Me;
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
    public $addresses = array();
    public $links = array();
    public $directions = array();
    public $path = array();
    public $tracking_history = array();
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

    public static function fromArray(array $params) 
    {
        $route = new Route();
        $route->route_id                = Common::getValue($params, 'route_id');
        $route->member_id               = Common::getValue($params, 'member_id');
        $route->optimization_problem_id = Common::getValue($params, 'optimization_problem_id');
        $route->vehicle_alias           = Common::getValue($params, 'vehicle_alias');
        $route->driver_alias            = Common::getValue($params, 'driver_alias');
        $route->trip_distance           = Common::getValue($params, 'trip_distance');
        $route->mpg                     = Common::getValue($params, 'mpg');
        $route->gas_price               = Common::getValue($params, 'gas_price');
        $route->route_duration_sec      = Common::getvalue($params, 'route_duration_sec');
        $route->destination_count       = Common::getvalue($params, 'destination_count');
        $route->is_unrouted             = Common::getvalue($params, 'is_unrouted');

        // Make RouteParameters
        if (isset($params['parameters'])) {
            $route->parameters = RouteParameters::fromArray($params['parameters']);
        }

        if (isset($params['addresses'])) {
            $addresses = array();
            foreach ($params['addresses'] as $address) {
                $addresses[] = Address::fromArray($address);
            }

            $route->addresses = $addresses;
        }

        $route->links            = Common::getValue($params, 'links', array());
        $route->directions       = Common::getValue($params, 'directions', array());
        $route->path             = Common::getValue($params, 'path', array());
        $route->tracking_history = Common::getValue($params, 'tracking_history', array());

        return $route;
    }

    public static function getRoutes($routeId = null, $params = null)
    {
        $result = Route4Me::makeRequst(array(
            'url'    => Endpoint::ROUTE_V4,
            'method' => 'GET',
            'query'  => array(
                'api_key'                  => Route4Me::getApiKey(),
                'route_id'                 => !is_null($routeId) ? implode(',', (array)$routeId) : null,
                'route_path_output'        => isset($params['route_path_output']) ? $params['route_path_output'] : null,
                'query'                    => isset($params['query']) ? $params['query'] : null,
                'directions'               => isset($params['directions']) ? $params['directions'] : null,
                'device_tracking_history'  => isset($params['device_tracking_history']) ? $params['device_tracking_history'] : null,
                'limit'                    => isset($params['limit']) ? $params['limit'] : null,
                'offset'                   => isset($params['offset']) ? $params['offset'] : null
            )
        ));
        
        if ($routeId) {
            return Route::fromArray($result); die("");
        } else {
            $routes = array();
            foreach ($result as $route) {
                $routes[] = Route::fromArray($route);
            }
            return $routes;
        }
    }

    public function getRoutePoints($routeId, $params)
    {
        $result = Route4Me::makeRequst(array(
            'url'    => Endpoint::ROUTE_V4,
            'method' => 'GET',
            'query'  => array(
                'api_key'           => Route4Me::getApiKey(),
                'route_id'          => $routeId,
                'route_path_output' => isset($params['route_path_output']) ? $params['route_path_output'] : null,
                'compress_path_points' => isset($params['compress_path_points']) ? $params['compress_path_points'] : null,
                'directions'        => isset($params['directions']) ? $params['directions'] : null,
            )
        ));

        return $result;
    }

    public function duplicateRoute($route_id)
    {
        $result = Route4Me::makeRequst(array(
            'url'    => Endpoint::ROUTE_DUPLICATE,
            'method' => 'GET',
            'query'  => array(
                'api_key'  => Route4Me::getApiKey(),
                'route_id' => $route_id,
                'to'       => 'none',
            )
        ));
        
        return $result;
    }
    
    public function resequenceRoute($params)
    {
        $result = Route4Me::makeRequst(array(
            'url'    => Endpoint::ROUTE_V4,
            'method' => 'PUT',
            'query'  => array(
                'api_key'              => Route4Me::getApiKey(),
                'route_id'             => isset($params['route_id']) ? $params['route_id'] : null,
                'route_destination_id' => isset($params['route_destination_id']) ? $params['route_destination_id'] : null,
            ),
            'body'   => array(
                'addresses' => isset($params['addresses']) ? $params['addresses'] : null,
            )
        ));
        
        return $result;
    }
    
    public function resequenceAllAddresses($params)
    {
        $result = Route4Me::makeRequst(array(
            'url'    => Endpoint::REOPTIMIZE_V3_2,
            'method' => 'GET',
            'query'  => array(
                'api_key'              => Route4Me::getApiKey(),
                'route_id'             => isset($params['route_id']) ? $params['route_id'] : null,
                'disable_optimization' => isset($params['disable_optimization']) ? $params['disable_optimization'] : null,
                'optimize'             => isset($params['optimize']) ? $params['optimize'] : null,
            )
        ));
        
        return $result;
    }

    public function mergeRoutes($params)
    {
        $result = Route4Me::makeRequst(array(
            'url'    => Endpoint::ROUTES_MERGE,
            'method' => 'POST',
            'query'  => array(
                'api_key' => Route4Me::getApiKey(),
              ),
            'body'   => array(
                'route_ids'     => isset($params['route_ids']) ? $params['route_ids'] : null,
                'depot_address' => isset($params['depot_address']) ? $params['depot_address'] : null,
                'remove_origin' => isset($params['remove_origin']) ? $params['remove_origin'] : null,
                'depot_lat'     => isset($params['depot_lat']) ? $params['depot_lat'] : null,
                'depot_lat'     => isset($params['depot_lat']) ? $params['depot_lat'] : null
              ),
            'HTTPHEADER'  => 'Content-Type: multipart/form-data'
        ));
        
        return $result;
    }
    
    public function shareRoute($params)
    {
        $result = Route4Me::makeRequst(array(
            'url'    => Endpoint::ROUTE_SHARE,
            'method' => 'POST',
            'query'  => array(
                'api_key'         => Route4Me::getApiKey(),
                'route_id'        => isset($params['route_id']) ? $params['route_id'] : null,
                'response_format' => isset($params['response_format']) ? $params['response_format'] : null,
            ),
            'body'  => array(
                'recipient_email' => isset($params['recipient_email']) ? $params['recipient_email'] : null,
            ),
            'HTTPHEADER'  => 'Content-Type: multipart/form-data'
        ));
        
        return $result;
    }
    
    // Returns random route_id from existing routes between $offset and $offset+$limit
    public function getRandomRouteId($offset, $limit)
    {
        $query['limit'] = !is_null($limit) ? $limit : 30;
        $query['offset'] = !is_null($offset) ? $offset : 0;
            
        $json = Route4Me::makeRequst(array(
            'url'    => Endpoint::ROUTE_V4,
            'method' => 'GET',
            'query'  => $query
        ));
        
        if (sizeof($json)>0) {
            $routes = array();
            
            foreach ($json as $route) {
                $routes[] = Route::fromArray($route);
            }
            
            $num = rand(0, sizeof($routes) - 1);
            $rRoute = (array)$routes[$num];
            
            if (is_array($rRoute)) {
                return $rRoute["route_id"];
            } else {
                return null;
            }
        } else {
            echo "<br> There are no routes in the account. Please, create the routes first. <br>";
            return null;
        }
    }

    public function update()
    {
        $route = Route4Me::makeRequst(array(
            'url'    => Endpoint::ROUTE_V4,
            'method' => 'PUT',
            'query'  => array(
                'route_id'  => isset($this->route_id) ? $this->route_id : null
            ),
            'body' => array(
                'parameters' => $this->parameters,
                ),
            'HTTPHEADER'  => isset($this->httpheaders) ? $this->httpheaders : null,
        ));

        return Route::fromArray($route);
    }
    
    public function updateAddress($address = null)
    {
        $body = sizeof($this->addresses)<1 ? get_object_vars($this->parameters) 
            : (isset($this->addresses[0]) ? $this->addresses[0] : get_object_vars($this->parameters));

        $result = Route4Me::makeRequst(array(
            'url'    => Endpoint::ADDRESS_V4,
            'method' => 'PUT',
            'query'  => array(
                'route_id'             => isset($this->route_id) ? $this->route_id : null,
                'route_destination_id' => isset($this->route_destination_id) ? $this->route_destination_id : null,
            ),
            'body'        => $body,
            'HTTPHEADER'  => isset($this->httpheaders) ? $this->httpheaders : null,
        ));

        return $result;
    }

    public function updateRouteAddress()
    {
        $result = Route4Me::makeRequst(array(
            'url'    => Endpoint::ADDRESS_V4,
            'method' => 'PUT',
            'query'  => array(
                'route_id'             => isset($this->route_id) ? $this->route_id : null,
                'route_destination_id' => isset($this->route_destination_id) ? $this->route_destination_id : null,
            ),
            'body'        => array(
                "parameters" => isset($this->parameters) ? get_object_vars($this->parameters) : null,
                "addresses"  => isset($this->addresses) ? $this->addresses : null
            ),
            'HTTPHEADER'  => isset($this->httpheaders) ? $this->httpheaders : null,
        ));

        return $result;
    }

    public function addAddresses($params)
    {
        $route = Route4Me::makeRequst(array(
            'url'    => Endpoint::ROUTE_V4,
            'method' => 'PUT',
            'query'  => array(
                'api_key'   => Route4Me::getApiKey(),
                'route_id'  => isset($params['route_id']) ? $params['route_id'] : null
            ),
            'body'   => array(
                'addresses' => isset($params['addresses']) ? $params['addresses'] : null
            ),
            'HTTPHEADER'  => isset($this->httpheaders) ? $this->httpheaders : null,
        ));

        return Route::fromArray($route);
    }
    
    public function insertAddressOptimalPosition(array $params)
    {
        $route = Route4Me::makeRequst(array(
            'url'    => Endpoint::ROUTE_V4,
            'method' => 'PUT',
            'query'  => array(
                'api_key'  => Route4Me::getApiKey(),
                'route_id' => isset($params['route_id']) ? $params['route_id'] : null,
            ),
            'body'   => array(
                'addresses'        => isset($params['addresses']) ? $params['addresses'] : null,
                'optimal_position' => isset($params['optimal_position']) ? $params['optimal_position'] : null,
            )
        ));

        return Route::fromArray($route);
    }
    
    public function addNoteFile($params)
    {
        $fname = isset($params['strFilename']) ? $params['strFilename'] : null;
        $rpath = realpath($fname);
        
        $result = Route4Me::makeRequst(array(
            'url'    => Endpoint::ROUTE_NOTES_ADD,
            'method' => 'POST',
            'query'  => array(
                'api_key'     => Route4Me::getApiKey(),
                'route_id'    => isset($params['route_id']) ? $params['route_id'] : null,
                'address_id'  => isset($params['address_id']) ? $params['address_id'] : null,
                'dev_lat'     => isset($params['dev_lat']) ? $params['dev_lat'] : null,
                'dev_lng'     => isset($params['dev_lng']) ? $params['dev_lng'] : null,
                'device_type' => isset($params['device_type']) ? $params['device_type'] : null,
                'dev_lng'     => isset($params['dev_lng']) ? $params['dev_lng'] : null,
            ),
            'body'  => array(
                'strUpdateType'   => isset($params['strUpdateType']) ? $params['strUpdateType'] : null,
                'strFilename'     => isset($params['strFilename']) ? $params['strFilename'] : null,
                'strNoteContents' => isset($params['strNoteContents']) ? $params['strNoteContents'] : null,
            ),
            'FILE'  => $rpath,

            'HTTPHEADER' => array(
                'Content-Type: application/x-www-form-urlencoded'
            )
        ));

        return $result;
    }

    public function delete($route_id)
    {
         $result = Route4Me::makeRequst(array(
            'url'    => Endpoint::ROUTES_DELETE,
            'method' => 'DELETE',
            'query'  => array(
                'api_key' => Route4Me::getApiKey(),
                'route_id' => $route_id,
            )
        ));
        
        return $result;
    }
    
    public function GetAddressesFromRoute($route_id)
    {
        $route1 = Route::getRoutes($route_id,null);
        
        if (isset($route1)) {
            return $route1->addresses;
        } else {
            return null;
        }
    }
    
    public function GetRandomAddressFromRoute($route_id)
    {
        $route1 = Route::getRoutes($route_id, null);
        
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
        $route = Route4Me::makeRequst(array(
            'url'    => Endpoint::ROUTE_V4,
            'method' => 'GET',
            'query'  => array(
                'api_key'                 => Route4Me::getApiKey(),
                'route_id'                => isset($params['route_id']) ? $params['route_id'] : null,
                'device_tracking_history' => isset($params['device_tracking_history']) ? $params['device_tracking_history'] : null
            )
        ));

        return Route::fromArray($route);
    }
    
    public function GetTrackingHistoryFromTimeRange(array $params)
    {
        $route = Route4Me::makeRequst(array(
            'url'    => Endpoint::GET_DEVICE_LOCATION,
            'method' => 'GET',
            'query'  => array(
                'api_key'     => Route4Me::getApiKey(),
                'route_id'    => isset($params['route_id']) ? $params['route_id'] : null,
                'format'      => isset($params['format']) ? $params['format'] : null,
                'time_period' => isset($params['time_period']) ? $params['time_period'] : null,
                'start_date'  => isset($params['start_date']) ? $params['start_date'] : null,
                'end_date'    => isset($params['end_date']) ? $params['end_date'] : null
                )
        ));

        return $route;
    }
    
    public function GetAssetTracking(array $params)
    {
        $route = Route4Me::makeRequst(array(
            'url'    => Endpoint::STATUS_V4,
            'method' => 'GET',
            'query'  => array(
                'api_key'  => Route4Me::getApiKey(),
                'tracking' => isset($params['tracking']) ? $params['tracking'] : null
                )
        ));

        return $route;
    }
}
