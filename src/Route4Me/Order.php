<?php
namespace Route4Me;

use Route4Me\Common;
use Route4Me\Enum\Endpoint;

class Order extends Common
{
    public $address_1;
    public $address_2;
    public $cached_lat;
    public $cached_lng;
    public $curbside_lat;
    public $curbside_lng;
    public $address_alias;
    public $address_city;
    public $EXT_FIELD_first_name;
    public $EXT_FIELD_last_name;
    public $EXT_FIELD_email;
    public $EXT_FIELD_phone;
    public $EXT_FIELD_custom_data;
    
    public $color;
    public $order_icon;
    public $local_time_window_start;
    public $local_time_window_end;
    public $local_time_window_start_2;
    public $local_time_window_end_2;
    public $service_time;
    
    public $day_scheduled_for_YYMMDD;
    
    public $route_id;
    public $redirect;
    public $optimization_problem_id;
    public $order_id;
    public $order_ids;
    
    public $day_added_YYMMDD;
    public $scheduled_for_YYMMDD;
    public $fields;
    public $offset;
    public $limit;
    public $query;
    
    public $created_timestamp;
    public $order_status_id;
    public $member_id;
    public $address_state_id;
    public $address_country_id;
    public $address_zip;
    public $in_route_count;
    public $last_visited_timestamp;
    public $last_routed_timestamp;
    public $local_timezone_string;
    public $is_validated;
    public $is_pending;
    public $is_accepted;
    public $is_started;
    public $is_completed;
    public $custom_user_fields;
    
    public $addresses = array();
    
    public static function fromArray(array $params) {
        $order = new Order();
        foreach ($params as $key => $value) {
            if (property_exists($order, $key)) {
                $order->{$key} = $value;
            }
        }
        
        return $order;
    }
    
    /**
     * @param Order $params
     */
    public static function addOrder($params)
    {
        $excludeFields = array('route_id', 'redirect', 'optimization_problem_id', 'order_id', 
        'order_ids', 'fields', 'offset', 'limit', 'query', 'created_timestamp');
        
        $allBodyFields = Route4Me::getObjectProperties(new Order(), $excludeFields);
        
        $response = Route4Me::makeRequst(array(
            'url'    => Endpoint::ORDER_V4,
            'method' => 'POST',
            'body'   => Route4Me::generateRequestParameters($allBodyFields, $params)
        ));

        return $response;
    }

    public static function addOrder2Route($params)
    {
        $allQueryFields = array('route_id', 'redirect');
        $allBodyFields = array('addresses');
        
        $response = Route4Me::makeRequst(array(
            'url'    => Endpoint::ROUTE_V4,
            'method' => 'PUT',
            'query'  => Route4Me::generateRequestParameters($allQueryFields, $params),
            'body'   => Route4Me::generateRequestParameters($allBodyFields, $params)
        ));

        return $response;
    }
    
    public static function addOrder2Optimization($params)
    {
        $allQueryFields = array('optimization_problem_id', 'redirect', 'device_type');
        $allBodyFields = array('addresses');
        
        $response = Route4Me::makeRequst(array(
            'url'    => Endpoint::OPTIMIZATION_PROBLEM,
            'method' => 'PUT',
            'query'  => Route4Me::generateRequestParameters($allQueryFields, $params),
            'body'   => Route4Me::generateRequestParameters($allBodyFields, $params)
        ));

        return $response;
    }
    
    public static function getOrder($params)
    {
        $allQueryFields = array('order_id', 'fields', 'day_added_YYMMDD', 'scheduled_for_YYMMDD', 'query', 'offset', 'limit');

        $response = Route4Me::makeRequst(array(
            'url'    => Endpoint::ORDER_V4,
            'method' => 'GET',
            'query'  => Route4Me::generateRequestParameters($allQueryFields, $params)
        ));

        return $response;
    }
    
    public static function getOrders($params)
    {
        $allQueryFields = array('offset', 'limit');
        
        $response = Route4Me::makeRequst(array(
            'url'    => Endpoint::ORDER_V4,
            'method' => 'GET',
            'query'  => Route4Me::generateRequestParameters($allQueryFields, $params)
        ));

        return $response;
    }
    
    public function getRandomOrderId($offset, $limit)
    {
        $randomOrder = $this->getRandomOrder($offset, $limit);
        
        if (is_null($randomOrder)) {
            return null;
        }
        
        if (!isset($randomOrder)) {
            return null;
        }
        
        return $randomOrder['order_id'];
    }
    
    public function getRandomOrder($offset, $limit)
    {
        $params = array('offset' => $offset, 'limit' => $limit);
        
        $orders = self::getOrders($params);
        
        if (is_null($orders)) {
            return null;
        }
        
        if (!isset($orders['results'])) {
            return null;
        }
        
        $randomIndex = rand(0, sizeof($orders['results']) - 1);
        
        $order = $orders['results'][$randomIndex];
        
        return $order;
    }
    
