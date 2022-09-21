<?php

namespace Route4Me\TelematicsGateway;

use Route4Me\Common As Common;

/**
 * Response from the telematics vendors request.
 */
class TelematicsVendorsResponse 
{
    /**
     * An array of the telematics vendors.
     * @var TelematicsVendors[]
     */
    public $vendors = [];
}
