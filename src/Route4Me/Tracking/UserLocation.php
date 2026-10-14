<?php

namespace Route4Me\Tracking;

/**
 * Class UserLocation - response from the endpoint USER_LOCATION.
 */
class UserLocation extends \Route4Me\Common
{
    /**
     * @var MemberData[]
     */
    public $member_data = [];

    /**
     * @var UserTracking[]
     */
    public $tracking = [];

    /**
     * @var bool
     */
    public $from_cache;
}