    public static function removeOrder($params)
    {
        $allBodyFields = array('order_ids');
        
        $response = Route4Me::makeRequst(array(
            'url'    => Endpoint::ORDER_V4,
            'method' => 'DELETE',
            'body'   => Route4Me::generateRequestParameters($allBodyFields, $params)
        ));

        return $response;
    }
    
    public static function updateOrder($params)
    {
        $excludeFields = array('route_id', 'redirect', 'optimization_problem_id', 
        'order_ids', 'fields', 'offset', 'limit', 'query', 'created_timestamp');
        
        $allBodyFields = Route4Me::getObjectProperties(new Order(), $excludeFields);
        
        $response = Route4Me::makeRequst(array(
            'url'    => Endpoint::ORDER_V4,
            'method' => 'PUT',
            'body'   => Route4Me::generateRequestParameters($allBodyFields, $params)
        ));

        return $response;
    }
    
    public static function searchOrder($params)
    {
        $allQueryFields = array('fields', 'day_added_YYMMDD', 'scheduled_for_YYMMDD', 'query', 'offset', 'limit' );
        
        $response = Route4Me::makeRequst(array(
            'url'    => Endpoint::ORDER_V4,
            'method' => 'GET',
            'query'  => Route4Me::generateRequestParameters($allQueryFields, $params)
        ));

        return $response;
    }
    
    public static function validateCoordinate($coord)
    {
        $key = key($coord);
        
        if (!is_numeric($coord[$key])) {
            return false;
        }
        
        switch (variable) {
            case 'cached_lat':
            case 'curbside_lat':
                if ($lat>90 || $lat<-90) {
                    return false;
                }
                break;
            case 'cached_lng':
            case 'curbside_lng':
                if ($lng>180 || $lng<-180) {
                    return false;
                }
                break;
        }
        
        return true;
    }
    
    public function addOrdersFromCsvFile($csvFileHandle, $ordersFieldsMapping)
    {
        $max_line_length = 512;
        $delemietr = ',';
        
        $results = array();
        $results['fail'] = array();
        $results['success'] = array();
        
        $columns = fgetcsv($csvFileHandle, $max_line_length, $delemietr);
        
        $excludeFields = array('route_id', 'redirect', 'optimization_problem_id', 'order_id', 
        'order_ids', 'fields', 'offset', 'limit', 'query', 'created_timestamp');
        
        $allOrderFields = Route4Me::getObjectProperties(new Order(), $excludeFields);
        
        if (!empty($columns)) {
             array_push($results['fail'],'Empty CSV table');
             return ($results);
        }
                 
        $iRow=1;
        
        while (($rows = fgetcsv($csvFileHandle, $max_line_length, $delemietr))!==false) {
            if ($rows[$ordersFieldsMapping['cached_lat']] && $rows[$ordersFieldsMapping['cached_lng']] && $rows[$ordersFieldsMapping['address_1']] && array(null)!==$rows) {
                
                $cached_lat = 0.000;
                $cached_lng = 0.000;
                
                foreach (array('cached_lat', 'cached_lng', 'curbside_lat', 'curbside_lng') as $coord) {
                    if (!$this->validateCoordinate(array($coord => $rows[$ordersFieldsMapping[$coord]]))) {
                        array_push($results['fail'], "$iRow --> Wrong "+$coord); 
                        $iRow++;
                        continue;
                    } else {
                        switch ($coord) {
                            case 'cached_lat':
                                $cached_lat = doubleval($rows[$ordersFieldsMapping[$coord]]);
                                break;
                            case 'cached_lng':
                                $cached_lng = doubleval($rows[$ordersFieldsMapping[$coord]]);
                                break;
                        }
                    }
                }
                
                $address = $rows[$ordersFieldsMapping['address_1']];
                
                foreach (array('order_city', 'order_state_id', 'order_zip_code', 'order_country_id') as $addressPart) {
                    if (isset($ordersFieldsMapping[$addressPart])) {
                        $address .= ', '.$rows[$ordersFieldsMapping[$addressPart]];
                    }
                }

                echo "$iRow --> ".$ordersFieldsMapping['day_scheduled_for_YYMMDD'].", ".$rows[$ordersFieldsMapping['day_scheduled_for_YYMMDD']]."<br>";
                
                $parametersArray = array();
                
                $parametersArray["cached_lat"] = $cached_lat;
                $parametersArray["cached_lng"] = $cached_lng;
                
                
                foreach ($allOrderFields as $orderField) {
                    if (isset($ordersFieldsMapping[$orderField])) {
                        $parametersArray[$orderField] = $rows[$ordersFieldsMapping[$orderField]];
                    }
                }
                
                $orderParameters = Order::fromArray($parametersArray);

                $order = new Order();
                
                $orderResults = $order->addOrder($orderParameters);
                
                array_push($results['success'], "The order with order_id = ".strval($orderResults["order_id"])." added successfuly.");
            }
            else {
                array_push($results['fail'], "$iRow --> one of the parameters cached_lat, cached_lng, address_1 is not set"); 
            }
            
            $iRow++;
        }
    }
}
