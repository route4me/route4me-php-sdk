<?php

namespace Route4Me;

use Route4Me\Enum\Endpoint;

/*
 * Data structure of the schedule calendar response.
 */
class ScheduleCalendarResponse extends Common
{
    /*
     * The address book contact quantity by dates (dates are in the string format, e.g. 2020-10-18).
     */
    public $address_book = [];

    /*
     * The order quantity by dates (dates are in the string format, e.g. 2020-10-18).
     */
    public $orders = [];

    /*
     * The order quantity by dates (dates are in the string format, e.g. 2020-10-18).
     */
    public $routes_count = [];

    public static function fromArray(array $params)
    {
        $order = new self();
        foreach ($params as $key => $value) {
            if (property_exists($order, $key)) {
                $order->{$key} = $value;
            }
        }

        return $order;
    }
}
