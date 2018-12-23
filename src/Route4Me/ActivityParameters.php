<?php
namespace Route4Me;

use Route4Me\Common;
use Route4Me\Enum\Endpoint;

class ActivityParameters extends Common
{
    public $route_id;
    public $device_id;
    public $member_id;
    public $team;
    public $limit;
    public $offset;
    public $start;
    public $end;
    public $activity_type;
    public $activity_message;
    
    public $activity_id;
    public $activity_timestamp;
    public $route_destination_id;
    public $note_id;
    public $member;
    public $note_type;
    public $note_contents;
    public $route_name;
    public $note_file;
    public $destination_name;
    public $destination_alias;
    
    public static function fromArray(array $params) 
    {
        $activityparameters = new ActivityParameters();
        
        foreach ($params as $key => $value) {
            if (property_exists($activityparameters, $key)) {
                $activityparameters->{$key} = $value;
            }
        }
        
        return $activityparameters;
    }
    
    public static function getActivities($params)
    {
        $allQueryFields = array('route_id', 'team', 'limit', 'offset', 'start');
        
        $activity = Route4Me::makeRequst(array(
            'url'    => Endpoint::GET_ACTIVITIES,
            'method' => 'GET',
            'query'  => Route4Me::generateRequestParameters($allQueryFields, $params)
        ));

        return $activity;
    }

    public static function searcActivities($params)
    {
        $allQueryFields = array('route_id', 'limit', 'offset', 'activity_type');
        
        $activity = Route4Me::makeRequst(array(
            'url'    => Endpoint::GET_ACTIVITIES,
            'method' => 'GET',
            'query'  => Route4Me::generateRequestParameters($allQueryFields, $params)
        ));

        return $activity;
    }
    
    public static function sendUserMessage($params)
    {
        $allBodyFields = array('activity_type', 'activity_message', 'route_id');
        
        $result = Route4Me::makeRequst(array(
            'url'    => Endpoint::ACTIVITY_FEED,
            'method' => 'POST',
            'body'   => Route4Me::generateRequestParameters($allBodyFields, $params)
        ));
        
        return $result;
    }
}
