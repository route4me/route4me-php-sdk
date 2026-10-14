<?php

namespace Route4Me\V5\Addresses;

/**
 * Structure of the property RoutePArameters->override_addresses.
 */
class OverrideAddresses
{
    /**
     * The service time specified or all the addresses in the route.
     * @var long
     */
    public $time;

    /**
     * Route address stop type.
     * @var string
     */
    public $address_stop_type;

    /**
     * The address group.
     * @var string
     */
    public $group;
}
