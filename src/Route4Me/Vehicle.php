<?php
	namespace Route4Me;
	
	use Route4Me\Common;
	
	class Vehicle extends Common
	{
		static public $apiUrl = '/api/vehicles/view_vehicles.php';
		
		public function __construct () {  }
		
		public static function fromArray(array $params) {
			$vehicle= new Vehicle();
	        foreach($params as $key => $value) {
	            if (property_exists($vehicle, $key)) {
	                $vehicle->{$key} = $value;
	            }
			}
			
			return $order;
		}
		
		public static function getVehicles()
	    {
	    	$response = Route4Me::makeRequst(array(
	            'url'    => self::$apiUrl,
	            'method' => 'GET'
	        ));

			return $response;
		}
	}
?>