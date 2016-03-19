<?php
	namespace Route4me;
	
	use Route4me\Common;
	
	class AddressBookContact extends Common
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
		public $color;
		
		//public $offset;
		//public $limit;
		
		public function __construct () {  }
		
		public static function fromArray(array $params) {
			$addressbookcontact = new AddressBookContact();
	        foreach($params as $key => $value) {
	            if (property_exists($addressbookcontact, $key)) {
	                $addressbookcontact->{$key} = $value;
	            }
			}
			
			return $addressbookcontact;
		}
		
		public static function getAddressBookContact($addressId)
	    {
	    	$abcontacts = Route4me::makeRequst(array(
	            'url'    => self::$apiUrl,
	            'method' => 'GET',
	            'query'  => array(
	                'query' => $addressId,
	                'limit' => 30
	            )
	        ));

			return $abcontacts;
		}
		
		public static function getAddressBookContacts($params)
	    {
	    	$abcontacts = Route4me::makeRequst(array(
	            'url'    => self::$apiUrl,
	            'method' => 'GET',
	            'query'  => array(
	                'limit' => isset($params->limit) ? $params->limit: null,
	                'offset' => isset($params->offset) ? $params->offset : null,
	            )
	        ));

			return $abcontacts;
		}
		
		public static function addAdressBookContact($params)
	    {
	    	$abcontacts = Route4me::makeRequst(array(
	            'url'    => self::$apiUrl,
	            'method' => 'ADD',
	            'query'  => array(
	            	'address_1' => 	isset($params->address_1) ? $params->address_1: null,
	                'first_name' => isset($params->first_name) ? $params->first_name : null,
	                'cached_lat' => isset($params->cached_lat) ? $params->cached_lat : null,
	                'cached_lng' => isset($params->cached_lng) ? $params->cached_lng : null,
	            )
	        ));

			return $abcontacts;
		}
		
		public function deleteAdressBookContact($address_ids)
	    {
	        $address = Route4me::makeRequst(array(
	            'url'    => self::$apiUrl,
	            'method' => 'DELETEARRAY',
	            'query'  => array(
	                'address_ids'     => $address_ids
	            )
	        ));
	
	        return $address;
	    }
		
		public function updateAdressBookContact($params)
	    {
	    	//echo "address_id --> ".$params["address_id"]."<br";
	        $address = Route4me::makeRequst(array(
	            'url'    => self::$apiUrl,
	            'method' => 'PUT',
	            'query'   => $params,

	        ));
	
	        return $address;
	    }
			
		public static function get($params)
	    {
	    	$abcontacts = Route4me::makeRequst(array(
	            'url'    => self::$apiUrl,
	            'method' => 'ADD',
	            'query'  => array(
	                'first_name' => isset($params->first_name) ? $params->first_name : null,
	                'address_1' => isset($params->address_1) ? $params->address_1: null,
	                'cached_lat' => isset($params->cached_lat) ? $params->cached_lat : null,
	                'cached_lng' => isset($params->cached_lng) ? $params->cached_lng : null,
	            )
	        ));

			return $abcontacts;
		}
	}
	
?>
		