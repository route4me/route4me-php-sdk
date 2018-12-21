<?php
namespace Route4Me;

use Route4Me\Common;
use Route4Me\Enum\Endpoint;

class Member extends Common
{
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
    public $webinar_date;
    
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
    
    public $config_key;
    public $config_value;
    
    public $preferred_units;
    public $preferred_language;
    public $timezone;
    public $OWNER_MEMBER_ID;
    public $user_reg_state_id;
    public $user_reg_country_id;
    public $member_picture;
    public $api_key;
    public $custom_data;
    
    public static function fromArray(array $params) 
    {
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
            'url'    => Endpoint::USER_V4,
            'method' => 'GET'
        ));

        return $response;
    }
    
    public static function getUser($params)
    {
        $response = Route4Me::makeRequst(array(
            'url'    => Endpoint::USER_V4,
            'method' => 'GET',
            'query'  => array(
                'member_id' => isset($params['member_id']) ? $params['member_id'] : null
            )
        ));

        return $response;
    }
    
    public static function getUserLocations($param)
    {
        $response = Route4Me::makeRequst(array(
            'url'    => Endpoint::VIEW_USER_LOCATIONS,
            'method' => 'GET',
            'query'  => array(
                'query' => $param
            )
        ));

        return $response;
    }
    
    public static function addDeviceRecord($params)
    {
        $allQueryFields = array('device_id', 'device_type');
        $allBodyFields = array('device_id', 'device_type', 'format');
        
        $response = Route4Me::makeRequst(array(
            'url'    => Endpoint::VERIFY_DEVICE_LICENSE,
            'method' => 'POST',
            'query'  => Route4Me::generateRequestParameters($allQueryFields, $params),
            'body'   => Route4Me::generateRequestParameters($allBodyFields, $params)
        ));
        
        return $response;
    }
    
    public static function createMember($params)
    {
        $excludeFields = array('session_guid', 'member_id', 'token', 'payload', 'webinar_date', 
        'company_name', 'config_key', 'config_value', 'api_key');
        
        $allBodyFields = Route4Me::getObjectProperties(new Member(), $excludeFields);

        $response = Route4Me::makeRequst(array(
            'url'    => Endpoint::USER_V4,
            'method' => 'POST',
            'body'   => Route4Me::generateRequestParameters($allBodyFields, $params)
        ));
        
        return $response;
    }

    public static function getRandomMemberByType($memberType)
    {
        $members = self::getUsers();
        
        if (is_null($members)) return null;
        if (!isset($members['results'])) return null;
        
        $memberIDs = array();
        
        foreach ($members['results'] as $memb) {
            if (isset($memb['member_id']) && isset($memb['member_type'])) {
                if ($memberType==$memb['member_type']) $memberIDs[]=$memb['member_id'];
            }
        }
        
        if (sizeof($memberIDs)<1) return null;
        
        $randomIndex = rand(0, sizeof($memberIDs)-1);
        
        return $memberIDs[$randomIndex];
    }


    public static function updateMember($body)
    {
        $excludeFields = array('session_guid', 'token', 'payload', 'webinar_date', 
        'company_name', 'config_key', 'config_value', 'api_key');
        
        $allBodyFields = Route4Me::getObjectProperties(new Member(), $excludeFields);
        
        $response = Route4Me::makeRequst(array(
            'url'    => Endpoint::USER_V4,
            'method' => 'PUT',
            'body'   => Route4Me::generateRequestParameters($allBodyFields, $body)
        ));
        
        return $response;
    }

    public static function deleteMember($body)
    {
        $response = Route4Me::makeRequst(array(
            'url'    => Endpoint::USER_V4,
            'method' => 'DELETE',
            'body'   => array(
                'member_id' =>  isset($body->member_id) ? $body->member_id : null
            )

        ));
        
        return $response;
    }
    
    public static function newAccountRegistration($params)
    {
        $allQueryFields = array('plan');
        $allBodyFields = array('strEmail', 'strPassword_1', 'strPassword_2', 'strFirstName', 
        'strLastName', 'format', 'strIndustry', 'chkTerms', 
        'device_type', 'strSubAccountType', 'blDisableMarketing', 'blDisableAccountActivationEmail');
        
        $response = Route4Me::makeRequst(array(
            'url'    => Endpoint::REGISTER_ACTION,
            'method' => 'POST',
            'query'  => Route4Me::generateRequestParameters($allQueryFields, $params),
            'body'   => Route4Me::generateRequestParameters($allBodyFields, $params),
            'HTTPHEADER'  => 'Content-Type: multipart/form-data'
        ));
        
        return $response;
    }
    
    public static function validateSession($params)
    {
        $allQueryFields = array('session_guid', 'member_id', 'format');
        
        $response = Route4Me::makeRequst(array(
            'url'    => Endpoint::VALIDATE_SESSION,
            'method' => 'GET',
            'query'  => Route4Me::generateRequestParameters($allQueryFields, $params)
        ));
        
        return $response;
    }
    
    public static function memberAuthentication($params)
    {
        $allBodyFields = array('strEmail', 'strPassword', 'format');
        
        $response = Route4Me::makeRequst(array(
            'url'    => Endpoint::AUTHENTICATE,
            'method' => 'POST',
            'body'   => Route4Me::generateRequestParameters($allBodyFields, $params),
            'HTTPHEADER'  => 'Content-Type: multipart/form-data'
        ));
        
        return $response;
    }
    
    public static function webinarRegistration($params)
    {
        $allBodyFields = array('email_address', 'first_name', 'last_name', 'phone_number', 
        'company_name', 'member_id', 'webinar_date');
        
        $response = Route4Me::makeRequst(array(
            'url'    => Endpoint::WEBINAR_REGISTER,
            'method' => 'POST',
            'body'   => Route4Me::generateRequestParameters($allBodyFields, $params)
        ));
        
        return $response;
    }
    
    public static function purchaseUserLicense($params)
    {
        $allQueryFields = array('device_id');
        $allBodyFields = array('member_id', 'session_guid', 'device_id', 'device_type', 
        'subscription_name', 'token', 'payload', 'format');
        
        $response = Route4Me::makeRequst(array(
            'url'    => Endpoint::USER_LICENSE,
            'method' => 'POST',
            'query'  => Route4Me::generateRequestParameters($allQueryFields, $params),
            'body'   => Route4Me::generateRequestParameters($allBodyFields, $params)
        ));
        
        return $response;
    }
    
    public static function newMemberConfigKey($params)
    {
        $allBodyFields = array('config_key', 'config_value');
        
        $response = Route4Me::makeRequst(array(
            'url'    => Endpoint::CONFIGURATION_SETTINGS,
            'method' => 'POST',
            'body'   => Route4Me::generateRequestParameters($allBodyFields, $params)
        ));
        
        return $response;
    }
    
    public static function removeMemberConfigKey($params)
    {
        $allBodyFields = array('config_key');
        
        $response = Route4Me::makeRequst(array(
            'url'    => Endpoint::CONFIGURATION_SETTINGS,
            'method' => 'DELETE',
            'body'   => Route4Me::generateRequestParameters($allBodyFields, $params)
        ));
        
        return $response;
    }
    
    public static function getMemberConfigData($params)
    {
        $allQueryFields = array('config_key');
        
        $response = Route4Me::makeRequst(array(
            'url'    => Endpoint::CONFIGURATION_SETTINGS,
            'method' => 'GET',
            'query'  => Route4Me::generateRequestParameters($allQueryFields, $params)
        ));
        
        return $response;
    }

    public static function updateMemberConfigKey($params)
    {
        $allBodyFields = array('config_key', 'config_value');
        
        $response = Route4Me::makeRequst(array(
            'url'    => Endpoint::CONFIGURATION_SETTINGS,
            'method' => 'PUT',
            'body'   => Route4Me::generateRequestParameters($allBodyFields, $params)
        ));
        
        return $response;
    }
}
