<?php
	namespace Route4Me;
	
	use Route4Me\Common;
	
	class Member extends Common
	{
		//static public $apiUrl = '/api/member/view_users.php';
		static public $apiUrl = '/api.v4/user.php';
		static public $apiUrlDevice = '/api/device/verify_device_license.php';
		static public $apiUrlLicense = '/api/member/user_license.php';
		static public $apiUrlWebinar = '/actions/webinar_register.php';
		static public $apiUrlSessExp = '/datafeed/session/expire_session.php';
		static public $apiUrlSessValid = '/datafeed/session/validate_session.php';
		static public $apiUrlAuthen = '/actions/authenticate.php';
		static public $apiUrlRegistr = '/actions/register_action.php';
		
		public $device_id;
		public $device_type;
		public $format;
		
		public $strEmail;
		public $strPassword;
		public $strPassword_1;
		public $strPassword_2;
		public $strFirstName;
		public $strLastName;
		public $strIndustry;
		public $chkTerms;
		public $plan;
		
		public $session_guid;
		public $member_id;
		
		public $email_address;
		public $first_name;
		public $last_name;
		public $phone_number;
		public $company_name;
		public $webiinar_date;
		
		public $subscription_name;
		public $token;
		public $payload;
		
		public $HIDE_ROUTED_ADDRESSES;
		public $member_phone;
		public $member_zipcode;
		public $route_count;
		public $member_email;
		public $HIDE_VISITED_ADDRESSES;
		public $READONLY_USER;
		public $member_type;
		public $date_of_birth;
		public $member_first_name;
		public $member_password;
		public $HIDE_NONFUTURE_ROUTES;
		public $member_last_name;
		public $SHOW_ALL_VEHICLES;
		public $SHOW_ALL_DRIVERS;
		
		public function __construct () {  }
		
		public static function fromArray(array $params) {
			$member= new Member();
	        foreach($params as $key => $value) {
	            if (property_exists($member, $key)) {
	                $member->{$key} = $value;
	            }
			}
			
			return $member;
		}
		
		public static function getUsers()
	    {
	    	$response = Route4Me::makeRequst(array(
	            'url'    => self::$apiUrl,
	            'method' => 'GET'
	        ));
			//var_dump($response); die("");
			return $response;
		}
		
		public static function getUser($params)
	    {
	    	$response = Route4Me::makeRequst(array(
	            'url'    => self::$apiUrl,
	            'method' => 'GET',
	            'query'  => array(
	            	'member_id' => isset($params['member_id']) ? $params['member_id'] : null
				)
	        ));
			//var_dump($response); die("");
			return $response;
		}
		
		public static function addDeviceRecord($body)
	    {
	    	$response = Route4Me::makeRequst(array(
	            'url'    => self::$apiUrlDevice,
	            'method' => 'POST',
	            'body'  => array(
					'device_id' => 	isset($body->device_id) ? $body->device_id: null,
	                'device_type' => isset($body->device_type) ? $body->device_type : null,
	                'format' => isset($body->format) ? $body->format : null
				)

			));
			return $response;
		}
		
		public static function createMember($body)
	    {
	    	$response = Route4Me::makeRequst(array(
	            'url'    => self::$apiUrl,
	            'method' => 'POST',
	            'body'  => array(
					'HIDE_ROUTED_ADDRESSES' => 	isset($body->HIDE_ROUTED_ADDRESSES) ? $body->HIDE_ROUTED_ADDRESSES: null,
	                'member_phone' => isset($body->member_phone) ? $body->member_phone : null,
	                'member_zipcode' => isset($body->member_zipcode) ? $body->member_zipcode : null,
	                'route_count' => isset($body->route_count) ? $body->route_count : null,
	                'member_email' => isset($body->member_email) ? $body->member_email : null,
	                'HIDE_VISITED_ADDRESSES' => isset($body->HIDE_VISITED_ADDRESSES) ? $body->HIDE_VISITED_ADDRESSES : null,
	                'READONLY_USER' => isset($body->READONLY_USER) ? $body->READONLY_USER : null,
	                'date_of_birth' => isset($body->date_of_birth) ? $body->date_of_birth : null,
	                'member_first_name' => isset($body->member_first_name) ? $body->member_first_name : null,
	                'member_password' => isset($body->member_password) ? $body->member_password : null,
	                'HIDE_NONFUTURE_ROUTES' => isset($body->HIDE_NONFUTURE_ROUTES) ? $body->HIDE_NONFUTURE_ROUTES : null,
	                'member_last_name' => isset($body->member_last_name) ? $body->member_last_name : null,
	                'SHOW_ALL_VEHICLES' => isset($body->SHOW_ALL_VEHICLES) ? $body->SHOW_ALL_VEHICLES : null,
	                'SHOW_ALL_DRIVERS' => isset($body->SHOW_ALL_DRIVERS) ? $body->SHOW_ALL_DRIVERS : null
				)

			));
			return $response;
		}

		public static function updateMember($body)
	    {
	    	$response = Route4Me::makeRequst(array(
	            'url'    => self::$apiUrl,
	            'method' => 'PUT',
	            'body'  => array(
					'member_id' => 	isset($body->member_id) ? $body->member_id: null,
	                'member_phone' => isset($body->member_phone) ? $body->member_phone : null,
	                'HIDE_ROUTED_ADDRESSES' => 	isset($body->HIDE_ROUTED_ADDRESSES) ? $body->HIDE_ROUTED_ADDRESSES: null,
	                'member_zipcode' => isset($body->member_zipcode) ? $body->member_zipcode : null,
	                'route_count' => isset($body->route_count) ? $body->route_count : null,
	                'member_email' => isset($body->member_email) ? $body->member_email : null,
	                'HIDE_VISITED_ADDRESSES' => isset($body->HIDE_VISITED_ADDRESSES) ? $body->HIDE_VISITED_ADDRESSES : null,
	                'READONLY_USER' => isset($body->READONLY_USER) ? $body->READONLY_USER : null,
	                'date_of_birth' => isset($body->date_of_birth) ? $body->date_of_birth : null,
	                'member_first_name' => isset($body->member_first_name) ? $body->member_first_name : null,
	                'member_password' => isset($body->member_password) ? $body->member_password : null,
	                'HIDE_NONFUTURE_ROUTES' => isset($body->HIDE_NONFUTURE_ROUTES) ? $body->HIDE_NONFUTURE_ROUTES : null,
	                'member_last_name' => isset($body->member_last_name) ? $body->member_last_name : null,
	                'SHOW_ALL_VEHICLES' => isset($body->SHOW_ALL_VEHICLES) ? $body->SHOW_ALL_VEHICLES : null,
	                'SHOW_ALL_DRIVERS' => isset($body->SHOW_ALL_DRIVERS) ? $body->SHOW_ALL_DRIVERS : null
				)

			));
			return $response;
		}

		public static function deleteMember($body)
	    {
	    	$response = Route4Me::makeRequst(array(
	            'url'    => self::$apiUrl,
	            'method' => 'DELETE',
	            'body'  => array(
					'member_id' => 	isset($body->member_id) ? $body->member_id: null
				)

			));
			return $response;
		}
		
		public static function newAccountRegistration($body)
	    {
	    	$response = Route4Me::makeRequst(array(
	            'url'    => self::$apiUrlRegistr,
	            'method' => 'POST',
	            'body'  => array(
					'strEmail' => 	isset($body->strEmail) ? $body->strEmail: null,
	                'strPassword_1' => isset($body->strPassword_1) ? $body->strPassword_1 : null,
	                'strPassword_2' => isset($body->strPassword_2) ? $body->strPassword_2 : null,
	                'strFirstName' => 	isset($body->strFirstName) ? $body->strFirstName: null,
	                'strLastName' => 	isset($body->strLastName) ? $body->strLastName: null,
	                'strIndustry' => 	isset($body->strIndustry) ? $body->strIndustry: null,
	                'chkTerms' => 	isset($body->chkTerms) ? $body->chkTerms: null,
	                'plan' => 	isset($body->plan) ? $body->plan: null
				)
			));
			return $response;
		}
		
		public static function validateSession($params)
	    {
	    	$response = Route4Me::makeRequst(array(
	            'url'    => self::$apiUrlSessValid,
	            'method' => 'GET',
	            'query'  => array(
					'session_guid' => 	isset($params->session_guid) ? $params->session_guid: null,
	                'member_id' => isset($params->member_id) ? $params->member_id : null,
	                'format' => isset($params->format) ? $params->format : null
				)
			));
			return $response;
		}
		
		public static function memberAuthentication($body)
	    {
	    	$response = Route4Me::makeRequst(array(
	            'url'    => self::$apiUrlAuthen,
	            'method' => 'POST',
	            'body'  => array(
					'strEmail' => 	isset($body->strEmail) ? $body->strEmail: null,
	                'strPassword' => isset($body->strPassword) ? $body->strPassword : null,
	                'format' => isset($body->format) ? $body->format : null
				)

			));
			return $response;
		}
		
		public static function webinarRegistration($body)
	    {
	    	$response = Route4Me::makeRequst(array(
	            'url'    => self::$apiUrlWebinar,
	            'method' => 'POST',
	            'body'  => array(
					'email_address' => 	isset($body->email_address) ? $body->email_address: null,
	                'first_name' => isset($body->first_name) ? $body->first_name : null,
	                'last_name' => isset($body->last_name) ? $body->last_name : null,
	                'phone_number' => isset($body->phone_number) ? $body->phone_number : null,
	                'phone_number' => isset($body->phone_number) ? $body->phone_number : null,
	                'member_id' => isset($body->member_id) ? $body->member_id : null,
	                'webiinar_date' => isset($body->webiinar_date) ? $body->webiinar_date : null,
				)

			));
			return $response;
		}
		
		public static function purchaseUserLicense($body)
	    {
	    	$response = Route4Me::makeRequst(array(
	            'url'    => self::$apiUrlLicense,
	            'method' => 'POST',
	            'body'  => array(
					'member_id' => 	isset($body->member_id) ? $body->member_id: null,
	                'session_guid' => isset($body->session_guid) ? $body->session_guid : null,
	                'device_id' => isset($body->device_id) ? $body->device_id : null,
	                'device_type' => isset($body->device_type) ? $body->device_type : null,
	                'subscription_name' => isset($body->subscription_name) ? $body->subscription_name : null,
	                'token' => isset($body->token) ? $body->token : null,
	                'payload' => isset($body->payload) ? $body->payload : null,
	                'format' => isset($body->format) ? $body->format : null,
				)

			));
			return $response;
		}
	}
?>