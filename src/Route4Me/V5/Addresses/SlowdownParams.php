<?php

namespace Route4Me\V5\Addresses;

use Route4Me\Common as Common;

/**
 * Slowdown parameters for the optimization creating process.
 */
class SlowdownParams extends Common
{
    /**
     * Service time slowdowon (percent).
     * @var int
     */
    public $service_time;

    /**
     * Travel time slowdowon (percent).
     * @var int
     */
    public $travel_time;
}
