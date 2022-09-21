<?php


namespace Route4Me\Schedule;

use Route4Me\Common as Common;

/**
 * Subclass of the class Schedule.
 * @package Route4Me\Schedule
 */
class ScheduleAnnually extends Common
{
    /**
     * Repeat every year next 'Every' months.
     * @var integer
     */
    public $every;

    /**
     * If true, use NTH mode.
     * @var Boolean
     */
    public $use_nth;

    /**
     * An array of the month numbers.
     * @var integer[]
     */
    public $months;

    /**
     * Annualy schedule option if 'UseNth' is true.
     * @var ScheduleMonthlyNth
     */
    public $nth;
}