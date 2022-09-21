<?php

namespace Route4Me\TelematicsGateway;

use Route4Me\Common As Common;
/**
 * Response from the telematics vendor request.
 */
class TelematicsVendorResponse extends Common
{
    /**
     * Telematics Vendor
     * @var TelematicsVendor
     */
    public $vendor;
}
