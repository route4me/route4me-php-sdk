<?php

namespace Route4Me\Schedule;

/**
 * Subclass of the class Schedule.
 */
class ScheduleMonthlyNth
{
    /**
     * Which day of the time period, 1: 1st, 2: 2nd, 3: 3rd, 4: 4th, 5: 5th, -1: Last.
     * @var int
     */
    public $n;

    /**
     * What time. Available values:<br>
     * 1: Monday, 2: Tuesday, 3: Wednesday, 4: Thursday, 5: Friday,<br>
     * 6: Saturday, 7: Sunday, 8: Day, 9: Working Day, 10: Weekend.
     * @var int
     */
    public $what;
}
