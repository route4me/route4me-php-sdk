<?php


namespace Route4Me\Schedule;

use Route4Me\Common as Common;

/**
 * Subclass of the class Schedule.
 * @package Route4Me\Schedule
 */
class ScheduleMonthly extends Common
{
    /**
     * Repeat every month next 'Every' days.
     * @var integer
     */
    public $every;

    /**
     * Monthly schedule mode
     * @var string
     */
    public $mode;

    /**
     * An array of month days for monthly schedule if the mode 'dates' was chosen.
     * @var integer[]
     */
    public $dates = [];

    /**
     * Monthly schedule option if the mode 'nth' was chosen.
     * @var ScheduleMonthlyNth
     */
    public $nth;
}