<?php
	namespace Route4Me;
	
	use Route4Me\Common;
	
	class AddressBookLocation extends Common
	{
		static public $apiUrl = '/api.v4/address_book.php';
		static public $apiUrl00 = '/api/address_book/modify_contact.php';
		
		public $address_id;
		public $address_group;
		public $address_alias;
		public $address_1;
		public $address_2;
		public $first_name;
		public $last_name;
		public $address_email;
		public $address_phone_number;
		public $address_city;
		public $address_state_id;
		public $address_country_id;
		public $address_zip;
		public $cached_lat;
		public $cached_lng;
        public $curbside_lat;
        public $curbside_lng;
		public $color;
        public $address_custom_data;
        public $schedule;
		
		//public $offset;
		//public $limit;
		
		public function __construct () {  }
		
		public static function fromArray(array $params) {
			$addressbooklocation = new AddressBookLocation();
	        foreach($params as $key => $value) {
	            if (property_exists($addressbooklocation, $key)) {
	                $addressbooklocation->{$key} = $value;
	            }
			}
			
			return $addressbooklocation;
		}
		
		public static function getAddressBookLocation($addressId)
	    {
	    	$ablocations = Route4Me::makeRequst(array(
	            'url'    => self::$apiUrl,
	            'method' => 'GET',
	            'query'  => array(
	                'query' => $addressId,
	                'limit' => 30
	            )
	        ));

			return $ablocations;
		}
		
		public static function searchRoutedLocation($params)
	    {
	    	$result= Route4Me::makeRequst(array(
	            'url'    => self::$apiUrl,
	            'method' => 'GET',
	            'query'  => array(
	                'display' => isset($params['display']) ? $params['display']: null,
	                'query' => isset($params['query']) ? $params['query']: null,
	                'fields' => isset($params['fields']) ? $params['fields']: null,
	                'limit' => isset($params['limit']) ? $params['limit']: null,
	                'offset' => isset($params['offset']) ? $params['offset'] : null,
	            )
	        ));

			return $result;
		}
		
		public static function getAddressBookLocations($params)
	    {
	    	$ablocations = Route4Me::makeRequst(array(
	            'url'    => self::$apiUrl,
	            'method' => 'GET',
	            'query'  => array(
	                'limit' => isset($params->limit) ? $params->limit: null,
	                'offset' => isset($params->offset) ? $params->offset : null,
	            )
	        ));

			return $ablocations;
		}
		
		public static function getAddressBookLocationsByIds($ids)
	    {
	    	$ablocations = Route4Me::makeRequst(array(
	            'url'    => self::$apiUrl,
	            'method' => 'GET',
	            'query'  => array(
	                'address_id' => $ids
	            )
	        ));

			return $ablocations;
		}
		
		public static function addAdressBookLocation($params)
	    {
	    	$ablocations = Route4Me::makeRequst(array(
	            'url'    => self::$apiUrl,
	            'method' => 'POST',
	            'body'  => array(
	            	'address_1' => 	isset($params->address_1) ? $params->address_1: null,
	            	'address_2' =>    isset($params->address_2) ? $params->address_2: null,
	            	'address_alias' =>    isset($params->address_alias) ? $params->address_alias: null,
	                'first_name' => isset($params->first_name) ? $params->first_name : null,
	                'cached_lat' => isset($params->cached_lat) ? $params->cached_lat : null,
	                'cached_lng' => isset($params->cached_lng) ? $params->cached_lng : null,
	                'curbside_lat' => isset($params->curbside_lat) ? $params->curbside_lat : null,
                    'curbside_lng' => isset($params->curbside_lng) ? $params->curbside_lng : null,
	                'address_phone_number' =>    isset($params->address_phone_number) ? $params->address_phone_number: null,
	                'address_group' =>    isset($params->address_group) ? $params->address_group: null,
	                'first_name' =>    isset($params->first_name) ? $params->first_name: null,
	                'last_name' =>    isset($params->last_name) ? $params->last_name: null,
                    'local_time_window_start' =>    isset($params->local_time_window_start) ? $params->local_time_window_start: null,
                    'local_time_window_end' =>    isset($params->local_time_window_end) ? $params->local_time_window_end: null,
                    'local_time_window_start_2' =>    isset($params->local_time_window_start_2) ? $params->local_time_window_start_2: null,
                    'local_time_window_end_2' =>    isset($params->local_time_window_end_2) ? $params->local_time_window_end_2: null,
	                'address_email' =>    isset($params->address_email) ? $params->address_email: null,
	                'address_city' =>    isset($params->address_city) ? $params->address_city: null,
	                'address_state_id' =>    isset($params->address_state_id) ? $params->address_state_id: null,
	                'address_country_id' =>    isset($params->address_country_id) ? $params->address_country_id: null,
	                'address_zip' =>    isset($params->address_zip) ? $params->address_zip: null,
	                'address_custom_data' =>    isset($params->address_custom_data) ? $params->address_custom_data: null,
	                'schedule' =>    isset($params->schedule) ? $params->schedule: null,
	                'schedule_blacklist' =>    isset($params->schedule_blacklist) ? $params->schedule_blacklist: null,
	                'service_time' =>    isset($params->service_time) ? $params->service_time: null,
	                'local_timezone_string' =>    isset($params->local_timezone_string) ? $params->local_timezone_string: null,
	                'color' =>    isset($params->color) ? $params->color: null,
	                'address_icon' =>    isset($params->address_icon) ? $params->address_icon: null,
	                'address_stop_type' =>    isset($params->address_stop_type) ? $params->address_stop_type: null,
	                'address_cube' =>    isset($params->address_cube) ? $params->address_cube: null,
	                'address_pieces' =>    isset($params->address_pieces) ? $params->address_pieces: null,
	                'address_reference_no' =>    isset($params->address_reference_no) ? $params->address_reference_no: null,
	                'address_revenue' =>    isset($params->address_revenue) ? $params->address_revenue: null,
	                'address_weight' =>    isset($params->address_weight) ? $params->address_weight: null,
	                'address_priority' =>    isset($params->address_priority) ? $params->address_priority: null,
	                'address_customer_po' =>    isset($params->address_customer_po) ? $params->address_customer_po: null,
	            )
	        ));

			return $ablocations;
		}
		
		public function deleteAdressBookLocation($address_ids)
	    {
	        $address = Route4Me::makeRequst(array(
	            'url'    => self::$apiUrl,
	            'method' => 'DELETEARRAY',
	            'query'  => array(
	                'address_ids'     => $address_ids
	            )
	        ));
	
	        return $address;
	    }
		
		public function updateAdressBookLocation($params)
	    {
	    	//echo "address_id --> ".$params["address_id"]."<br";
	        $address = Route4Me::makeRequst(array(
	            'url'    => self::$apiUrl,
	            'method' => 'PUT',
	            'query'   => $params,

	        ));
	
	        return $address;
	    }
			
		public static function get($params)
	    {
	    	$ablocations = Route4Me::makeRequst(array(
	            'url'    => self::$apiUrl,
	            'method' => 'ADD',
	            'query'  => array(
	                'first_name' => isset($params->first_name) ? $params->first_name : null,
	                'address_1' => isset($params->address_1) ? $params->address_1: null,
	                'cached_lat' => isset($params->cached_lat) ? $params->cached_lat : null,
	                'cached_lng' => isset($params->cached_lng) ? $params->cached_lng : null,
	            )
	        ));

			return $ablocations;
		}
        
        public static function validateScheduleMode($scheduleMode)
        {
            $schedMmodes=array("daily","weekly","monthly","annually");
            
            if (in_array($scheduleMode, $schedMmodes)) return TRUE; else return FALSE;
        }
        
        public static function validateScheduleEnable($scheduleEnabled)
        {
            $schedEnambles=array(TRUE,FALSE);
            
            if (in_array($scheduleEnabled, $schedEnambles)) return TRUE; else return FALSE;
        }
        
        public static function validateScheduleEvery($scheduleEvery)
        {
            if (is_numeric($scheduleEvery)) return TRUE; else return FALSE;
        }
        
        public static function validateScheduleWeekDays($scheduleWeekDays)
        {
            $weekdays = explode(',', $scheduleWeekDays);
            
            if (sizeof($weekdays)<1) return FALSE;
            
            $isValid=TRUE;
            
            for ($i=0; $i < sizeof($weekdays); $i++) { 
                if (is_numeric($weekdays[$i])) {
                    $wday=intval($weekdays[$i]);
                    if ($wday<1 || $wday>7) $isValid=FALSE;
                }
                else $isValid=FALSE;
            }
            //echo $scheduleWeekDays.' --- '. $isValid."<br>";
            return $isValid;
        }
        
        public static function validateScheduleMonthlyMode($scheduleMonthlyMode)
        {
            $schedMonthlyMmodes=array("dates","nth");
            
            if (in_array($scheduleMonthlyMode, $schedMonthlyMmodes)) return TRUE; else return FALSE;
        }
        
        public static function validateScheduleMonthlyDates($scheduleMonthlyDates)
        {
            $monthlyDates = explode(',', $scheduleMonthlyDates);
            
            if (sizeof($monthlyDates)<1) return FALSE;
            
            $isValid=TRUE;
            
            for ($i=0; $i < sizeof($monthlyDates); $i++) { 
                if (is_numeric($monthlyDates[$i])) {
                    $mday=intval($monthlyDates[$i]);
                    if ($mday<1 || $mday>31) $isValid=FALSE;
                }
                else $isValid=FALSE;
            }
            //echo $scheduleMonthlyDates.' --- '. $isValid."<br>";
            return $isValid;
        }
        
        public static function validateScheduleNthN($scheduleNthN)
        {
            if (!is_numeric($scheduleNthN)) return FALSE;
            
            $schedNthNs=array(1,2,3,4,5,-1);
            if (in_array($scheduleNthN, $schedNthNs)) return TRUE; else return FALSE;
        }
        
        public static function validateScheduleNthWhat($scheduleNthWhat)
        {
            if (!is_numeric($scheduleNthWhat)) return FALSE;
            
            $schedNthWhats=array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
            if (in_array($scheduleNthWhat, $schedNthWhats)) return TRUE; else return FALSE;
        }
	}
	
?>
		