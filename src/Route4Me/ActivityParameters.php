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
    
    public function __construct () 
    {
        
    }
    
    public static function fromArray(array $params) 
    {
        $activityparameters = new ActivityParameters();
        
        foreach($params as $key => $value) {
            if (property_exists($activityparameters, $key)) {
                $activityparameters->{$key} = $value;
            }
        }
        
        return $activityparameters;
    }
    
    public static function get($params)
    {
        $activity = Route4Me::makeRequst(array(
            'url'    => Endpoint::GET_ACTIVITIES,
            'method' => 'GET',
            'query'  => array(
                'route_id' => isset($params->route_id) ? $params->route_id : null,
                'team'     => isset($params->team) ? $params->team : null,
                'limit'    => isset($params->limit) ? $params->limit : null,
                'offset'   => isset($params->offset) ? $params->offset : null,
                'start'   => isset($params->start) ? $params->start : null,
            )
        ));

        return $activity;
    }

    public static function searcActivities($params)
    {
        $activity = Route4Me::makeRequst(array(
            'url'    => Endpoint::GET_ACTIVITIES,
            'method' => 'GET',
            'query'  => array(
                'route_id'      => isset($params->route_id) ? $params->route_id : null,
                'limit'         => isset($params->limit) ? $params->limit : null,
                'offset'        => isset($params->offset) ? $params->offset : null,
                'activity_type' => isset($params->activity_type) ? $params->activity_type : null,
            )
        ));

        return $activity;
    }
    
    public static function sendUserMessage($postParameters)
    {
        $result = Route4Me::makeRequst(array(
            'url'    => Endpoint::ACTIVITY_FEED,
            'method' => 'POST',
            'body'   => array(
                'activity_type'    => isset($postParameters->activity_type) ? $postParameters->activity_type : null,
                'activity_message' => isset($postParameters->activity_message) ? $postParameters->activity_message : null,
                'route_id'         => isset($postParameters->route_id) ? $postParameters->route_id : null,
            )
        ));
        
        return $result;
    }
    
}
