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
class RouteSchedule extends Common
{
    /**
     * The Route ID
     */
    public ?string $route_id = null;

    /**
     * The Schedule ID
     */
    public ?string $schedule_uid = null;

    /**
     * The Schedule ID
     */
    public ?int $member_id = null;

    /**
     * The Schedule ID
     */
    public ?string $vehicle_id = null;

    public function __construct(?array $params = null)
    {
        if ($params !== null) {
            $this->fillFromArray($params);
        }
    }
}
