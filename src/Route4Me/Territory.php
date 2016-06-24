<?php
	namespace Route4Me;
	
	use Route4Me\Common;
	use Route4Me\Exception\BadParam;
	
	class Territory extends Common
	{
		static public $apiUrl = '/api.v4/territory.php';
	
		public $territory_id;  // Territory id
		public $territory_name; 
		public $territory_color;
		public $member_id;
		public $territory; // Territory parameters
		
		public function __construct () {
			
		}
		
		public static function fromArray(array $params) {
			if (!isset($params['territory_name'])) {
	            throw new BadParam('Territory name must be provided');
	        }
			
			if (!isset($params['territory_color'])) {
	            throw new BadParam('Territory color must be provided');
	        }
			
			if (!isset($params['territory'])) {
	            throw new BadParam('Territory must be provided');
	        }
			
			$territoryparameters = new Territory();
	        foreach($params as $key => $value) {
	            if (property_exists($territoryparameters, $key)) {
	                $territoryparameters->{$key} = $value;
	            }
			}
			
			return $territoryparameters;
		}
		
		public static function getTerritory($territory_id)
	    {
	        $territory = Route4Me::makeRequst(array(
	            'url'    => self::$apiUrl,
	            'method' => 'GET',
	            'query'  => array(
	                'territory_id' => $territory_id
	            )
	        ));
	
	        return $territory;
	    }
		
		public static function getTerritories($params)
	    {
	        $response = Route4Me::makeRequst(array(
	            'url'    => self::$apiUrl,
	            'method' => 'GET',
	            'query'  => array(
	                'offset'  => isset($params->offset) ? $params->offset: null,
	                'limit'   => isset($params->limit) ? $params->limit: null,
	            )
	        ));
	
	        return $response;
	    }

		public static function addTerritory($params)
	    {
	    	$response = Route4Me::makeRequst(array(
	            'url'    => self::$apiUrl,
	            'method' => 'ADD',
	            'query'  => array(
	            	'territory_name' => isset($params->territory_name) ? $params->territory_name: null,
	                'territory_color' => isset($params->territory_color) ? $params->territory_color : null,
	                'territory' => isset($params->territory) ? $params->territory : null,
	            )
	        ));

			return $response;
		}
		
		public function deleteTerritory($territory_id)
	    {
	        $result = Route4Me::makeRequst(array(
	            'url'    => self::$apiUrl,
	            'method' => 'DELETEARRAY',
	            'query'  => array(
	                'territory_id'  => $territory_id
	            )
	        ));
	
	        return $result;
	    }
		
		public function updateTerritory($params)
	    {
	        $response = Route4Me::makeRequst(array(
	            'url'    => self::$apiUrl,
	            'method' => 'PUT',
	            'query'   => (array)$params,

	        ));
	
	        return $response;
	    }
	}
	
?>