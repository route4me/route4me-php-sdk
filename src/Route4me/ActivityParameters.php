<?php
	namespace Route4me;
	
	use Route4me\Common;
	
	class ActivityParameters extends Common
	{
		static public $apiUrl = '/api/get_activities.php';
		
		public $route_id;
		public $device_id;
		public $member_id;
		public $limit;
		public $offset;
		public $start;
		public $end;
		
		public function __construct () {
			
		}
		
		public static function fromArray(array $params) {
			$activityparameters = new ActivityParameters();
	        foreach($params as $key => $value) {
	            if (property_exists($activityparameters, $key)) {
	                $activityparameters->{$key} = $value;
	            }
			}
			
			return $activityparameters;
		}
		
		public static function get($params)
	    {
	    	$activity = Route4me::makeRequst(array(
	            'url'    => self::$apiUrl,
	            'method' => 'GET',
	            'query'  => array(
	                'route_id' => isset($params->route_id) ? $params->route_id : null,
	                'limit' => isset($params->limit) ? $params->limit: null,
	                'offset' => isset($params->offset) ? $params->offset : null,
	            )
	        ));

			return $activity;
		}
		
	}
?>