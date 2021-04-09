<?php


namespace Route4Me\V5\Addresses;

use Route4Me\Common as Common;

/**
 * Slowdown parameters for the optimization creating process.
 * @package Route4Me\V5\Addresses
 */
class SlowdownParams extends Common
{
    /**
     * Service time slowdowon (percent)
     * @var integer
     */
    public $service_time;

    /**
     * Travel time slowdowon (percent)
     * @var integer
     */
    public $travel_time;
}