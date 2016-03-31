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
	static public $apiUrlDuplicate='/actions/duplicate_route.php';
	static public $apiUrlDelete='/actions/delete_routes.php';
	//static public $apiUrlMove='/actions/route/move_route_destination.php';
    public $route_id;
    public $optimization_problem_id;
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

	public function duplicateRoute($route_id)
	{
		$result = Route4me::makeRequst(array(
            'url'    => self::$apiUrlDuplicate,
            'method' => 'GET',
            'query'  => array(
            	'api_key' => Route4me::getApiKey(),
                'route_id' => $route_id,
                'to' => 'none',
            )
        ));
		
		return $result;
	}
	
	// Getting random route_id from existing routes between $offset and $offset+$limit
	public function getRandomRouteId($offset,$limit)
	{
		$query['limit'] = isset($params['limit']) ? $params['limit'] : 30;
        $query['offset'] = isset($params['offset']) ? $params['offset'] : 0;
			
		$json = Route4me::makeRequst(array(
            'url'    => self::$apiUrl,
            'method' => 'GET',
            'query'  => $query
        ));
		
		$routes = array();
            foreach($json as $route) {
                $routes[] = Route::fromArray($route);
            }
			
			$num=rand(0,sizeof($routes)-1);
			$rRoute=(array)$routes[$num];
			
			if (is_array($rRoute)) 
			{
				return $rRoute["route_id"];
			}
			else return null;
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

    public function addAddresses(array $params)
    {
        $route = Route4me::makeRequst(array(
            'url'    => self::$apiUrl,
            'method' => 'PUT',
            'query'  => array(
            	'api_key' => Route4me::getApiKey(),
                'route_id' => isset($params['route_id']) ? $params['route_id'] : null,
                'addresses' => isset($params['addresses']) ? $params['addresses'] : null
            )
        ));

        return Route::fromArray($route);
    }

    public function delete($route_id)
    {
        $result = Route4me::makeRequst(array(
            'url'    => self::$apiUrl,
            'method' => 'DELETE',
            'query'  => array( 'route_id' => $route_id )
        ));
		
		// The code below doesn't work, altough this method is described as workable in REST API 
		/*
		$result = Route4me::makeRequst(array(
            'url'    => self::$apiUrlDelete,
            'method' => 'GET',
            'query'  => array(
            	'api_key' => Route4me::getApiKey(),
                'route_id' => $route_id,
            )
        ));
		*/
        return $result;
    }
	
	public function GetAddressesFromRoute($route_id)
	{
		$route1=Route::getRoutes($route_id,null);
		if (isset($route1)) {
			return $route1->addresses();
		} else { return null;}
	}
	
	public function GetRandomAddressFromRoute($route_id)
	{
		$route1=Route::getRoutes($route_id,null);
		
		if (isset($route1)) {
			$addresses=$route1->addresses;
			
			$rnd=rand(0,sizeof($addresses)-1);
			
			return $addresses[$rnd];
			
		} else { return null;}
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
		$route = Route4me::makeRequst(array(
            'url'    => self::$apiUrl,
            'method' => 'GET',
            'query'  => array(
            	'api_key' => Route4me::getApiKey(),
                'route_id' => isset($params['route_id']) ? $params['route_id'] : null,
                'device_tracking_history' => isset($params['device_tracking_history']) ? $params['device_tracking_history'] : null
            )
        ));

        return Route::fromArray($route);
		
	}
}
