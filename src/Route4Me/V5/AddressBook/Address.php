<?php

namespace Route4Me\V5\AddressBook;

use Route4Me\Exception\ApiError;
use Route4Me\V5\AddressBook\ResponseAddress;

/**
 * Address Book API Address structure
 *
 * @since 1.2.8
 *
 * @package Route4Me
 */
class Address extends ResponseAddress
{
    /**
     * @param array|string $params_or_address_1  - The route Address Line 1 or array of Address's values.
     * @param float        $cached_lat           - A latitude of the contact's cached position.
     * @param float        $cached_lng           - A longitude of the contact's cached position.
     * @param string       $address_stop_type    - The contact's stop type. available types:
     *                                             'DELIVERY', 'PICKUP', 'BREAK', 'MEETUP',
     *                                             'SERVICE', 'VISIT', 'DRIVEBY'
     */
    public function __construct(
        $params_or_address_1,
        ?float $cached_lat = null,
        ?float $cached_lng = null,
        ?string $address_stop_type = null
    ) {
        if (is_array($params_or_address_1) && isset($params_or_address_1['address_1'])
            && isset($params_or_address_1['cached_lat']) && isset($params_or_address_1['cached_lng'])
            && isset($params_or_address_1['address_stop_type'])
        ) {
            parent::__construct($params_or_address_1);
        } elseif (is_string($params_or_address_1) && $params_or_address_1 != ""
            && !is_null($cached_lat) && !is_null($cached_lng) && !is_null($address_stop_type)
        ) {
            $this->address_1 = $params_or_address_1;
            $this->cached_lat = $cached_lat;
            $this->cached_lng = $cached_lng;
            $this->address_stop_type = $address_stop_type;
        } else {
            throw new ApiError('The fields address_1, cached_lat, cached_lng, address_stop_type are required.');
        }
    }
}
