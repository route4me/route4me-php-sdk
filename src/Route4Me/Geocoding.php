<?php
namespace Route4Me;

use Route4Me\Common;
use Route4Me\Enum\Endpoint;

class Geocoding extends Common
{
    public $format;
    public $addresses;
    public $pk;
    public $offset;
    public $limit;
    public $housenumber;
    public $zipcode;
    
    public function __construct () 
    {  }
    
    public static function fromArray(array $params) 
    {
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
        $query = array(
                'format'    => isset($params['format']) ? $params['format']: null,
                'addresses' => isset($params['addresses']) ? $params['addresses'] : null,
            );

        $fgCoding = Route4Me::makeRequst(array(
            'url'    => Endpoint::GEOCODER,
            'method' => 'POST',
            'query'  => $query
        ));
        
        return $fgCoding;
    }
    
    public static function getStreetData($params)
    {
        $url_query = Endpoint::STREET_DATA;
        
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
        $url_query = Endpoint::STREET_DATA_ZIPCODE;
        
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
        $url_query = Endpoint::STREET_DATA_SERVICE;
        
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
