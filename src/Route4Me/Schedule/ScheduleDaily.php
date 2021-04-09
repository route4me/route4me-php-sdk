<?php


namespace Route4Me\Schedule;

use Route4Me\Common as Common;

/**
 * Subclass of the class Schedule.
 * @package Route4Me\Schedule
 */
class ScheduleDaily extends Common
{
    /**
     * Repeat every next 'Every' days
     * @var integer
     */
    public $every;
}