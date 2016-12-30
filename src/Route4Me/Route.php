<?php

namespace Route4Me;

use Route4Me\Common;
use Route4Me\Address;
use Route4Me\Exception\BadParam;
use Route4Me\RouteParameters;
use Route4Me\Route4Me;
use GuzzleHttp\Client;

class Route extends Common
{
    static public $apiUrl = '/api.v4/route.php';
	static public $apiUrlAddress = '/api.v4/address.php';
	static public $apiUrlDuplicate='/actions/duplicate_route.php';
	static public $apiUrlDelete='/actions/delete_routes.php';
	static public $apiUrlReseq='/api.v3/route/reoptimize_2.php';
	static public $apiUrlMerge='/actions/merge_routes.php';
	static public $apiUrlShare='/actions/route/share_route.php';
	static public $apiUrlNoteFile='/actions/addRouteNotes.php';
	static public $apiUrlAsset='/api.v4/status.php';
	//static public $apiUrlMove='/actions/route/move_route_destination.php';
    public $route_id;
	public $route_destination_id;
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
	public $recipient_email;
	public $httpheaders;
	
	public $dev_lat;
	public $dev_lng;

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
            'api_key' => Route4Me::getApiKey()
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
			
			if (isset($params['query'])) {
                $query['query'] = $params['query'];
            }

