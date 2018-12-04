<?php
namespace Route4Me;

use Route4Me\Common;
use Route4Me\Enum\Endpoint;

class Vehicle extends Common
{
    static public $apiUrl = '/api/vehicles';
    
    public function __construct () 
    {
        Route4Me::setBaseUrl(Endpoint::WH_BASE_URL);
    }
    
    public static function fromArray(array $params) {
        $vehicle= new Vehicle();
        foreach($params as $key => $value) {
            if (property_exists($vehicle, $key)) {
                $vehicle->{$key} = $value;
            }
        }
        
        return $order;
    }
    
    public static function getVehicles($params)
    {
        $response = Route4Me::makeRequst(array(
            'url'    => self::$apiUrl,
            'method' => 'GET',
            'query'  => array(
                'with_pagination'  => isset($params['with_pagination']) ? $params['with_pagination'] : null,
                'page'             => isset($params['page']) ? $params['page'] : null,
                'perPage'          => isset($params['perPage']) ? $params['perPage'] : null,
            )
        ));

        return $response;
    }
}
