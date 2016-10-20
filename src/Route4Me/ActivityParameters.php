<?php
	namespace Route4Me;
	
	use Route4Me\Common;
	
	class ActivityParameters extends Common
	{
		static public $apiUrl = '/api/get_activities.php';
		static public $apiUrlv4 = '/api.v4/activity_feed.php';
		
		public $route_id;
		public $device_id;
		public $member_id;
		public $team;
		public $limit;
		public $offset;
		public $start;
		public $end;
		public $activity_type;
		public $activity_message;
		
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
	    	$activity = Route4Me::makeRequst(array(
	            'url'    => self::$apiUrl,
	            'method' => 'GET',
	            'query'  => array(
	                'route_id' => isset($params->route_id) ? $params->route_id : null,
	                'team' => isset($params->team) ? $params->team: null,
	                'limit' => isset($params->limit) ? $params->limit: null,
	                'offset' => isset($params->offset) ? $params->offset : null,
	            )
	        ));

			return $activity;
		}

		public static function searcActivities($params)
	    {
	    	$activity = Route4Me::makeRequst(array(
	            'url'    => self::$apiUrl,
	            'method' => 'GET',
	            'query'  => array(
	                'route_id' => isset($params->route_id) ? $params->route_id : null,
	                'limit' => isset($params->limit) ? $params->limit: null,
	                'offset' => isset($params->offset) ? $params->offset : null,
	                'activity_type' => isset($params->activity_type) ? $params->activity_type : null,
	            )
	        ));

			return $activity;
		}
		
		public static function sendUserMessage($postParameters)
		{
			$result = Route4Me::makeRequst(array(
	            'url'    => self::$apiUrlv4,
	            'method' => 'POST',
	            'body'  => array(
	            	'activity_type' => isset($postParameters->activity_type) ? $postParameters->activity_type : null,
	            	'activity_message' => isset($postParameters->activity_message) ? $postParameters->activity_message: null,
	                'route_id' => isset($postParameters->route_id) ? $postParameters->route_id : null,
	            )
	        ));
			
			return $result;
		}
		
	}
?>