            $query['limit'] = isset($params['limit']) ? $params['limit'] : 30;
            $query['offset'] = isset($params['offset']) ? $params['offset'] : 0;
        }

        $json = Route4Me::makeRequst(array(
            'url'    => self::$apiUrl,
            'method' => 'GET',
            'query'  => $query
        ));

        if ($routeId) {
            return Route::fromArray($json); die("");
        } else {
            $routes = array();
            foreach($json as $route) {
                $routes[] = Route::fromArray($route);
            }
            return $routes;
        }
    }

	public function getRoutePoints($routeId, $params)
	{
		$result = Route4Me::makeRequst(array(
            'url'    => self::$apiUrl,
            'method' => 'GET',
            'query'  => array(
            	'api_key' => Route4Me::getApiKey(),
                'route_id' => $routeId,
                'route_path_output' => isset($params['route_path_output']) ? $params['route_path_output'] : null,
                'directions' => isset($params['directions']) ? $params['directions'] : null,
            )
        ));

		return $result;
	}

	public function duplicateRoute($route_id)
	{
		$result = Route4Me::makeRequst(array(
            'url'    => self::$apiUrlDuplicate,
            'method' => 'GET',
            'query'  => array(
            	'api_key' => Route4Me::getApiKey(),
                'route_id' => $route_id,
                'to' => 'none',
            )
        ));
		
		return $result;
	}
	
	public function resequenceRoute($params)
	{
		$result = Route4Me::makeRequst(array(
            'url'    => self::$apiUrl,
            'method' => 'PUT',
            'query'  => array(
            	'api_key' => Route4Me::getApiKey(),
                'route_id' => isset($params['route_id']) ? $params['route_id'] : null,
                'route_destination_id' => isset($params['route_destination_id']) ? $params['route_destination_id'] : null,
            ),
            'body'  => array(
				'addresses' => isset($params['addresses']) ? $params['addresses'] : null,
			)
        ));
		
		return $result;
	}
	
	public function resequenceAllAddresses($params)
	{
		$result = Route4Me::makeRequst(array(
            'url'    => self::$apiUrlReseq,
            'method' => 'GET',
            'query'  => array(
            	'api_key' => Route4Me::getApiKey(),
                'route_id' => isset($params['route_id']) ? $params['route_id'] : null,
                'disable_optimization' => isset($params['disable_optimization']) ? $params['disable_optimization'] : null,
                'optimize' => isset($params['optimize']) ? $params['optimize'] : null,
            )
        ));
		
		return $result;
		
	}

	public function mergeRoutes($params)
	{
		$result = Route4Me::makeRequst(array(
            'url'    => self::$apiUrlMerge,
            'method' => 'POST',
            'query'  => array(
            	'api_key' => Route4Me::getApiKey(),
            ),
            'body'  => array(
				'route_ids' => isset($params['route_ids']) ? $params['route_ids'] : null,
			),
			'HTTPHEADER'  => isset($this->httpheaders) ? $this->httpheaders : null,
        ));
		
		return $result;
	}
	
	public function shareRoute($params)
	{
		$result = Route4Me::makeRequst(array(
            'url'    => self::$apiUrlShare,
            'method' => 'POST',
            'query'  => array(
            	'api_key' => Route4Me::getApiKey(),
            	'route_id' => isset($params['route_id']) ? $params['route_id'] : null,
            ),
            'body'  => array(
				'recipient_email' => isset($params['recipient_email']) ? $params['recipient_email'] : null,
			),
			'Content-Type' => 'multipart/form-data'
        ));
		
		return $result;
	}
	
	// Getting random route_id from existing routes between $offset and $offset+$limit
	public function getRandomRouteId($offset,$limit)
	{
		$query['limit'] = isset($params['limit']) ? $params['limit'] : 30;
        $query['offset'] = isset($params['offset']) ? $params['offset'] : 0;
			
		$json = Route4Me::makeRequst(array(
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
        $route = Route4Me::makeRequst(array(
            'url'    => self::$apiUrl,
            'method' => 'PUT',
            'query'  => array(
                'route_id' => isset($this->route_id) ? $this->route_id : null,
                'route_destination_id' => isset($this->route_destination_id) ? $this->route_destination_id : null,
            ),
            'body' => array (
            	'parameters' => $this->parameters,
            	),
            'HTTPHEADER'  => isset($this->httpheaders) ? $this->httpheaders : null,
        ));

        return Route::fromArray($route);
    }
	
	public function updateAddress()
    {
        $result = Route4Me::makeRequst(array(
            'url'    => self::$apiUrlAddress,
            'method' => 'PUT',
            'query'  => array(
                'route_id' => isset($this->route_id) ? $this->route_id : null,
                'route_destination_id' => isset($this->route_destination_id) ? $this->route_destination_id : null,
            ),
            'body' => get_object_vars($this->parameters),
            'HTTPHEADER'  => isset($this->httpheaders) ? $this->httpheaders : null,
        ));

        return $result;
    }

    public function addAddresses(array $params)
    {
        $route = Route4Me::makeRequst(array(
            'url'    => self::$apiUrl,
            'method' => 'PUT',
            'query'  => array(
            	'api_key' => Route4Me::getApiKey(),
                'route_id' => isset($params['route_id']) ? $params['route_id'] : null,
                'addresses' => isset($params['addresses']) ? $params['addresses'] : null
            )
        ));

        return Route::fromArray($route);
    }
	
	public function insertAddressOptimalPosition(array $params)
	{
		$route = Route4Me::makeRequst(array(
            'url'    => self::$apiUrl,
            'method' => 'PUT',
            'query'  => array(
            	'api_key' => Route4Me::getApiKey(),
                'route_id' => isset($params['route_id']) ? $params['route_id'] : null,
            ),
            'body'  => array(
				'addresses' => isset($params['addresses']) ? $params['addresses'] : null,
				'optimal_position' => isset($params['optimal_position']) ? $params['optimal_position'] : null,
			)
        ));

        return Route::fromArray($route);
	}
	
	public function addNoteFile($params)
	{
		$fname = isset($params['strFilename']) ? $params['strFilename'] : null;
		$rpath = realpath($fname);
		//echo $rpath;die("");
		$result= Route4Me::makeRequst(array(
            'url'    => self::$apiUrlNoteFile,
            'method' => 'POST',
            'query'  => array(
            	'api_key' => Route4Me::getApiKey(),
                'route_id' => isset($params['route_id']) ? $params['route_id'] : null,
                'address_id' => isset($params['address_id']) ? $params['address_id'] : null,
                'dev_lat' => isset($params['dev_lat']) ? $params['dev_lat'] : null,
                'dev_lng' => isset($params['dev_lng']) ? $params['dev_lng'] : null,
                'device_type' => isset($params['device_type']) ? $params['device_type'] : null,
                'dev_lng' => isset($params['dev_lng']) ? $params['dev_lng'] : null,
            ),
            'body'  => array(
				'strUpdateType' => isset($params['strUpdateType']) ? $params['strUpdateType'] : null,
				'strFilename' => isset($params['strFilename']) ? $params['strFilename'] : null,
				'strNoteContents' => isset($params['strNoteContents']) ? $params['strNoteContents'] : null,
			),
			'FILE' => $rpath,

			'HTTPHEADER' => array(
				'Content-Type: application/x-www-form-urlencoded'
			)
        ));

        return $result;
	}

    public function delete($route_id)
    {
        $result = Route4Me::makeRequst(array(
            'url'    => self::$apiUrl,
            'method' => 'DELETE',
            'query'  => array( 'route_id' => $route_id )
        ));
		
		// The code below doesn't work, altough this method is described as workable in REST API 
		/*
		$result = Route4Me::makeRequst(array(
            'url'    => self::$apiUrlDelete,
            'method' => 'GET',
            'query'  => array(
            	'api_key' => Route4Me::getApiKey(),
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
		$route = Route4Me::makeRequst(array(
            'url'    => self::$apiUrl,
            'method' => 'GET',
            'query'  => array(
            	'api_key' => Route4Me::getApiKey(),
                'route_id' => isset($params['route_id']) ? $params['route_id'] : null,
                'device_tracking_history' => isset($params['device_tracking_history']) ? $params['device_tracking_history'] : null
            )
        ));

        return Route::fromArray($route);
		
	}
	
	public function GetTrackingHistoryFromTimeRange(array $params)
	{
		$route = Route4Me::makeRequst(array(
            'url'    => self::$apiUrl,
            'method' => 'GET',
            'query'  => array(
            	'api_key' => Route4Me::getApiKey(),
                'route_id' => isset($params['route_id']) ? $params['route_id'] : null,
                'format' => isset($params['format']) ? $params['format'] : null,
                'time_period' => isset($params['time_period']) ? $params['time_period'] : null,
                'start_date' => isset($params['start_date']) ? $params['device_tracking_history'] : null,
                'end_date' => isset($params['end_date']) ? $params['end_date'] : null
                )
        ));

        return $route;
		
	}
	
	public function GetAssetTracking(array $params)
	{
		$route = Route4Me::makeRequst(array(
            'url'    => self::$apiUrlAsset,
            'method' => 'GET',
            'query'  => array(
            	'api_key' => Route4Me::getApiKey(),
                'tracking' => isset($params['tracking']) ? $params['tracking'] : null
                )
        ));

        return $route;
		
	}
}
