<?php
	namespace Route4Me;
	
	use Route4Me\Common;
	
	class Order extends Common
	{
		static public $apiUrl = '/api.v4/order.php';
		static public $apiUrlRoute = '/api.v4/route.php';
		static public $apiUrlOpt = '/api.v4/optimization_problem.php';
		
		public $address_1;
		public $cached_lat;
		public $cached_lng;
		public $address_alias;
		public $address_city;
		public $EXT_FIELD_first_name;
		public $EXT_FIELD_last_name;
		public $EXT_FIELD_email;
		public $EXT_FIELD_phone;
		public $EXT_FIELD_custom_data;
		
		public $route_id;
		public $redirect;
		public $optimization_problem_id;
		public $order_id;
		public $order_ids;
		
		public $day_added_YYMMDD;
		public $scheduled_for_YYMMDD;
		public $fields;
		public $offset;
		public $limit;
		public $query;
		
		public function __construct () {  }
		
		public static function fromArray(array $params) {
			$order= new Order();
	        foreach($params as $key => $value) {
	            if (property_exists($order, $key)) {
	                $order->{$key} = $value;
	            }
			}
			
			return $order;
		}
		
		public static function addOrder($params)
	    {
	    	$response = Route4Me::makeRequst(array(
	            'url'    => self::$apiUrl,
	            'method' => 'POST',
	            'body'  => array(
					'address_1' => 	isset($params->address_1) ? $params->address_1: null,
	                'cached_lat' => isset($params->cached_lat) ? $params->cached_lat : null,
	                'cached_lng' => isset($params->cached_lng) ? $params->cached_lng : null,
	                'address_alias' => isset($params->address_alias) ? $params->address_alias : null,
	                'address_city' => 	isset($params->address_1) ? $params->address_city: null,
	                'EXT_FIELD_first_name' => 	isset($params->EXT_FIELD_first_name) ? $params->EXT_FIELD_first_name: null,
	                'EXT_FIELD_last_name' => 	isset($params->EXT_FIELD_last_name) ? $params->EXT_FIELD_last_name: null,
	                'EXT_FIELD_email' => 	isset($params->EXT_FIELD_email) ? $params->EXT_FIELD_email: null,
	                'EXT_FIELD_phone' => 	isset($params->EXT_FIELD_phone) ? $params->EXT_FIELD_phone: null,
	                'EXT_FIELD_custom_data' => 	isset($params->EXT_FIELD_custom_data) ? $params->EXT_FIELD_custom_data: null,
				)
	        ));

			return $response;
		}

		public static function addOrder2Route($params,$body)
	    {
	    	$response = Route4Me::makeRequst(array(
	            'url'    => self::$apiUrlRoute,
	            'method' => 'PUT',
	            'query'  => array(
					'route_id' => 	isset($params->route_id) ? $params->route_id: null,
	                'redirect' => isset($params->redirect) ? $params->redirect : null
				),
				'body'  => (array)$body
			));

			return $response;
		}
		
		public static function addOrder2Destination($params,$body)
	    {
	    	$response = Route4Me::makeRequst(array(
	            'url'    => self::$apiUrlOpt,
	            'method' => 'PUT',
	            'query'  => array(
					'optimization_problem_id' => 	isset($params->optimization_problem_id) ? $params->optimization_problem_id: null,
	                'redirect' => isset($params->redirect) ? $params->redirect : null
				),
				'body'  => (array)$body
			));

			return $response;
		}
		
		public static function getOrder($params)
	    {
	    	$response = Route4Me::makeRequst(array(
	            'url'    => self::$apiUrl,
	            'method' => 'GET',
	            'query'  => array(
					'order_id' => 	isset($params->order_id) ? $params->order_id: null,
				)
	        ));

			return $response;
		}
		
		public static function getOrders()
	    {
	    	$response = Route4Me::makeRequst(array(
	            'url'    => self::$apiUrl,
	            'method' => 'GET'
	        ));

			return $response;
		}
		
		public static function removeOrder($params)
	    {
	    	$response = Route4Me::makeRequst(array(
	            'url'    => self::$apiUrl,
	            'method' => 'DELETE',
	            'body'  => array(
					'order_ids' => 	isset($params->order_ids) ? $params->order_ids: null
				)
	        ));

			return $response;
		}
		
		public static function updateOrder($body)
	    {
	    	$response = Route4Me::makeRequst(array(
	            'url'    => self::$apiUrl,
	            'method' => 'PUT',
	            'body'  => (array)$body
	        ));

			return $response;
		}
		
		public static function searchOrder($params)
	    {
	    	$response = Route4Me::makeRequst(array(
	            'url'    => self::$apiUrl,
	            'method' => 'GET',
	            'query'  => array(
					'day_added_YYMMDD' => 	isset($params->day_added_YYMMDD) ? $params->day_added_YYMMDD: null,
					'scheduled_for_YYMMDD' => 	isset($params->scheduled_for_YYMMDD) ? $params->scheduled_for_YYMMDD: null,
					'fields' => 	isset($params->fields) ? $params->fields: null,
					'offset' => 	isset($params->offset) ? $params->offset: null,
					'limit' => 	isset($params->limit) ? $params->limit: null,
					'query' => 	isset($params->query) ? $params->query: null,
				)
	        ));

			return $response;
		}

	}
	
?>