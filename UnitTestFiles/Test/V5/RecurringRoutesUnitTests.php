<?php

namespace UnitTestFiles\Test;

use Route4Me\Constants;
use Route4Me\Route4Me;
use Route4Me\Route;
use Route4Me\V5\RecurringRoutes\PageInfo;
use Route4Me\V5\RecurringRoutes\RouteSchedule;
use Route4Me\V5\RecurringRoutes\Schedule;
use Route4Me\V5\RecurringRoutes\Schedules;
// use Route4Me\V5\Routes\AddonRoutesApi\Route;
use Route4Me\V5\Vehicles\DataTypes\Vehicle;

final class RecurringRoutesUnitTests extends \PHPUnit\Framework\TestCase
{
    public static ?Schedule $schedule;
    public static ?RouteSchedule $route_schedule;
    public static ?string $route_id;
    public static ?string $member_id;
    public static ?string $vehicle_id;

    public static function setUpBeforeClass() : void
    {
        Route4Me::setApiKey(Constants::API_KEY);
        self::$schedule = null;
        self::$route_schedule = null;
        self::$route_id = null;
        self::$member_id = null;
        self::$vehicle_id = null;
    }

    public function testScheduleCanBeCreateEmpty() : void
    {
        $this->assertInstanceOf(Schedule::class, new Schedule());
    }

    public function testScheduleCanBeCreateFromArray() : void
    {
        $this->assertInstanceOf(Schedule::class, new Schedule([
            'schedule_uid' => '1',
            'name' => 'The best Schedule'
        ]));
    }

    public function testRouteScheduleCanBeCreateEmpty() : void
    {
        $this->assertInstanceOf(RouteSchedule::class, new RouteSchedule());
    }

    public function testRouteScheduleCanBeCreateFromArray() : void
    {
        $this->assertInstanceOf(RouteSchedule::class, new RouteSchedule([
            'route_id' => '1',
            'schedule_uid' => '2'
        ]));
    }

    public function testPageInfoCanBeCreateEmpty() : void
    {
        $this->assertInstanceOf(PageInfo::class, new PageInfo());
    }

    public function testPageInfoCanBeCreateFromArray() : void
    {
        $this->assertInstanceOf(PageInfo::class, new PageInfo([
            'first' => 'URL_first',
            'last' => 'URL_last'
        ], [
            'current_page' => 1,
            'last_page' => 15
        ]));
    }

    public function testSchedulesCanBeCreateEmpty() : void
    {
        $this->assertInstanceOf(Schedules::class, new Schedules());
    }

    public function testCreateScheduleMustReturnScahedule() : void
    {
        $schedules = new Schedules();
        self::$schedule = $schedules->createSchedule([
            'name' => 'The bestest schedule',
            'schedule_blacklist' => [],
            'schedule' => null,
            'timezone' => 'UTC'
        ]);

        $this->assertInstanceOf(Schedule::class, self::$schedule);
        $this->assertNotNull(self::$schedule->schedule_uid);
        $this->assertEquals(self::$schedule->name, 'The bestest schedule');
    }

    public function testGetScheduleMustReturnScahedule() : void
    {
        $schedules = new Schedules();
        $schedule = $schedules->getSchedule(self::$schedule->schedule_uid);

        $this->assertInstanceOf(Schedule::class, $schedule);
        $this->assertNotNull(self::$schedule->schedule_uid);
        $this->assertEquals(self::$schedule->name, 'The bestest schedule');
    }

    public function testGetAllSchedulesMustReturnArrayOfScahedules() : void
    {
        $schedules = new Schedules();
        $result = $schedules->getAllSchedules();

        $this->assertIsArray($result);
        if (count($result) > 0) {
            $this->assertInstanceOf(Schedule::class, $result[0]);
        }
    }

