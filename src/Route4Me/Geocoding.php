<?php
	namespace Route4Me;
	
	use Route4Me\Common;
	
	class Geocoding extends Common
	{
		static public $apiUrl = '/api/geocoder.php';
		static public $api_bulk = '/actions/upload/json-geocode.php';
		
		public $format;
		public $addresses;
		
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
	}
		