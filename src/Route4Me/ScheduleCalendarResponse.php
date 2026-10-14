<?php

namespace Route4Me;

/**
 * Data structure of the schedule calendar response.
 */
class ScheduleCalendarResponse extends Common
{
    /**
     * The address book contact quantity by dates
     * (dates are in the string format, e.g. 2020-10-18).
     * @var array
     */
    public $address_book = [];

    /*
     * The order quantity by dates
     * (dates are in the string format, e.g. 2020-10-18).
     * @var array
     */
    public $orders = [];

    /*
     * The order quantity by dates
     * (dates are in the string format, e.g. 2020-10-18).
     * @var array
     */
    public $routes_count = [];
}
