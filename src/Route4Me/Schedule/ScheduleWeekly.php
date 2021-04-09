<?php


namespace Route4Me\Schedule;

use Route4Me\Common as Common;

/**
 * Subclass of the class Schedule.
 * @package Route4Me\Schedule
 */
class ScheduleWeekly extends Common
{
    /**
     * Repeat every week next 'Every' days.
     * @var integer
     */
    public $every;

    /**
     * An array of the weekday numbers.
     * @var integer[]
     */
    public $weekdays = [];
}
