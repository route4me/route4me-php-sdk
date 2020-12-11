<?php

namespace UnitTestFiles\Test;

use Route4Me\Address;
use Route4Me\AddressBundling;
use Route4Me\Common;
use Route4Me\Constants;
use Route4Me\Enum\AlgorithmType;
use Route4Me\Enum\DeviceType;
use Route4Me\Enum\DistanceUnit;
use Route4Me\Enum\Metric;
use Route4Me\Enum\OptimizationType;
use Route4Me\Enum\AddressBundlingModes;
use Route4Me\Enum\TravelMode;
use Route4Me\OptimizationProblemParams;
use Route4Me\Route;
use Route4Me\Route4Me;
use Route4Me\OptimizationProblem;
use Route4Me\RouteParameters;
use Route4Me\ScheduleCalendarParameters;
use Route4Me\ScheduleCalendarResponse;

class RouteExampleTests extends \PHPUnit\Framework\TestCase
{
    public static $problem;

    public static $createdProblems = [];
    public static $testRoutes = [];
    public static $addresses = [];

    public static $removedOptimizationIDs = [];
    public static $removedRouteIDs = [];

    public static function setUpBeforeClass()
    {
        Route4Me::setApiKey(Constants::API_KEY);

        //region Prepae Addresses
        $addresses = [];
        $addresses[] = Address::fromArray([
            'address'           => '11497 Columbia Park Dr W, Jacksonville, FL 32258',
            'is_depot'          => true,
            'lat'               => 30.159341812134,
            'lng'               => -81.538619995117,
            'time'              => 300,
            'time_window_start' => 28800,
            'time_window_end'   => 32400,
        ]);

        $addresses[] = Address::fromArray([
            'address'           => '214 Edgewater Branch Drive 32259',
            'lat'               => 30.103567123413,
            'lng'               => -81.595352172852,
            'time'              => 300,
            'time_window_start' => 36000,
            'time_window_end'   => 37200,
        ]);

        $addresses[] = Address::fromArray([
            'address'           => '756 eagle point dr 32092',
            'lat'               => 30.046422958374,
            'lng'               => -81.508758544922,
            'time'              => 300,
            'time_window_start' => 39600,
            'time_window_end'   => 41400,
        ]);

        $addresses[] = Address::fromArray([
            'address'           => '63 Stone Creek Cir St Johns, FL 32259, USA',
            'lat'               => 30.048496,
            'lng'               => -81.558716,
            'time'              => 300,
            'time_window_start' => 43200,
            'time_window_end'   => 45000,
        ]);

        $addresses[] = Address::fromArray([
            'address'           => 'St Johns Florida 32259, USA',
            'lat'               => 30.099642,
            'lng'               => -81.547201,
            'time'              => 300,
            'time_window_start' => 46800,
            'time_window_end'   => 48600,
        ]);

        $parameters = RouteParameters::fromArray([
            'device_type'           => DeviceType::IPAD,
            'disable_optimization'  => false,
            'route_name'            => 'phpunit test '.date('Y-m-d H:i'),
        ]);
        //endregion

        $optimizationParameters = new OptimizationProblemParams();
        $optimizationParameters->setAddresses($addresses);
        $optimizationParameters->setParameters($parameters);

        self::$createdProblems[] = OptimizationProblem::optimize($optimizationParameters);

        self::$testRoutes = self::$createdProblems[0]->routes;

        //region Extra Testing Addresses
        $addresses = [];
        $addresses[] = Address::fromArray([
            'address'           => '11497 Columbia Park Dr W, Jacksonville, FL 32258',
            'is_depot'          => true,
            'lat'               => 30.159341812134,
            'lng'               => -81.538619995117,
            'time'              => 300,
            'time_window_start' => 28800,
            'time_window_end'   => 32400,
        ]);

        $addresses[] = Address::fromArray([
            'address'           => '214 Edgewater Branch Drive 32259',
            'lat'               => 30.103567123413,
            'lng'               => -81.595352172852,
            'time'              => 300,
            'time_window_start' => 36000,
            'time_window_end'   => 37200,
        ]);

        $addresses[] = Address::fromArray([
            'address'           => '756 eagle point dr 32092',
            'lat'               => 30.046422958374,
            'lng'               => -81.508758544922,
            'time'              => 300,
            'time_window_start' => 39600,
            'time_window_end'   => 41400,
        ]);
        //endregion

        self::$addresses = $addresses;
    }