    public function testGetSchedulesMustReturnOnePage() : void
    {
        $schedules = new Schedules();
        $result = $schedules->getSchedules();

        $this->assertIsArray($result);
        $this->assertArrayHasKey('schedules', $result);
        if (count($result['schedules']) > 0) {
            $this->assertInstanceOf(Schedule::class, $result['schedules'][0]);
        }
        $this->assertArrayHasKey('page_info', $result);
        $this->assertInstanceOf(PageInfo::class, $result['page_info']);
    }

    public function testUpdateScheduleMustReturnUpdatedScahedule() : void
    {
        $schedules = new Schedules();
        self::$schedule = $schedules->updateSchedule(self::$schedule->schedule_uid, [
            'name' => 'The bestest schedule 1'
        ]);

        $this->assertInstanceOf(Schedule::class, self::$schedule);
        $this->assertEquals(self::$schedule->name, 'The bestest schedule 1');
    }

    public function testCreateRouteScheduleMustReturnRouteScahedule() : void
    {
        $route = new Route;
        $routes = $route->getRoutes([
            'limit' => 1,
            'offset' => 0
        ]);
    
        if (is_array($routes) && isset($routes[0])) {
            self::$route_id = $routes[0]->route_id;
            self::$member_id = $routes[0]->member_id;
        }
        $route = null;

        $this->assertNotNull(self::$route_id);
    
        $schedules = new Schedules();
        self::$route_schedule = $schedules->createRouteSchedule([
            'route_id' => self::$route_id,
            'schedule_uid' => self::$schedule->schedule_uid
        ]);

        $this->assertInstanceOf(RouteSchedule::class, self::$route_schedule);
        $this->assertNotNull(self::$route_schedule->schedule_uid);
        $this->assertEquals(self::$route_schedule->schedule_uid, self::$schedule->schedule_uid);
    }

    public function testGetRouteScheduleMustReturnRouteScahedule() : void
    {
        $schedules = new Schedules();
        $route_schedule = $schedules->getRouteSchedule(self::$route_id);

        $this->assertInstanceOf(RouteSchedule::class, $route_schedule);
        $this->assertNotNull($route_schedule->schedule_uid);
    }

    public function testGetAllRouteSchedulesMustReturnArrayOfRouteScahedules() : void
    {
        $schedules = new Schedules();
        $result = $schedules->getAllRouteSchedules();

        $this->assertIsArray($result);
        if (count($result) > 0) {
            $this->assertInstanceOf(RouteSchedule::class, $result[0]);
        }
    }

    public function testGetRouteSchedulesMustReturnOnePage() : void
    {
        $schedules = new Schedules();
        $result = $schedules->getRouteSchedules();

        $this->assertIsArray($result);
        $this->assertArrayHasKey('route_schedules', $result);
        if (count($result['route_schedules']) > 0) {
            $this->assertInstanceOf(RouteSchedule::class, $result['route_schedules'][0]);
        }
        $this->assertArrayHasKey('page_info', $result);
        $this->assertInstanceOf(PageInfo::class, $result['page_info']);
    }

    public function testUpdateRouteScheduleMustReturnUpdatedRouteScahedule() : void
    {
        $vehicle = new Vehicle();
        $vehicles = $vehicle->getVehiclesPaginatedList([
            'with_pagination' => true,
            'page' => 1,
            'perPage' => 1
        ]);
    
        if (is_array($vehicles) && isset($vehicles[0]) && is_array($vehicles[0]) && isset($vehicles[0]['vehicle_id'])) {
            self::$vehicle_id = $vehicles[0]['vehicle_id'];
        }
        $vehicle = null;
    
        $this->assertNotNull(self::$vehicle_id);

        $schedules = new Schedules();
        self::$route_schedule = $schedules->updateRouteSchedule(self::$route_id, [
            'schedule_uid' => self::$route_schedule->schedule_uid,
            'member_id' => self::$member_id,
            'vehicle_id' => self::$vehicle_id
        ]);

        $this->assertInstanceOf(RouteSchedule::class, self::$route_schedule);
        $this->assertEquals(self::$route_schedule->member_id, self::$member_id);
    }

