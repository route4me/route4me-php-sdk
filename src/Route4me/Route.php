<?php

namespace Route4me;

use Route4me\Common;
use Route4me\Address;
use Route4me\Exception\BadParam;
use Route4me\RouteParameters;
use Route4me\Route4me;
use GuzzleHttp\Client;

class Route extends Common
{
    static public $apiUrl = '/api.v4/route.php';

    private $route_id;
    private $optimization_problem_id;
    public $vehicle_alias;
    public $driver_alias;
    public $trip_distance;
    public $mpg;
    public $gas_price;
    public $route_duration_sec;
    public $parameters;
    public $addresses = array();
    public $links = array();
    public $directions = array();
    public $path = array();
    public $tracking_history = array();

    public static function fromArray(array $params) 
    {
        $route = new Route();
        $route->route_id = Common::getValue($params, 'route_id');
        $route->optimization_problem_id = Common::getValue($params, 'optimization_problem_id');
        $route->vehicle_alias = Common::getValue($params, 'vehicle_alias');
        $route->driver_alias = Common::getValue($params, 'driver_alias');
        $route->trip_distance = Common::getValue($params, 'trip_distance');
        $route->mpg = Common::getValue($params, 'mpg');
        $route->gas_price = Common::getValue($params, 'gas_price');
        $route->route_duration_sec = Common::getvalue($params, 'route_duration_sec');

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

        $route->links = Common::getValue($params, 'links', array());
        $route->directions = Common::getValue($params, 'directions', array());
        $route->path = Common::getValue($params, 'path', array());
        $route->tracking_history = Common::getValue($params, 'tracking_history', array());

        return $route;
    }

    public static function getRoutes($routeId=null, $params=null)
    {
        $query = array(
            'api_key' => Route4me::getApiKey()
        );

        if ($routeId) {
            $query['route_id'] = implode(',', (array) $routeId);
        }

        if ($params) {
            if (isset($params['directions'])) {
                $query['directions'] = $params['directions'];
            }

            if (isset($params['route_path_output'])) {
                $query['route_path_output'] = $params['route_path_output'];
            }

            if (isset($params['device_tracking_history'])) {
                $query['device_tracking_history'] = $params['device_tracking_history'];
            }

            $query['limit'] = isset($params['limit']) ? $params['limit'] : 30;
            $query['offset'] = isset($params['offset']) ? $params['offset'] : 0;
        }

        $json = Route4me::makeRequst(array(
            'url'    => self::$apiUrl,
            'method' => 'GET',
            'query'  => $query
        ));

        if ($routeId) {
            return Route::fromArray($json);
        } else {
            $routes = array();
            foreach($json as $route) {
                $routes[] = Route::fromArray($route);
            }
            return $routes;
        }
    }

    public function update()
    {
        $route = Route4me::makeRequst(array(
            'url'    => self::$apiUrl,
            'method' => 'PUT',
            'query'  => array(
                'route_id' => $this->route_id,
            ),
            'body' => array(
                'parameters' => $this->parameters->toArray()
            )
        ));

        return Route::fromArray($route);
    }

    public function addAddresses(array $addresses)
    {
        $route = Route4me::makeRequst(array(
            'url'    => self::$apiUrl,
            'method' => 'PUT',
            'query'  => array( 'route_id'  => $this->route_id ),
            'body'   => array( 'addresses' => $addresses )
        ));

        return Route::fromArray($route);
    }

    public function delete()
    {
        $route = Route4me::makeRequst(array(
            'url'    => self::$apiUrl,
            'method' => 'DELETE',
            'query'  => array( 'route_id' => $this->route_id )
        ));

        return $route['deleted'];
    }

    public function getRouteId()
    {
        return $this->route_id;
    }

    public function getOptimizationId()
    {
        return $this->optimization_problem_id;
    }
}
