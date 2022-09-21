<?php


namespace Route4Me\V5\Addresses;

use Route4Me\Common as Common;

/**
 * Structure of the property RoutePArameters->override_addresses
 * @package Route4Me\V5\Addresses
 */
class OverrideAddresses
{
    /**
     * The service time specified or all the addresses in the route.
     * @var integer
     */
    public $time;

    /**
     * Route address stop type
     * @var string
     */
    public $address_stop_type;

    /**
     * The address group
     * @var string
     */
    public $group;
}