    public function testOptimizationWithBundledAddresses()
    {
        // Huge list of addresses
        $json = json_decode(file_get_contents(dirname(__FILE__).'\addresses.json'), true);

        $addresses = [];
        foreach ($json as $address) {
            $addresses[] = Address::fromArray($address);
        }

        $bundling = new AddressBundling();

        $bundling->mode = AddressBundlingModes\Mode::ADDRESS;
        $bundling->merge_mode = AddressBundlingModes\FirstItemMode::KEEP_ORIGINAL;
        $bundling->service_time_rules->first_item_mode = AddressBundlingModes\FirstItemMode::KEEP_ORIGINAL;
        $bundling->service_time_rules->additional_items_mode = AddressBundlingModes\AdditionalItemsMode::KEEP_ORIGINAL;

        $parameters = RouteParameters::fromArray([
            'algorithm_type' => Algorithmtype::TSP,
            'route_name' => 'Single Driver Multiple TimeWindows 50 Stops',
            'route_date' => time() + 24 * 60 * 60,
            'route_time' => 5 * 3600 + 30 * 60,
            'distance_unit' => DistanceUnit::MILES,
            'device_type' => DeviceType::WEB,
            'optimize' => OptimizationType::DISTANCE,
            'metric' => Metric::GEODESIC,
            'bundling' => $bundling,
        ]);

        $optimizationParams = new OptimizationProblemParams();
        $optimizationParams->setAddresses($addresses);
        $optimizationParams->setParameters($parameters);

        $problem = OptimizationProblem::optimize($optimizationParams);

        self::$createdProblems[] = $problem;

        $this->assertNotNull($problem);
        $this->assertInstanceOf('Route4Me\OptimizationProblem', $problem);
        $this->assertNotNull($problem->getOptimizationId());
        $this->assertNotNull($problem->getRoutes());
    }

    public function testGetScheduleCalendar()
    {
        $now            = new \DateTime();

        $schedCalendarParams = new ScheduleCalendarParameters();

        $schedCalendarParams->date_from_string   = $now
            ->add(\DateInterval::createFromDateString('-5 days'))
            ->format('Y-m-d');
        $schedCalendarParams->date_to_string     = $now
            ->add(\DateInterval::createFromDateString('5 days'))
            ->format('Y-m-d');
        $schedCalendarParams->orders             = true;
        $schedCalendarParams->ab                 = true;
        $schedCalendarParams->routes_count       = true;

        $scheduleCalendar = ScheduleCalendarResponse::fromArray(
            $schedCalendarParams->getScheduleCalendar($schedCalendarParams)
        );

        $this->assertNotNull($scheduleCalendar);
        $this->assertInstanceOf('Route4Me\ScheduleCalendarResponse', $scheduleCalendar);
    }

    public function testMergeRoutes()
    {
        $route = new Route();

        $routeIDs = [self::$testRoutes[0]->route_id];

        $routeDuplicate = $route->duplicateRoute($routeIDs);

        $this->assertTrue(isset($routeDuplicate['status']), "Cannot created duplicate route");
        $this->assertTrue($routeDuplicate['status'], "Cannot created duplicate route");

        $duplicatedRouteId = $routeDuplicate['route_ids'][0];

        self::$removedRouteIDs[] = $duplicatedRouteId;

        $depot = self::$testRoutes[0]->addresses[0];

        // Merge the selected routes
        $params = [
            'route_ids' => $routeIDs[0].','.$duplicatedRouteId,
            'depot_address' => $depot->address,
            'remove_origin' => false,
            'depot_lat' => $depot->lat,
            'depot_lng' => $depot->lng,
        ];

        $result = $route->mergeRoutes($params);

        $this->assertNotNull($result);
        $this->assertTrue(isset($result['status']), "Cannot merge the routes");
        $this->assertTrue($result['status'], "Cannot merge the routes");
        $this->assertTrue(isset($result['optimization_problem_id']), "Cannot merge the routes");
        $this->assertEquals(32,strlen($result['optimization_problem_id']), "Cannot merge the routes");

        self::$removedOptimizationIDs[] = $result['optimization_problem_id'];
    }

