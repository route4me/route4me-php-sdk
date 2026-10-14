<?php

namespace Route4Me\V5\AddressBook;

/**
 * Address Book API UpdateAddress structure.
 *
 * @since 1.2.8
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
