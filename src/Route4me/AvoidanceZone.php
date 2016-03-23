<?php
	namespace Route4me;
	
	use Route4me\Common;
	use Route4me\Exception\BadParam;
	
	class AvoidanceZone extends Common
	{
		static public $apiUrl = '/api.v4/avoidance.php';
	
		public $territory_id;  // Avoidance zone id
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
			
			$avoidancezoneparameters = new AvoidanceZone();
	        foreach($params as $key => $value) {
	            if (property_exists($avoidancezoneparameters, $key)) {
	                $avoidancezoneparameters->{$key} = $value;
	            }
			}
			
			return $avoidancezoneparameters;
		}
		
		public static function getAvoidanceZone($territory_id)
	    {
	        $avoidancezone = Route4me::makeRequst(array(
	            'url'    => self::$apiUrl,
	            'method' => 'GET',
	            'query'  => array(
	                'territory_id'             => $territory_id
	            )
	        ));
	
	        return $avoidancezone;
	    }
		
		public static function getAvoidanceZones($params)
	    {
	        $avoidancezones = Route4me::makeRequst(array(
	            'url'    => self::$apiUrl,
	            'method' => 'GET',
	            'query'  => array(
	                'offset'  => isset($params->offset) ? $params->offset: null,
	                'limit'   => isset($params->limit) ? $params->limit: null,
	            )
	        ));
	
	        return $avoidancezones;
	    }

		public static function addAvoidanceZone($params)
	    {
	    	$abcontacts = Route4me::makeRequst(array(
	            'url'    => self::$apiUrl,
	            'method' => 'ADD',
	            'query'  => array(
	            	'territory_name' => 	isset($params->territory_name) ? $params->territory_name: null,
	                'territory_color' => isset($params->territory_color) ? $params->territory_color : null,
	                'territory' => isset($params->territory) ? $params->territory : null,
	            )
	        ));

			return $abcontacts;
		}
		
		public function deleteAvoidanceZone($territory_id)
	    {
	        $result = Route4me::makeRequst(array(
	            'url'    => self::$apiUrl,
	            'method' => 'DELETEARRAY',
	            'query'  => array(
	                'territory_id'     => $territory_id
	            )
	        ));
	
	        return $result;
	    }
		
		public function updateAvoidanceZone($params)
	    {
	        $avoidancezone = Route4me::makeRequst(array(
	            'url'    => self::$apiUrl,
	            'method' => 'PUT',
	            'query'   => (array)$params,

	        ));
	
	        return $avoidancezone;
	    }
	}
	
?>