<?php
namespace Route4Me;

use Route4Me\Common;
use Route4Me\Enum\Endpoint;

class AddressBookLocation extends Common
{
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
    
    public function __construct () 
    {  }
    
    public static function fromArray(array $params)
    {
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
            'url'    => Endpoint::ADDRESS_BOOK_V4,
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
            'url'    => Endpoint::ADDRESS_BOOK_V4,
            'method' => 'GET',
            'query'  => array(
                'display' => isset($params['display']) ? $params['display'] : null,
                'query'   => isset($params['query']) ? $params['query'] : null,
                'fields'  => isset($params['fields']) ? $params['fields'] : null,
                'limit'   => isset($params['limit']) ? $params['limit'] : null,
                'offset'  => isset($params['offset']) ? $params['offset'] : null,
            )
        ));

        return $result;
    }
    
    public static function getAddressBookLocations($params)
    {
        $ablocations = Route4Me::makeRequst(array(
            'url'    => Endpoint::ADDRESS_BOOK_V4,
            'method' => 'GET',
            'query'  => array(
                'limit'  => isset($params['limit']) ? $params['limit'] : null,
                'offset' => isset($params['offset']) ? $params['offset'] : null,
            )
        ));

        return $ablocations;
    }
    
    public static function getAddressBookLocationsByIDs($ids)
    {
        $ablocations = Route4Me::makeRequst(array(
            'url'    => Endpoint::ADDRESS_BOOK_V4,
            'method' => 'GET',
            'query'  => array(
                'address_id' => $ids
            )
        ));

        return $ablocations;
    }
    
    public static function getRandomAddressBookLocation($params)
    {
        $ablocations = Route4Me::makeRequst(array(
            'url'    => Endpoint::ADDRESS_BOOK_V4,
            'method' => 'GET',
            'query'  => array(
                'limit'  => isset($params['limit']) ? $params['limit'] : 0,
                'offset' => isset($params['offset']) ? $params['offset'] : 10,
            )
        ));
        
        if (isset($ablocations["results"])) {
            $locationsSize = sizeof($ablocations["results"]);
            
            if ($locationsSize > 0) {
                $randomLocationIndex = rand(0, $locationsSize - 1);
                return $ablocations["results"][$randomLocationIndex];
            } 
        } 

        return null;
    }
    
    public static function addAdressBookLocation($params)
    {
        $body = array();
        $abLocations = new AddressBookLocation();
        
        foreach($params as $key => $value) {
            if ($key=="address_id") continue; 
            if (property_exists($abLocations, $key)) {
                if (isset($params->{$key})) {
                    $body[$key] = $params->{$key};
                } 
            }
        }
        
        $response = Route4Me::makeRequst(array(
            'url'    => Endpoint::ADDRESS_BOOK_V4,
            'method' => 'POST',
            'body'   => $body
        ));

        return $response;
    }
    
    public function deleteAdressBookLocation($address_ids)
    {
        $result = Route4Me::makeRequst(array(
            'url'    => Endpoint::ADDRESS_BOOK_V4,
            'method' => 'DELETEARRAY',
            'query'  => array(
                'address_ids' => $address_ids
            )
        ));

        return $result;
    }
    
    public function updateAdressBookLocation($params)
    {
        $body = array();
        $abLocations = new AddressBookLocation();
        
        foreach($params as $key => $value) {
            if (property_exists($abLocations, $key)) {
                if (isset($params->{$key})) {
                    $body[$key] = $params->{$key};
                } 
            }
        }

        $response = Route4Me::makeRequst(array(
            'url'    => Endpoint::ADDRESS_BOOK_V4,
            'method' => 'PUT',
            'body'   => $body,
        ));

        return $response;
    }
        
    public static function get($params)
    {
        $ablocations = Route4Me::makeRequst(array(
            'url'    => Endpoint::ADDRESS_BOOK_V4,
            'method' => 'ADD',
            'query'  => array(
                'first_name' => isset($params->first_name) ? $params->first_name : null,
                'address_1'  => isset($params->address_1) ? $params->address_1 : null,
                'cached_lat' => isset($params->cached_lat) ? $params->cached_lat : null,
                'cached_lng' => isset($params->cached_lng) ? $params->cached_lng : null,
            )
        ));

        return $ablocations;
    }
    
    public static function validateScheduleMode($scheduleMode)
    {
        $schedMmodes=array("daily","weekly","monthly","annually");
        
        if (in_array($scheduleMode, $schedMmodes)) 
            return TRUE; 
        else 
            return FALSE;
    }
    
    public static function validateScheduleEnable($scheduleEnabled)
    {
        $schedEnambles=array(TRUE,FALSE);
        
        if (in_array($scheduleEnabled, $schedEnambles))
            return TRUE;
        else
            return FALSE;
    }
    
    public static function validateScheduleEvery($scheduleEvery)
    {
        if (is_numeric($scheduleEvery))
            return TRUE;
        else
            return FALSE;
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
        
        return $isValid;
    }
    
    public static function validateScheduleMonthlyMode($scheduleMonthlyMode)
    {
        $schedMonthlyMmodes=array("dates","nth");
        
        if (in_array($scheduleMonthlyMode, $schedMonthlyMmodes))
            return TRUE;
        else
            return FALSE;
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

        return $isValid;
    }
    
    public static function validateScheduleNthN($scheduleNthN)
    {
        if (!is_numeric($scheduleNthN)) return FALSE;
        
        $schedNthNs=array(1,2,3,4,5,-1);
        
        if (in_array($scheduleNthN, $schedNthNs))
            return TRUE;
        else
            return FALSE;
    }
    
    public static function validateScheduleNthWhat($scheduleNthWhat)
    {
        if (!is_numeric($scheduleNthWhat)) return FALSE;
        
        $schedNthWhats=array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
        
        if (in_array($scheduleNthWhat, $schedNthWhats))
            return TRUE;
        else
            return FALSE;
    }
    
    /* Function adds the locations (with/without schedule) from the CSV file. 
     * $csvFileHandle - a file handler.
     * Returns array $results which contains two arrays: fail and succes.
     */
    public function addLocationsFromCsvFile($csvFileHandle, $locationsFieldsMapping)
    {
        $max_line_length = 512;
        $delemietr=',';
        
        $results=array();
        $results['fail']=array();
        $results['success']=array();
        
        $columns = fgetcsv($csvFileHandle, $max_line_length, $delemietr);
        
        if (!empty($columns)) {
            array_push($results['fail'],'Empty CSV table');
            return ($results);
        }
                 
        $iRow=1;
        
        while (($rows = fgetcsv($csvFileHandle, $max_line_length, $delemietr)) !== false) {
            if ($rows[$locationsFieldsMapping['cached_lat']] 
                  && $rows[$locationsFieldsMapping['cached_lng']] 
                  && $rows[$locationsFieldsMapping['address_1']] 
                  && array(null) !== $rows) {
                $curSchedule="";
                $mode="";
                
                if (isset($rows[$locationsFieldsMapping['schedule_mode']])) {
                    if ($this->validateScheduleMode($rows[$locationsFieldsMapping['schedule_mode']])) {
                        $curSchedule='"mode":"'.$rows[$locationsFieldsMapping['schedule_mode']].'",'; 
                        $mode=$rows[$locationsFieldsMapping['schedule_mode']];
                    } else {
                        array_push($results['fail'],"$iRow --> Wrong schedule mode parameter"); 
                        $curSchedule="";
                    }
                } else {
                    array_push($results['fail'],"$iRow --> The schedule mode parameter is not set"); 
                    $curSchedule="";
                }
                
                if (isset($rows[$locationsFieldsMapping['schedule_enabled']])) {
                    if ($this->validateScheduleEnable($rows[$locationsFieldsMapping['schedule_enabled']])) { 
                        $curSchedule.='"enabled":'.$rows[$locationsFieldsMapping['schedule_enabled']].',';
                    } else {
                        array_push($results['fail'],"$iRow --> The schedule enabled parameter is not set ");  
                        $curSchedule="";
                    }
                }
                
                if (isset($rows[$locationsFieldsMapping['schedule_every']])) {
                    if ($this->validateScheduleEvery($rows[$locationsFieldsMapping['schedule_every']])) {
                        $curSchedule.='"'.$mode.'":{'.'"every":'.$rows[$locationsFieldsMapping['schedule_every']].','; 
                        if ($mode=='daily') {
                            $curSchedule=trim($curSchedule,',');
                            $curSchedule.='}';
                        }
                    } else {
                        array_push($results['fail'],"$iRow --> The parameter sched_every is not set"); 
                        $curSchedule=""; 
                    }
                }
                
                if ($mode!='daily') {
                    switch ($mode) {
                        case 'weekly':
                            if (isset($rows[$locationsFieldsMapping['schedule_weekdays']])) {
                                if ($this->validateScheduleWeekDays($rows[$locationsFieldsMapping['schedule_weekdays']])) {
                                     $curSchedule.='"weekdays":['.$rows[$locationsFieldsMapping['schedule_weekdays']].']}';
                                } else {
                                    array_push($results['fail'],"$iRow --> Wrong weekdays"); 
                                    $curSchedule="";
                                }
                            } else {
                                array_push($results['fail'],"$iRow --> The parameters sched_weekdays is not set"); 
                                $curSchedule="";
                            }
                            break;
                        case 'monthly':
                            $monthlyMode="";
                            if (isset($rows[$locationsFieldsMapping['monthly_mode']])) {
                                if ($this->validateScheduleMonthlyMode($rows[$locationsFieldsMapping['monthly_mode']])) {
                                     $monthlyMode=$rows[$locationsFieldsMapping['monthly_mode']];
                                     $curSchedule.='"mode": "'.$rows[$locationsFieldsMapping['monthly_mode']].'",';
                                } else {
                                    array_push($results['fail'],"$iRow --> Wrong monthly mode"); 
                                    $curSchedule="";
                                }
                            } else {
                                array_push($results['fail'],"$iRow --> The parameter sched_monthly_mode is not set"); 
                                $curSchedule="";
                            }
                            
                            if ($monthlyMode!="") {
                                switch ($monthlyMode) {
                                    case 'dates':
                                        if (isset($rows[$locationsFieldsMapping['monthly_dates']])) {
                                            if ($this->validateScheduleMonthlyDates($rows[$locationsFieldsMapping['monthly_dates']])) {
                                                 $curSchedule.='"dates":['.$rows[$locationsFieldsMapping['monthly_dates']].']}';
                                            } else {
                                                array_push($results['fail'],"$iRow --> Wrong monthly dates"); 
                                                $curSchedule="";
                                            }
                                        }
                                        break;
                                    case 'nth':
                                        if (isset($rows[$locationsFieldsMapping['monthly_nth_n']])) {
                                            if ($this->validateScheduleNthN($rows[$locationsFieldsMapping['monthly_nth_n']])) {
                                                 $curSchedule.='"nth":{"n":'.$rows[$locationsFieldsMapping['monthly_nth_n']].',';
                                            } else {
                                                array_push($results['fail'],"$iRow --> Wrong parameter sched_nth_n"); 
                                                $curSchedule="";
                                            }
                                        } else {
                                            array_push($results['fail'],"$iRow --> The parameter sched_nth_n is not set"); 
                                            $curSchedule="";
                                        }
                                        
                                        if ($curSchedule!="") {
                                            if (isset($rows[$locationsFieldsMapping['monthly_nth_wwhat']])) {
                                                if ($this->validateScheduleNthWhat($rows[$locationsFieldsMapping['monthly_nth_wwhat']])) {
                                                     $curSchedule.='"what":'.$rows[$locationsFieldsMapping['monthly_nth_wwhat']].'}}';
                                                } else {
                                                    array_push($results['fail'],"$iRow --> Wrong parameter sched_nth_what"); 
                                                    $curSchedule="";
                                                }
                                            } else {
                                                array_push($results['fail'],"$iRow --> The parameter sched_nth_what is not set"); 
                                                $curSchedule="";
                                            }
                                        }
                                        break;
                                }
                            }
                            break;
                        default:
                            $curSchedule=="";
                            break;
                    }
                }

                if (($mode=='daily' || $mode=='weekly' || $mode=='monthy') && $curSchedule=="") {
                    $iRow++; 
                    continue;
                }
                
                $curSchedule=strtolower($curSchedule);
                
                $curSchedule='[{'.$curSchedule.'}]';

                $oSchedule= json_decode($curSchedule,TRUE);
                
                $AdressBookLocationParameters=AddressBookLocation::fromArray(array(
                    "cached_lat"                 => $rows[$locationsFieldsMapping['cached_lat']],
                    "cached_lng"                 => $rows[$locationsFieldsMapping['cached_lng']],
                    "curbside_lat"               => isset($locationsFieldsMapping['curbside_lat'])
                                                     ? $rows[$locationsFieldsMapping['curbside_lat']] : null,
                    "curbside_lng"               => isset($locationsFieldsMapping['curbside_lng'])
                                                     ? $rows[$locationsFieldsMapping['curbside_lng']] : null,
                    "address_alias"              => isset($locationsFieldsMapping['address_alias'])
                                                     ? $rows[$locationsFieldsMapping['address_alias']] : null,
                    "address_1"                  => $rows[$locationsFieldsMapping['address_1']],
                    "address_2"                  => isset($locationsFieldsMapping['address_2'])
                                                     ? $rows[$locationsFieldsMapping['address_2']] : null,
                    "address_city"               => isset($locationsFieldsMapping['address_city'])
                                                      ? $rows[$locationsFieldsMapping['address_city']] : null,
                    "address_state_id"           => isset($locationsFieldsMapping['address_state_id'])
                                                      ? $rows[$locationsFieldsMapping['address_state_id']] : null,
                    "address_zip"                => isset($locationsFieldsMapping['address_zip'])
                                                      ? $rows[$locationsFieldsMapping['address_zip']] : null,
                    "address_phone_number"       => isset($locationsFieldsMapping['address_phone_number'])
                                                      ? $rows[$locationsFieldsMapping['address_phone_number']] : null,
                    "schedule"                   => isset($oSchedule) ? $oSchedule : null,
                    "address_group"              => isset($locationsFieldsMapping['address_group']) 
                                                      ? $rows[$locationsFieldsMapping['address_group']] : null,
                    "first_name"                 => isset($locationsFieldsMapping['first_name']) 
                                                      ? $rows[$locationsFieldsMapping['first_name']] : null,
                    "last_name"                  => isset($locationsFieldsMapping['last_name']) 
                                                      ? $rows[$locationsFieldsMapping['last_name']] : null,
                    "local_time_window_start"    => isset($locationsFieldsMapping['local_time_window_start'])
                                                      ? $rows[$locationsFieldsMapping['local_time_window_start']] : null,
                    "local_time_window_end"      => isset($locationsFieldsMapping['local_time_window_end'])
                                                      ? $rows[$locationsFieldsMapping['local_time_window_end']] : null,
                    "local_time_window_start_2"  => isset($locationsFieldsMapping['local_time_window_start_2'])
                                                      ? $rows[$locationsFieldsMapping['local_time_window_start_2']] : null,
                    "local_time_window_end_2"    => isset($locationsFieldsMapping['local_time_window_end_2'])
                                                      ? $rows[$locationsFieldsMapping['local_time_window_end_2']] : null,
                    "address_email"              => isset($locationsFieldsMapping['address_email'])
                                                      ? $rows[$locationsFieldsMapping['address_email']] : null,
                    "address_country_id"         => isset($locationsFieldsMapping['address_country_id'])
                                                      ? $rows[$locationsFieldsMapping['address_country_id']] : null,
                    "address_custom_data"        => isset($locationsFieldsMapping['address_custom_data'])
                                                      ? $rows[$locationsFieldsMapping['address_custom_data']] : null,
                    "schedule_blacklist"         => isset($locationsFieldsMapping['schedule_blacklist'])
                                                      ? $rows[$locationsFieldsMapping['schedule_blacklist']] : null,
                    "service_time"               => isset($locationsFieldsMapping['service_time'])
                                                      ? $rows[$locationsFieldsMapping['service_time']] : null,
                    "local_timezone_string"      => isset($locationsFieldsMapping['local_timezone_string'])
                                                      ? $rows[$locationsFieldsMapping['local_timezone_string']] : null,
                    "color"                      => isset($locationsFieldsMapping['color'])
                                                      ? $rows[$locationsFieldsMapping['color']] : null,
                    "address_icon"               => isset($locationsFieldsMapping['address_icon'])
                                                      ? $rows[$locationsFieldsMapping['address_icon']] : null,
                    "address_stop_type"          => isset($locationsFieldsMapping['address_stop_type'])
                                                      ? $rows[$locationsFieldsMapping['address_stop_type']] : null,
                    "address_cube"               => isset($locationsFieldsMapping['address_cube'])
                                                      ? $rows[$locationsFieldsMapping['address_cube']] : null,
                    "address_pieces"             => isset($locationsFieldsMapping['address_pieces'])
                                                      ? $rows[$locationsFieldsMapping['address_pieces']] : null,
                    "address_reference_no"       => isset($locationsFieldsMapping['address_reference_no'])
                                                      ? $rows[$locationsFieldsMapping['address_reference_no']] : null,
                    "address_revenue"            => isset($locationsFieldsMapping['address_revenue'])
                                                      ? $rows[$locationsFieldsMapping['address_revenue']] : null,
                    "address_weight"             => isset($locationsFieldsMapping['address_weight'])
                                                      ? $rows[$locationsFieldsMapping['address_weight']] : null,
                    "address_priority"           => isset($locationsFieldsMapping['address_priority'])
                                                      ? $rows[$locationsFieldsMapping['address_priority']] : null,
                    "address_customer_po"        => isset($locationsFieldsMapping['address_customer_po'])
                                                      ? $rows[$locationsFieldsMapping['address_customer_po']] : null,
                ));
                
                $abContacts=new AddressBookLocation();

                $abcResults=$abContacts->addAdressBookLocation($AdressBookLocationParameters); //temporarry
                
                array_push($results['success'],"The schedule location with address_id = ".strval($abcResults["address_id"])." added successfuly.");
            }
        }

        return $results;
    }
 }
    