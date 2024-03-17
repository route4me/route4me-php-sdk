<?php

namespace Route4Me\V5\RecurringRoutes;

use Route4Me\Common as Common;

/**
 * The recurring routes Schedules structure
 *
 * @since 1.2.3
 *
 * @package Route4Me
 */
class Schedule extends Common
{
    /**
     * The Schedule ID
     */
    public ?string $schedule_uid = null;

    /**
     * The name of Schedule
     */
    public ?string $name = null;

    /**
     * Array of blacklisted dates as string 'YYYY-MM-DD'.
     */
    public ?array $schedule_blacklist = null;

    public int $advance_interval = 1;

    public int $advance_schedule_interval_days = 0;

    /**
     * Schedule as JSON string
     * e.g. '{"enabled":true,"mode":"daily","daily":{"every":2}, "from":"2019-06-05","timestamp":1558538737}'
     */
    public ?string $schedule = null;

    /**
     * Timezone as 'America/New_York'.
     */
    public ?string $timezone = null;

    public function __construct(?array $params = null)
    {
        if ($params !== null) {
            $this->fillFromArray($params);
        }
    }
}