    public function testrReplaceRouteScheduleMustReturnRouteScahedule() : void
    {
        $schedules = new Schedules();
        self::$route_schedule = $schedules->replaceRouteSchedule(self::$route_id, [
            'schedule_uid' => self::$route_schedule->schedule_uid,
            'member_id' => self::$member_id,
            'vehicle_id' => self::$vehicle_id
        ]);

        $this->assertInstanceOf(RouteSchedule::class, self::$route_schedule);
        $this->assertEquals(self::$route_schedule->member_id, self::$member_id);
    }

    public function testGetRouteSchedulePreviewMustReturnArray() : void
    {
        $schedules = new Schedules();
        $start = '2022-01-01';
        $end = '2023-12-31';
        $result = $schedules->getRouteSchedulePreview(self::$route_id, $start, $end);

        $this->assertIsArray($result);
    }

    public function testIsScheduledRouteCopyMustReturnBool() : void
    {
        $schedules = new Schedules();
        $result = $schedules->isScheduledRouteCopy(self::$route_id);
        $this->assertIsBool($result);
    }

    public function testGetScheduledRoutesCopiesMustReturnArray() : void
    {
        $schedules = new Schedules();
        $route_date = '2023-01-01';
        $result = $schedules->getScheduledRoutesCopies(
            self::$route_id,
            self::$route_schedule->schedule_uid,
            $route_date
        );

        $this->assertIsArray($result);
    }

    public function testCreateMasterRouteMustReturnBool() : void
    {
        $schedules = new Schedules();
        $result = $schedules->createMasterRoute([
            'route_id' => self::$route_id,
            'route_name' => 'The Bestest route',
            'member_id' => self::$member_id,
            'vehicle_id' => self::$vehicle_id,
            'name' => 'The bestest schedule',
            'schedule_blacklist' => [],
            'schedule' => null,
            'timezone' => 'UTC'
        ]);

        $this->assertIsBool($result);
    }

    public function testDeleteRouteSchedulesMustReturnTrue() : void
    {
        $schedules = new Schedules();
        $result = $schedules->deleteRouteSchedules(self::$route_id);

        $this->assertTrue($result);
        self::$route_schedule = null;
    }

    public function testDeleteScheduleMustReturnDeletedScahedule() : void
    {
        $schedules = new Schedules();
        self::$schedule = $schedules->deleteSchedule(self::$schedule->schedule_uid);

        $this->assertInstanceOf(Schedule::class, self::$schedule);
        self::$schedule = null;
    }

    public function testDeleteRouteScheduleMustReturnDeletedRouteScahedule() : void
    {
        $schedules = new Schedules();
        self::$schedule = $schedules->createSchedule([
            'name' => 'The bestest schedule',
            'schedule_blacklist' => [],
            'schedule' => null,
            'timezone' => 'UTC'
        ]);

        self::$route_schedule = $schedules->createRouteSchedule([
            'route_id' => self::$route_id,
            'schedule_uid' => self::$schedule->schedule_uid
        ]);

        $res_route_schedule = $schedules->deleteRouteSchedule(self::$route_schedule->route_id);

        $this->assertInstanceOf(RouteSchedule::class, $res_route_schedule);

        self::$schedule = null;
        self::$route_schedule = null;
    }

    public static function tearDownAfterClass() : void
    {
        if (!is_null(self::$schedule)) {
            $schedules = new Schedules();
            $result = $schedules->deleteSchedule(self::$schedule->schedule_uid);
            self::assertInstanceOf(Schedule::class, $result);
        }
        if (!is_null(self::$route_schedule)) {
            $schedules = new Schedules();
            $result = $schedules->deleteRouteSchedule(self::$route_schedule->route_id);
            self::assertInstanceOf(RouteSchedule::class, $result);
        }
    }
}
