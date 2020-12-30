<?php

namespace Route4Me;

use Route4Me\Enum\Endpoint;

/* URL query parameters for retrieving the schedule calendar. */
class ScheduleCalendarParameters extends Common
{
    /* Start date to filter the schedules in the string format (e.g. 2020-10-27). */
    public $date_from_string;

    /* End date to filter the schedules in the string format (e.g. 2020-10-30). */
    public $date_to_string;

    /* Member ID */
    public $member_id;

    /* Timezone offset (in minutes) (e.g. NYT: -4*60 = -480, Kiev: 3*60 = 180). */
    public $timezone_offset_minutes;

    /* If true, the scheduled orders are included in the calendar. */
    public $orders;

    /* If true, the scheduled address book contacts are included in the calendar. */
    public $ab;

    /* If true, the scheduled routes are included in the calendar. */
    public $routes_count;

    /* Class constructor. */
    public function __construct()
    {
        Route4Me::setBaseUrl(Endpoint::BASE_URL);
    }

    /* Convert an array to this object */
    public static function fromArray(array $params)
    {
        $scheduleCalendarParameters = new self();

        foreach ($params as $key => $value) {
            if (property_exists($scheduleCalendarParameters, $key)) {
                $scheduleCalendarParameters->{$key} = $value;
            }
        }

        return $scheduleCalendarParameters;
    }

    public function setTimezoneOffsetMinutes($tz)
    {
        $this->timezone_offset_minutes = -$tz;
    }

    public function getTimezoneOffsetMinutes()
    {
        if (is_numeric($this->timezone_offset_minutes)) {
            return -$this->timezone_offset_minutes;
        } else {
            return 0;
        }
    }

    public function getScheduleCalendar($params)
    {
        $allQueryFields = ['date_from_string', 'date_to_string', 'member_id', 'timezone_offset_minutes', 'orders', 'ab', 'routes_count'];

        $schedCalendar = Route4Me::makeRequst([
            'url'       => Endpoint::SCHEDULE_CALENDAR,
            'method'    => 'GET',
            'query'     => Route4Me::generateRequestParameters($allQueryFields, $params),
        ]);

        return $schedCalendar;
    }
}