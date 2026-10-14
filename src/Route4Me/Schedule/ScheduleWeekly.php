<?php

namespace Route4Me\Schedule;

use Route4Me\Common as Common;

/**
 * Subclass of the class Schedule.
 */
class ScheduleWeekly extends Common
{
    /**
     * Repeat every week next 'Every' days.
     * @var int
     */
    public $every;

    /**
     * An array of the weekday numbers.
     * @var int[]
     */
    public $weekdays = [];
}
