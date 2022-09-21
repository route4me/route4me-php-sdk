<?php


namespace Route4Me\Schedule;

use Route4Me\Common as Common;

/**
 * A trip schedule to a location
 * @package Route4Me\Schedule
 */
class Schedule extends Common
{
    /**
     * Gets or sets a value indicating whether this is enabled.
     * @var Boolean
     */
    public $enabled;

    /**
     * When schedule will be started from.
     * @var string
     */
    public $from;

    /**
     * Schedule mode<br>
     * Available values:<br>
     * daily, weekly, monthly, annually
     * @var string
     */
    public $mode;

    /**
     * If schedule mode is daily, specifies daily schedule data.
     * @var ScheduleDaily
     */
    public $daily;

    /**
     * If schedule mode is weekly, specifies weekly schedule data.
     * @var ScheduleWeekly
     */
    public $weekly;

    /**
     * If schedule mode is monthly, specifies monthly schedule data.
     * @var ScheduleMonthly
     */
    public $monthly;

    /**
     * If schedule mode is annually, specifies annually schedule data.
     * @var ScheduleAnnually
     */
    public $annually;
}