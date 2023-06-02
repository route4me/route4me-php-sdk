<?php


namespace Route4Me\Tracking;

/**
 * Class UserLocation - response from the endpoint USER_LOCATION
 * @package Route4Me
 */
class UserLocation extends \Route4Me\Common
{
    /** @var MemberData[] $member_data */
    public $member_data=[];

    /** @var UserTracking[] $tracking */
    public $tracking = [];

    /** @var boolean $from_cache*/
    public $from_cache;
}
