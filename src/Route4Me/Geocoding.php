<?php
namespace Route4Me;

use Route4Me\Common;
use Route4Me\Enum\Endpoint;

class Geocoding extends Common
{
    public $strExportFormat;
    public $format;
    public $addresses;
    public $pk;
    public $offset;
    public $limit;
    public $housenumber;
    public $zipcode;
    
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
        $allBodyFields = array('strExportFormat', 'addresses');

        $fgCoding = Route4Me::makeRequst(array(
            'url'    => Endpoint::GEOCODER,
            'method' => 'POST',
            'body'   => Route4Me::generateRequestParameters($allBodyFields, $params),
            'HTTPHEADER'  => 'Content-Type: multipart/form-data'
        ));
        
        return $fgCoding;
    }
    
    public static function reverseGeocoding($params)
    {
        $allQueryFields = array('format', 'addresses', 'detailed');

        $fgcoding = Route4Me::makeRequst(array(
            'url'    => Endpoint::GEOCODER,
            'method' => 'POST',
            'query'  => Route4Me::generateRequestParameters($allQueryFields, $params)
        ));
        
        return $fgcoding;
    }
    
    public static function getStreetData($params)
    {
        Route4Me::setBaseUrl(Endpoint::STREET_DATA);

        $allPathFields = array('pk', 'offset', 'limit');

        $url_query = Route4Me::generateUrlPath($allPathFields, $params);

        $query = array();

        $response = Route4Me::makeRequst(array(
            'url'    => $url_query,
            'method' => 'GET',
            'query'  => $query
        ));

        return $response;
    }
    
    public static function getZipCode($params)
    {
        Route4Me::setBaseUrl(Endpoint::STREET_DATA_ZIPCODE);

        $allPathFields = array('zipcode', 'offset', 'limit');

        $url_query = Route4Me::generateUrlPath($allPathFields, $params);

        $query = array();

        $response = Route4Me::makeRequst(array(
            'url'    => $url_query,
            'method' => 'GET',
            'query'  => $query
        ));

        return $response;
    }
    
    public static function getService($params)
    {
        Route4Me::setBaseUrl(Endpoint::STREET_DATA_SERVICE);
        
        $allPathFields = array('zipcode', 'housenumber', 'offset', 'limit');

        $url_query = Route4Me::generateUrlPath($allPathFields, $params);
        
        $query = array();
        
        $response = Route4Me::makeRequst(array(
            'url'    => $url_query,
            'method' => 'GET',
            'query'  => $query
        ));
        
        return $response;
    }
}
