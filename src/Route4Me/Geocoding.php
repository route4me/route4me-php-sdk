<?php
	namespace Route4Me;
	
	use Route4Me\Common;
	
	class Geocoding extends Common
	{
		static public $apiUrl = '/api/geocoder.php';
		static public $api_bulk = '/actions/upload/json-geocode.php';
		static public $api_street = 'https://rapid.route4me.com/street_data/';
		static public $api_zipcode = 'https://rapid.route4me.com/street_data/zipcode/';
		static public $api_service = 'https://rapid.route4me.com/street_data/service/';
		
		public $format;
		public $addresses;
		public $pk;
		public $offset;
		public $limit;
		public $housenumber;
		public $zipcode;
		
		public function __construct () {  }
		
		public static function fromArray(array $params) {
			$geocoding = new Geocoding();
	        foreach($params as $key => $value) {
	            if (property_exists($geocoding, $key)) {
	                $geocoding->{$key} = $value;
	            }
			}
			return $geocoding;
		}
		
		public static function forwardGeocoding($params)
		{
			//Route4Me::simplePrint($params);
			$query = array(
	                'format' => isset($params['format']) ? $params['format']: null,
	                'addresses' => isset($params['addresses']) ? $params['addresses'] : null,
	            );
			//var_dump($query);
			$fgcoding = Route4Me::makeRequst(array(
	            'url'    => self::$apiUrl,
	            'method' => 'POST',
	            'query'  => $query
	        ));
			
			return $fgcoding;
		}
		
		public static function getStreetData($params)
		{
			$url_query = self::$api_street;
			if (isset($params['pk'])) {
				$url_query.=$params['pk'].'/';
			}
			if (isset($params['offset'])) {
				$url_query.=$params['offset'].'/';
			}
			if (isset($params['limit'])) {
				$url_query.=$params['limit'].'/';
			}

			$query = array();
			
			$response = Route4Me::makeUrlRequst($url_query, array(
	            'method' => 'GET',
	            'query'  => $query
	        ));
			
			return $response;
		}
		
		public static function getZipCode($params)
		{
			$url_query = self::$api_zipcode;
			if (isset($params['zipcode'])) {
				$url_query.=$params['zipcode'].'/';
			}
			if (isset($params['offset'])) {
				$url_query.=$params['offset'].'/';
			}
			if (isset($params['limit'])) {
				$url_query.=$params['limit'].'/';
			}

			$query = array();
			
			$response = Route4Me::makeUrlRequst($url_query, array(
	            'method' => 'GET',
	            'query'  => $query
	        ));
			
			return $response;
		}
		
		public static function getService($params)
		{
			$url_query = self::$api_service;
			if (isset($params['zipcode'])) {
				$url_query.=$params['zipcode'].'/';
			}
			if (isset($params['housenumber'])) {
				$url_query.=$params['housenumber'].'/';
			}
			if (isset($params['offset'])) {
				$url_query.=$params['offset'].'/';
			}
			if (isset($params['limit'])) {
				$url_query.=$params['limit'].'/';
			}

			$query = array();
			
			$response = Route4Me::makeUrlRequst($url_query, array(
	            'method' => 'GET',
	            'query'  => $query
	        ));
			
			return $response;
		}
	}
		