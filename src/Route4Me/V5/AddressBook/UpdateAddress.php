<?php

namespace Route4Me\V5\AddressBook;

use Route4Me\Exception\ApiError;
use Route4Me\V5\AddressBook\ResponseAddress;

/**
 * Address Book API UpdateAddress structure
 *
 * @since 1.2.8
 *
 * @package Route4Me
 */
class UpdateAddress extends ResponseAddress
{
    /**
     * @param int $service_time            - The route Address Line 1 or array of Address's values.
     */
    public function __construct(int $service_time)
    {
        $this->service_time = $service_time;
    }
}