    public function testMultipleDepotMultipleDriverFineTuning()
    {
        // Huge list of addresses
        $json = $json = json_decode(file_get_contents(dirname(__FILE__).'\addresses_md_tw.json'), true);
        $json = array_slice($json, 0, 19);

        $addresses = [];

        foreach ($json as $address) {
            $addresses[] = Address::fromArray($address);
        }

        //region Optimization With Duration Priority FineTuning
        $parameters = RouteParameters::fromArray([
            'route_name'        => 'Optimization With Duration Priority FineTuning. '.date('Y-m-d H:i'),
            'algorithm_type'            => AlgorithmType::CVRP_TW_SD,
            'route_time'                => 23200,
            'optimize'                  => OptimizationType::TIME,
            'device_type'               => DeviceType::WEB,
            'udu_distance_unit'         => 'km',
            'route_max_duration'        => 86400,
            'travel_mode'               => TravelMode::DRIVING,
            'vehicle_capacity'          => 30,
            'vehicle_max_distance_mi'   => 10000,
            'rt'                        => true,
            'target_duration'           => 100,
            'target_distance'           => 0,
            'target_wait_by_tail_size'  => 0

        ]);

        $optimizationParams = new OptimizationProblemParams();
        $optimizationParams->setAddresses($addresses);
        $optimizationParams->setParameters($parameters);

        $problems = OptimizationProblem::optimize($optimizationParams);
        $this->assertTrue(!is_null($problems), "Cannot generate an optimization with duration priority fine-tuning");

        self::$createdProblems[] = $problems;

        $routes=$problems->getRoutes();
        $this->assertTrue(sizeof($routes)==2, "The generated optimization hasn't two routes");

        $totalTripDistanceByDuration = $routes[0]->trip_distance + $routes[1]->trip_distance;
        $totalTripDurationByDuration = $routes[0]->route_duration_sec + $routes[1]->route_duration_sec;
        $totalTripWaitingTimeByDuration = $routes[0]->total_wait_time + $routes[1]->total_wait_time;

        echo "Generated an optimization with the <b>duration</b> priority fine-tuning:<br>";
        echo "   Total Trip Distance:     $totalTripDistanceByDuration <br>";
        echo "   Total Trip Duration:     $totalTripDurationByDuration <br>";
        echo "   Total Trip Waiting Time: $totalTripWaitingTimeByDuration <br><br><br>";

        //endregion

        //region Optimization With Distance Priority FineTuning
        $parameters = RouteParameters::fromArray([
            'route_name'        => 'Optimization With Distance Priority FineTuning. '.date('Y-m-d H:i'),
            'algorithm_type'            => AlgorithmType::CVRP_TW_SD,
            'route_time'                => 23200,
            'optimize'                  => OptimizationType::TIME,
            'device_type'               => DeviceType::WEB,
            'udu_distance_unit'         => 'km',
            'route_max_duration'        => 86400,
            'travel_mode'               => TravelMode::DRIVING,
            'vehicle_capacity'          => 30,
            'vehicle_max_distance_mi'   => 10000,
            'rt'                        => true,
            'target_duration'           => 0,
            'target_distance'           => 100,
            'target_wait_by_tail_size'  => 0
        ]);

        $optimizationParams = new OptimizationProblemParams();
        $optimizationParams->setAddresses($addresses);
        $optimizationParams->setParameters($parameters);

        $problems = OptimizationProblem::optimize($optimizationParams);
        $this->assertTrue(!is_null($problems), "Cannot generate an optimization with the distance priority fine-tuning");

        self::$createdProblems[]=$problems;

        $routes=$problems->getRoutes();
        $this->assertTrue(sizeof($routes)==2, "The generated optimization hasn't two routes");

        $totalTripDistanceByDistance = $routes[0]->trip_distance + $routes[1]->trip_distance;
        $totalTripDurationByDistance = $routes[0]->route_duration_sec + $routes[1]->route_duration_sec;
        $totalTripWaitingTimeByDistance = $routes[0]->total_wait_time + $routes[1]->total_wait_time;

        $this->assertTrue($totalTripDistanceByDistance>0);
        $this->assertTrue($totalTripDurationByDistance>0);
        $this->assertTrue($totalTripWaitingTimeByDistance>0);
    }

    public static function tearDownAfterClass()
    {
        if (sizeof(self::$createdProblems)>0) {
            $optimizationProblemIDs = [];

            foreach (self::$createdProblems as $problem) {
                $optimizationProblemId = $problem->optimization_problem_id;

                $optimizationProblemIDs[] = $optimizationProblemId;
            }

            if (sizeof(self::$removedOptimizationIDs)>0) {
                $optimizationProblemIDs = array_merge($optimizationProblemIDs,self::$removedOptimizationIDs);
            }

            $params = [
                'optimization_problem_ids' => $optimizationProblemIDs,
                'redirect'                 => 0,
            ];

            $problem = new OptimizationProblem();
            $result = $problem->removeOptimization($params);

            if ($result!=null && $result['status']==true) {
                echo "The test optimizations were removed <br>";
            } else {
                echo "Cannot remove the test optimizations <br>";
            }
        }

        if (sizeof(self::$removedRouteIDs)>0) {
            $route = new Route();

            $route_ids = join(',', self::$removedRouteIDs);

            $result = $route->deleteRoutes($route_ids);

            if ($result!=null && $result['deleted']==true) {
                echo "The test routes were removed <br>";
            } else {
                echo "Cannot remove the test routes <br>";
            }
        }
    }
}