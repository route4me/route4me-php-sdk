<?php

namespace Route4Me\V5\RecurringRoutes;

use Route4Me\Exception\ApiError;
use Route4Me\Route4Me;
use Route4Me\Common;
use Route4Me\V5\Enum\Endpoint;
use Route4Me\V5\RecurringRoutes\Schedule;
use Route4Me\V5\RecurringRoutes\RouteSchedule;
use Route4Me\V5\RecurringRoutes\PageInfo;

/**
 * The recurring routes Schedules structure
 *
 * @since 1.2.3
 *
 * @package Route4Me
 */
class Schedules extends Common
{
    public function __construct()
    {
        Route4Me::setBaseUrl('');
    }

    /**
     * Create a new Schedule by sending the corresponding data.
     *
     * @since 1.2.3
     *
     * @param  array    $params
     *   string   schedule_uid - Schedule ID,
     *   int      root_member_id,
     *   string   name - Name of Schedule,
     *   string[] schedule_blacklist - An array of blacklisted dates as 'YYYY-MM-DD',
     *   int      advance_interval,
     *   int      advance_schedule_interval_days,
     *   string   schedule - Schedule as JSON string e.g. '{"enabled":true,"mode":"daily",
     *                           "daily":{"every":2}, "from":"2019-06-05","timestamp":1558538737}',
     *   string   timezone - Timezone as 'America/New_York'
     * @return Schedule
     * @throws Exception\ApiError
     */
    public function createSchedule(array $params) : Schedule
    {
        $allBodyFields = ['schedule_uid', 'root_member_id', 'name', 'schedule_blacklist',
            'advance_interval', 'advance_schedule_interval_days', 'schedule', 'timezone'];

        return $this->toSchedule(Route4Me::makeRequst([
            'url' => Endpoint::RECURRING_ROUTES_SCHEDULES,
            'method' => 'POST',
            'HTTPHEADER' => 'Content-Type: application/json',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params)
        ]));
    }

    /**
     * Get the Schedule by specifying the Schedule ID.
     *
     * @since 1.2.3
     *
     * @param  string $scheduleId Schedule ID.
     * @return Schedule
     * @throws Exception\ApiError
     */
    public function getSchedule(string $scheduleId) : Schedule
    {
        return $this->toSchedule(Route4Me::makeRequst([
            'url' => Endpoint::RECURRING_ROUTES_SCHEDULES . '/' . $scheduleId,
            'method' => 'GET'
        ]));
    }

    /**
     * Get the list of all Schedules.
     *
     * @since 1.2.3
     *
     * @return Schedule[]
      * @throws Exception\ApiError
    */
    public function getAllSchedules() : array
    {
        $result = Route4Me::makeRequst([
            'url' => Endpoint::RECURRING_ROUTES_SCHEDULES,
            'method' => 'GET'
        ]);

        if (is_array($result) && isset($result['data'])) {
            $data = $result['data'];
            if (is_array($data) && isset($data[0]) && is_array($data[0])) {
                $arr = [];
                foreach ($data as $key => $value) {
                    array_push($arr, new Schedule($value));
                }
                return $arr;
            }
        }
        return null;
    }

    /**
     * Get paginated list of Schedules.
     *
     * @since 1.2.3
     *
     * @param  int   $page Requested page.
     * @param  int   $per_page Number of Schedules per page.
     * @return array
     * @throws Exception\ApiError
     */
    public function getSchedules(int $page = 1, int $per_page = 15) : array
    {
        $result = Route4Me::makeRequst([
            'url' => Endpoint::RECURRING_ROUTES_SCHEDULES_PAGINATION,
            'method' => 'GET',
            'query' => [
                'with_pagination' => true,
                'page' => $page,
                'per_page' => $per_page
            ]
        ]);

        if (is_array($result) && isset($result['data'])) {
            $data = $result['data'];
            $schedules = [];
            if (is_array($data) && isset($data[0]) && is_array($data[0])) {
                foreach ($data as $key => $value) {
                    array_push($schedules, new Schedule($value));
                }
            }
            return [
                'schedules' => $schedules,
                'page_info' => new PageInfo($result['links'], $result['meta'])
            ];
        }
        return null;
    }

    /**
     * Update the existing Schedule by sending the corresponding data.
     *
     * @since 1.2.3
     *
     * @param  string   $schedule_uid Schedule ID
     * @param  array    $params
     *   string   schedule_uid - Schedule ID,
     *   int      root_member_id,
     *   string   name - Name of Schedule,
     *   string[] schedule_blacklist - An array of blacklisted dates as 'YYYY-MM-DD',
     *   int      advance_interval,
     *   int      advance_schedule_interval_days,
     *   string   schedule - Schedule as JSON string e.g. '{"enabled":true,"mode":"daily",
     *                           "daily":{"every":2}, "from":"2019-06-05","timestamp":1558538737}',
     *   string   timezone - Timezone as 'America/New_York'
     * @return Schedule
     * @throws Exception\ApiError
     */
    public function updateSchedule(string $scheduleId, array $params) : Schedule
    {
        $allBodyFields = ['root_member_id', 'name', 'schedule_blacklist',
            'advance_interval', 'advance_schedule_interval_days', 'schedule', 'timezone'];

        return $this->toSchedule(Route4Me::makeRequst([
            'url' => Endpoint::RECURRING_ROUTES_SCHEDULES . '/' . $scheduleId,
            'method' => 'PUT',
            'HTTPHEADER' => 'Content-Type: application/json',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params)
        ]));
    }

    /**
     * Delete the specified Schedule with the option to delete the associated route.
     *
     * @since 1.2.3
     *
     * @param  string $schedule_uid Schedule ID
     * @param  bool   $withRoutes Delete the Schedule that matches the specified Schedule ID.
     *                            If the deleted Schedule has one or multiple associated Routes,
     *                            these Routes are also deleted.
     * @return Schedule
     * @throws Exception\ApiError
     */
    public function deleteSchedule(string $scheduleId, bool $withRoutes = false) : Schedule
    {
        return $this->toSchedule(Route4Me::makeRequst([
            'url' => Endpoint::RECURRING_ROUTES_SCHEDULES . '/' . $scheduleId,
            'method' => 'DELETE',
            'query' => ['with_routes' => $withRoutes]
        ]));
    }

    /**
     * Create a new Route Schedule by sending the corresponding data.
     *
     * @since 1.2.3
     *
     * @param  array  $params
     *   string route_id - Route ID,
     *   string schedule_uid - Schedule ID,
     *   int    member_id - A unique ID of the root member,
     *   string vehicle_id - Vehicle ID
     * @return RouteSchedule
     * @throws Exception\ApiError
     */
    public function createRouteSchedule(array $params) : RouteSchedule
    {
        $allBodyFields = ['route_id', 'schedule_uid', 'member_id', 'vehicle_id'];

        return $this->toRouteSchedule(Route4Me::makeRequst([
            'url' => Endpoint::RECURRING_ROUTES_ROUTE_SCHEDULES,
            'method' => 'POST',
            'HTTPHEADER' => 'Content-Type: application/json',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params)
        ]));
    }

    /**
     * Get the Route Schedule by specifying the Route ID.
     *
     * @since 1.2.3
     *
     * @param  string $routeId Route ID.
     * @return RouteSchedule
     * @throws Exception\ApiError
     */
    public function getRouteSchedule(string $route_id) : RouteSchedule
    {
        return $this->toRouteSchedule(Route4Me::makeRequst([
            'url' => Endpoint::RECURRING_ROUTES_ROUTE_SCHEDULES . '/' . $route_id,
            'method' => 'GET'
        ]));
    }

    /**
     * Get the list of all Route Schedules.
     *
     * @since 1.2.3
     *
     * @return RouteSchedule[]
     * @throws Exception\ApiError
     */
    public function getAllRouteSchedules() : array
    {
        $result = Route4Me::makeRequst([
            'url' => Endpoint::RECURRING_ROUTES_ROUTE_SCHEDULES,
            'method' => 'GET'
        ]);

        if (is_array($result) && isset($result['data'])) {
            $data = $result['data'];
            if (is_array($data) && isset($data[0]) && is_array($data[0])) {
                $arr = [];
                foreach ($data as $key => $value) {
                    array_push($arr, new RouteSchedule($value));
                }
                return $arr;
            }
        }
        return null;
    }

    /**
     * Get paginated list of Route Schedules.
     *
     * @since 1.2.3
     *
     * @param  int $page Requested page.
     * @param  int $per_page Number of Route Schedules per page.
     * @return array
     * @throws Exception\ApiError
     */
    public function getRouteSchedules(int $page = 1, int $per_page = 15) : array
    {
        $result = Route4Me::makeRequst([
            'url' =>    Endpoint::RECURRING_ROUTES_ROUTE_SCHEDULES_PAGINATION,
            'method' => 'GET',
            'query' => [
                'with_pagination' => true,
                'page' => $page,
                'per_page' => $per_page
            ]
        ]);

        if (is_array($result) && isset($result['data'])) {
            $data = $result['data'];
            $route_schedules = [];
            if (is_array($data) && isset($data[0]) && is_array($data[0])) {
                foreach ($data as $key => $value) {
                    array_push($route_schedules, new RouteSchedule($value));
                }
            }
            return [
                'route_schedules' => $route_schedules,
                'page_info' => new PageInfo($result['links'], $result['meta'])
            ];
        }
        return null;
    }

    /**
     * Update the existing Route Schedule by sending the corresponding data.
     *
     * @since 1.2.3
     *
     * @param  string $route_id Route ID
     * @param  array  $params
     *   string schedule_uid - Schedule ID,
     *   int    member_id - A unique ID of the root member,
     *   string vehicle_id - Vehicle ID
     * @return RouteSchedule
     * @throws Exception\ApiError
     */
    public function updateRouteSchedule(string $route_id, array $params) : RouteSchedule
    {
        $allBodyFields = ['schedule_uid', 'member_id', 'vehicle_id'];

        return $this->toRouteSchedule(Route4Me::makeRequst([
            'url' => Endpoint::RECURRING_ROUTES_ROUTE_SCHEDULES . '/' . $route_id,
            'method' => 'PUT',
            'HTTPHEADER' => 'Content-Type: application/json',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params)
        ]));
    }

    /**
     * Delete the Route Schedules.
     *
     * @since 1.2.3
     *
     * @param  string $route_id Route ID
     * @return bool
     * @throws Exception\ApiError
     */
    public function deleteRouteSchedules(string $route_id) : bool
    {
        $result = Route4Me::makeRequst([
            'url' => Endpoint::RECURRING_ROUTES_ROUTE_SCHEDULES . '/' . $route_id,
            'method' => 'DELETE'
        ]);
        return (isset($result['status']) ? $result['status'] : false);
    }

    /**
     * Delete the specified Route Schedule.
     *
     * @since 1.2.3
     *
     * @param  string $route_id Route ID
     * @return RouteSchedule
     * @throws Exception\ApiError
     */
    public function deleteRouteSchedule(string $route_id) : RouteSchedule
    {
        return $this->toRouteSchedule(Route4Me::makeRequst([
            'url' => Endpoint::RECURRING_ROUTES_ROUTE_SCHEDULES . '/' . $route_id  . '/items',
            'method' => 'DELETE'
        ]));
    }

    /**
     * Replace the existing Route Schedule by sending the corresponding data.
     *
     * @since 1.2.3
     *
     * @param  string   $route_id Route ID.
     * @param  array    $params
     *   int      member_id - A unique ID of the root member,
     *   string   vehicle_id - Vehicle ID,
     *   string   schedule_uid - Schedule ID,
     *   string   name,
     *   string[] schedule_blacklist - Blacklisted dates as YYYY-MM-DD,
     *   int      advance_interval,
     *   int      advance_schedule_interval_days,
     *   string   schedule - Schedule as JSON string e.g. '{"enabled":true,"mode":"daily",
     *                           "daily":{"every":2}, "from":"2019-06-05","timestamp":1558538737}',
     *   string   timezone - Timezone as 'America/New_York'
     * @return RouteSchedule
     * @throws Exception\ApiError
     */
    public function replaceRouteSchedule(string $route_id, array $params)
    {
        $allBodyFields = ['member_id', 'vehicle_id', 'schedule_uid', 'name', 'schedule_blacklist',
            'advance_interval', 'advance_schedule_interval_days', 'schedule', 'timezone'];

        return $this->toRouteSchedule(Route4Me::makeRequst([
            'url' => Endpoint::RECURRING_ROUTES_ROUTE_SCHEDULES_REPLACE . '/' . $route_id,
            'method' => 'PUT',
            'HTTPHEADER' => 'Content-Type: application/json',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params)
        ]));
    }

    /**
     * Get the Route Schedule preview by specifying the 'route_id'.
     *
     * @since 1.2.3
     *
     * @param  string $routeId Route ID.
     * @param  string $start Start date as 'YYYY-MM-DD'
     * @param  string $end End date as 'YYYY-MM-DD'
     * @return array
     * @throws Exception\ApiError
     */
    public function getRouteSchedulePreview(string $route_id, string $start, string $end) : array
    {
        return Route4Me::makeRequst([
            'url' => Endpoint::RECURRING_ROUTES_ROUTE_SCHEDULES . '/' . $route_id . '/preview',
            'method' => 'GET',
            'query' => ['start' => $start, 'end' => $end]
        ]);
    }

    /**
     * Check if the Scheduled Route was copied by specifying the 'route_id'.
     *
     * @since 1.2.3
     *
     * @param  string $routeId Route ID.
     * @return bool
     * @throws Exception\ApiError
     */
    public function isScheduledRouteCopy(string $route_id) : bool
    {
        $result = Route4Me::makeRequst([
            'url' => Endpoint::RECURRING_ROUTES_SCHEDULED_ROUTES_IS_COPY . '/' . $route_id,
            'method' => 'GET'
        ]);
        return (isset($result['status']) ? $result['status'] : false);
    }

    /**
     * Get all routes copied from the specified Scheduled Route by sending
     * the corresponding data.
     *
     * @since 1.2.3
     *
     * @param  string   $route_id Route ID.
     * @param  string   $schedule_uid Schedule ID.
     * @param  string   $route_date Route date as 'YYYY-MM-DD'.
     * @return array
     * @throws Exception\ApiError
     */
    public function getScheduledRoutesCopies(string $route_id, string $schedule_uid, string $route_date) : array
    {
        return Route4Me::makeRequst([
            'url' => Endpoint::RECURRING_ROUTES_SCHEDULED_ROUTES_GET_COPIES,
            'method' => 'POST',
            'HTTPHEADER' => 'Content-Type: application/json',
            'body' => [
                'route_id' => $route_id,
                'schedule_uid' => $schedule_uid,
                'route_date' => $route_date
            ]
        ]);
    }

    /**
     * Create a new Master Route by sending the corresponding data.
     *
     * @since 1.2.3
     *
     * @param  array    $params
     *   string   route_id - Route ID,
     *   string   route_name,
     *   int      member_id - A unique ID of the root member,
     *   string   vehicle_id - Vehicle ID,
     *   string   schedule_uid - Schedule ID,
     *   string   name,
     *   string[] schedule_blacklist - Blacklisted dates as YYYY-MM-DD,
     *   int      advance_interval,
     *   int      advance_schedule_interval_days,
     *   string   schedule - Schedule as JSON string e.g. '{"enabled":true,"mode":"daily",
     *                           "daily":{"every":2}, "from":"2019-06-05","timestamp":1558538737}',
     *   bool     sync - Type of result, synchronous or not
     *   string   timezone - Timezone as 'America/New_York'
     * @return bool
     * @throws Exception\ApiError
     */
    public function createMasterRoute(array $params) : bool
    {
        $allBodyFields = ['route_id', 'route_name', 'member_id', 'schedule_uid', 'vehicle_id', 'name',
            'schedule_blacklist', 'advance_schedule_interval_days', 'schedule', 'timezone', 'sync'];

        $result = Route4Me::makeRequst([
            'url' => Endpoint::RECURRING_ROUTES_MASTER_ROUTES,
            'method' => 'POST',
            'HTTPHEADER' => 'Content-Type: application/json',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params)
        ]);
        return (isset($result['status']) ? $result['status'] : false);
    }

    private function toSchedule($result) : Schedule
    {
        if (is_array($result) && isset($result['data'])) {
            $data = $result['data'];
            if (is_array($data) && isset($data[0]) && is_array($data[0])) {
                return new Schedule($data[0]);
            }
        }
        throw new ApiError('Can not convert result to Schedule object.');
    }

    private function toRouteSchedule($result) : RouteSchedule
    {
        if (is_array($result) && isset($result['data'])) {
            $data = $result['data'];
            if (is_array($data) && isset($data[0]) && is_array($data[0])) {
                return new RouteSchedule($data[0]);
            }
        }
        throw new ApiError('Can not convert result to RouteSchedule object.');
    }
}
