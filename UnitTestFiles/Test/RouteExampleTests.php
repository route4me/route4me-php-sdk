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
use Route4Me\Vehicles\Vehicle;

class RouteExampleTests extends \PHPUnit\Framework\TestCase
{
    public static $problem;

    public static $createdProblems = [];
    public static $testRoutes = [];
    public static $addresses = [];

    public static $removedOptimizationIDs = [];
    public static $removedRouteIDs = [];
    public static $removedVehicle;

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
        $json = json_decode(file_get_contents(dirname(__FILE__).'/data/addresses.json'), true);

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
            'algorithm_type'    => Algorithmtype::TSP,
            'route_name'        => 'Single Driver Multiple TimeWindows 50 Stops',
            'route_date'        => time() + 24 * 60 * 60,
            'route_time'        => 5 * 3600 + 30 * 60,
            'distance_unit'     => DistanceUnit::MILES,
            'device_type'       => DeviceType::WEB,
            'optimize'          => OptimizationType::DISTANCE,
            'metric'            => Metric::GEODESIC,
            'bundling'          => $bundling,
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
            'route_ids'     => $routeIDs[0].','.$duplicatedRouteId,
            'depot_address' => $depot->address,
            'remove_origin' => false,
            'depot_lat'     => $depot->lat,
            'depot_lng'     => $depot->lng,
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
        $json = json_decode(file_get_contents(dirname(__FILE__).'/data/addresses_md_tw.json'), true);
        $json = array_slice($json, 0, 19);

        $addresses = [];

        foreach ($json as $address) {
            $addresses[] = Address::fromArray($address);
        }

        //region Optimization With Duration Priority FineTuning
        $parameters = RouteParameters::fromArray([
            'route_name'        => 'Optimization With Duration Priority FineTuning. '.date('Y-m-d H:i'),
            'algorithm_type'            => AlgorithmType::CVRP_TW_MD,
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

    public function testMultipleDepotMultipleDriver()
    {
        // Huge list of addresses
        $json = json_decode(file_get_contents(dirname(__FILE__).'/data/addresses_md_tw.json'), true);

        $addresses = [];
        foreach ($json as $address) {
            $addresses[] = Address::fromArray($address);
        }

        $parameters = RouteParameters::fromArray([
            'algorithm_type'            => AlgorithmType::CVRP_TW_MD,
            'distance_unit'             => DistanceUnit::MILES,
            'device_type'               => DeviceType::WEB,
            'optimize'                  => OptimizationType::DISTANCE,
            'metric'                    => Metric::GEODESIC,
            'route_max_duration'        => 86400 * 2,
            'travel_mode'               => TravelMode::DRIVING,
            'vehicle_capacity'          => 50,
            'vehicle_max_distance_mi'   => 10000,
            'parts'                     => 50,
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
        $this->assertTrue(sizeof($problem->getRoutes())>1);
    }

    public function testMultipleDepotMultipleDriverTimeWindow()
    {
        $json = json_decode(file_get_contents(dirname(__FILE__).'/data/addresses_md_tw.json'), true);

        $addresses = [];

        foreach ($json as $address) {
            $addresses[] = Address::fromArray($address);
        }

        $parameters = RouteParameters::fromArray([
            'algorithm_type'            => Algorithmtype::CVRP_TW_MD,
            'route_name'                => 'Multiple Depot, Multiple Driver, Time Window',
            'route_date'                => time() + 24 * 60 * 60,
            'route_time'                => 60 * 60 * 7,
            'rt'                        => true,
            'distance_unit'             => DistanceUnit::MILES,
            'device_type'               => DeviceType::WEB,
            'optimize'                  => OptimizationType::TIME,
            'metric'                    => Metric::GEODESIC,
            'route_max_duration'        => 86400 * 3,
            'travel_mode'               => TravelMode::DRIVING,
            'vehicle_capacity'          => 99,
            'vehicle_max_distance_mi'   => 99999,
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

    public function testMultipleDepotMultipleDriverWith24StopsTimeWindow()
    {
        // Huge list of addresses
        $json = json_decode(file_get_contents(dirname(__FILE__).'/data/mdp_mdr_24stops_tw.json'), true);

        $addresses = [];
        foreach ($json as $address) {
            $addresses[] = Address::fromArray($address);
        }

        $addresses[7]->is_depot = true;

        $parameters = RouteParameters::fromArray([
            'algorithm_type'            => Algorithmtype::CVRP_TW_MD,
            'route_name'                => 'Multiple Depot, Multiple Driver with 24 Stops, Time Window',
            'route_date'                => time() + 24 * 60 * 60,
            'route_time'                => 60 * 60 * 7,
            'distance_unit'             => DistanceUnit::MILES,
            'device_type'               => DeviceType::WEB,
            'optimize'                  => OptimizationType::TIME,
            'metric'                    => Metric::MATRIX,
            'route_max_duration'        => 86400,
            'travel_mode'               => TravelMode::DRIVING,
            'vehicle_capacity'          => 5,
            'vehicle_max_distance_mi'   => 10000,
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
        $this->assertTrue(sizeof($problem->getRoutes())>1);
    }

    public function testMultipleSeparateDepostMultipleDriver()
    {
        // List of addresses
        $jsonAddresses = json_decode(file_get_contents(dirname(__FILE__).'/data/addresses_only.json'), true);

        $addresses = [];
        foreach ($jsonAddresses as $address) {
            $addresses[] = Address::fromArray($address);
        }

        $jsonDepots = json_decode(file_get_contents(dirname(__FILE__).'/data/depots.json'), true);

        // List of depots
        $depots = [];
        foreach ($jsonDepots as $depot) {
            $depots[] = Address::fromArray($depot);
        }

        $parameters = RouteParameters::fromArray([
            'route_name'                => 'Multiple Depots Seprate Section '.date('Y-m-d H:i'),
            'algorithm_type'            => AlgorithmType::CVRP_TW_MD,
            'distance_unit'             => DistanceUnit::MILES,
            'device_type'               => DeviceType::WEB,
            'optimize'                  => OptimizationType::TIME,
            'metric'                    => Metric::GEODESIC,
            'route_max_duration'        => 86400 * 2,
            'travel_mode'               => TravelMode::DRIVING,
            'vehicle_capacity'          => 50,
            'vehicle_max_distance_mi'   => 10000,
            'parts'                     => 50,
        ]);

        $optimizationParams = new OptimizationProblemParams();
        $optimizationParams->setAddresses($addresses);
        $optimizationParams->setDepots($depots);
        $optimizationParams->setParameters($parameters);

        $problem = OptimizationProblem::optimize($optimizationParams);

        self::$createdProblems[] = $problem;

        $this->assertNotNull($problem);
        $this->assertInstanceOf('Route4Me\OptimizationProblem', $problem);
        $this->assertNotNull($problem->getOptimizationId());
        $this->assertNotNull($problem->getRoutes());
    }

    public function  testOptimizationSingleDriverRoute10Stops()
    {
        // Huge list of addresses
        $json = json_decode(file_get_contents(dirname(__FILE__).'/data/addresses.json'), true);
        $json = array_slice($json, 0, 10);

        $addresses = [];
        foreach ($json as $address) {
            $addresses[] = Address::fromArray($address);
        }

        $parameters = RouteParameters::fromArray([
            'algorithm_type'            => AlgorithmType::TSP,
            'distance_unit'             => DistanceUnit::MILES,
            'device_type'               => DeviceType::WEB,
            'optimize'                  => OptimizationType::DISTANCE,
            'travel_mode'               => TravelMode::DRIVING,
            'route_max_duration'        => 86400,
            'vehicle_capacity'          => 1,
            'vehicle_max_distance_mi'   => 10000,
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

    public function testRouteSlowDown()
    {
        // Huge list of addresses
        $json = json_decode(file_get_contents(dirname(__FILE__).'/data/addresses.json'), true);
        $json = array_slice($json, 0, 10);

        $addresses = [];
        foreach ($json as $address) {
            $addresses[] = Address::fromArray($address);
        }

        $parameters = RouteParameters::fromArray([
            'algorithm_type'            => AlgorithmType::TSP,
            'distance_unit'             => DistanceUnit::MILES,
            'device_type'               => DeviceType::WEB,
            'optimize'                  => OptimizationType::DISTANCE,
            'travel_mode'               => TravelMode::DRIVING,
            'route_name'                => 'SD 10 stops slowdown route '.date('Y-m-d H:i'),
            'route_max_duration'        => 86400,
            'vehicle_capacity'          => 1,
            'vehicle_max_distance_mi'   => 10000,
            'slowdowns' =>  [
                'service_time'  => 15,
                'travel_time'   => 20
            ],
        ]);

        $optimizationParams = new OptimizationProblemParams();
        $optimizationParams->setAddresses($addresses);
        $optimizationParams->setParameters($parameters);

        $problem = OptimizationProblem::optimize($optimizationParams);

        self::$createdProblems[] = $problem;

        $this->assertNotNull($problem);
        $this->assertInstanceOf('Route4Me\OptimizationProblem', $problem);
        $this->assertNotNull($problem->getOptimizationId());
        $this->assertNotNull($problem->parameters);

        $this->assertNotNull($problem->parameters->route_time_multiplier);
        $this->assertNotNull($problem->parameters->route_service_time_multiplier);
        $this->assertEquals(15, $problem->parameters->route_service_time_multiplier);
        $this->assertEquals(20, $problem->parameters->route_time_multiplier);
    }

    public function testSingleDriverRoundTrip()
    {
        // Huge list of addresses
        $json = json_decode(file_get_contents(dirname(__FILE__).'/data/addresses.json'), true);
        $json = array_slice($json, 0, 16);

        $addresses = [];

        foreach ($json as $address) {
            $addresses[] = Address::fromArray($address);
        }

        $parameters = RouteParameters::fromArray([
            'algorithm_type'            => AlgorithmType::TSP,
            'distance_unit'             => DistanceUnit::MILES,
            'device_type'               => DeviceType::WEB,
            'optimize'                  => OptimizationType::DISTANCE,
            'travel_mode'               => TravelMode::DRIVING,
            'route_max_duration'        => 86400,
            'vehicle_capacity'          => 1,
            'vehicle_max_distance_mi'   => 10000,
            'rt' => true,
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
        $this->assertNotNull($problem->addresses);

        $firstAddress = $problem->routes[0]->addresses[0];
        $lastAddress = $problem->routes[0]->addresses[sizeof($problem->routes[0]->addresses)-1];

        $this->assertEquals($firstAddress->route_destination_id, $lastAddress->route_destination_id);
    }

    public function testSingleDepotMultipleDriverNoTimeWindow()
    {
        // Huge list of addresses
        $json = json_decode(file_get_contents(dirname(__FILE__).'/data/addresses.json'), true);

        $addresses = [];
        foreach ($json as $address) {
            $addresses[] = Address::fromArray($address);
        }

        $parameters = RouteParameters::fromArray([
            'algorithm_type'            => Algorithmtype::CVRP_TW_SD,
            'route_name'                => 'Single Depot, Multiple Driver, No Time Window',
            'route_date'                => time() + 24 * 60 * 60,
            'route_time'                => 60 * 60 * 7,
            'rt'                        => true,
            'distance_unit'             => DistanceUnit::MILES,
            'device_type'               => DeviceType::WEB,
            'optimize'                  => OptimizationType::TIME,
            'metric'                    => Metric::GEODESIC,
            'route_max_duration'        => 86400,
            'travel_mode'               => TravelMode::DRIVING,
            'vehicle_capacity'          => 20,
            'vehicle_max_distance_mi'   => 99999,
            'parts'                     => 4,
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

        $this->assertNotNull(sizeof($problem->routes)>1);
    }

    public function testSingleDriverMultipleTimeWindows()
    {
        // Huge list of addresses
        $json = json_decode(file_get_contents(dirname(__FILE__).'/data/mdp_mdr_24stops_tw.json'), true);
        $json = array_slice($json, 0, 20);

        $addresses = [];
        foreach ($json as $address) {
            $addresses[] = Address::fromArray($address);
        }

        $parameters = RouteParameters::fromArray([
            'algorithm_type'    => Algorithmtype::TSP,
            'route_name'        => 'Single Driver Multiple TimeWindows 20 Stops '.date('Y-m-d H:i'),
            'route_date'        => time() + 24 * 60 * 60,
            'route_time'        => 5 * 3600 + 30 * 60,
            'distance_unit'     => DistanceUnit::MILES,
            'device_type'       => DeviceType::WEB,
            'optimize'          => OptimizationType::TIME,
            'metric'            => Metric::MATRIX,
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

        $this->assertNotNull(sizeof($problem->routes)>1);
    }

    public function testTruckingSingleDriverMultipleTimeWindows()
    {
        #region Create Medium Truck

        $vehicle = new Vehicle();

        $vehicleParameters = Vehicle::fromArray([
            'vehicle_name'                      => 'GMC TopKick C5500 Medium',
            'vehicle_alias'                     => 'GMC TopKick C5500 Medium',
            'vehicle_vin'                       => 'SAJXA01A06FN08012',
            'vehicle_license_plate'             => 'CVH4561',
            'vehicle_model'                     => 'TopKick C5500',
            'vehicle_model_year'                => 1995,
            'vehicle_year_acquired'             => 2008,
            'vehicle_reg_country_id'            => '223',
            'vehicle_make'                      => 'GMC',
            'vehicle_type_id'                   => 'pickup_truck',
            'vehicle_axle_count'                => 2,
            'mpg_city'                          => 7,
            'mpg_highway'                       => 14,
            'fuel_type'                         => 'diesel',
            'height_inches'                     => 97,
            'height_metric'                     => 243,
            'weight_lb'                         => 19000,
            'maxWeightPerAxleGroupInPounds'     => 9500,
            'max_weight_per_axle_group_metric'  => 4300,
            'widthInInches'                     => 96,
            'width_metric'                      => 240,
            'lengthInInches'                    => 244,
            'length_metric'                     => 610,
            'Use53FootTrailerRouting'           => 'YES',
            'UseTruckRestrictions'              => 'YES',
            'DividedHighwayAvoidPreference'     => 'NEUTRAL',
            'FreewayAvoidPreference'            => 'NEUTRAL',
            'truck_config'                      => 'FULLSIZEVAN',
        ]);

        $result = $vehicle->createVehicle($vehicleParameters);

        $this->assertNotNull($result);
        $this->assertTrue(isset($result['status']));
        $this->assertTrue($result['status']);
        $this->assertTrue(isset($result['vehicle_guid']));
        $vehicleId = $result['vehicle_guid'];

        self::$removedVehicle = $vehicleId;

        #endregion
        // Huge list of addresses
        $json = json_decode(file_get_contents(dirname(__FILE__).'/data/mdp_mdr_24stops_tw.json'), true);
        $json = array_slice($json, 0, 18);

        $addresses = [];
        foreach ($json as $address) {
            $addresses[] = Address::fromArray($address);
        }

        $parameters = RouteParameters::fromArray([
            'algorithm_type'            => Algorithmtype::CVRP_TW_SD,
            'route_name'                => 'Trucking SD Multiple TW 18 Stops '.date('Y-m-d H:i'),
            'route_date'                => time() + 24 * 60 * 60,
            'route_time'                => 5 * 3600 + 30 * 60,
            'distance_unit'             => DistanceUnit::MILES,
            'device_type'               => DeviceType::WEB,
            'optimize'                  => OptimizationType::TIME_WITH_TRAFFIC,
            'metric'                    => Metric::MATRIX,
            'route_max_duration'        => 8 * 3600 + 30 * 60,
            'vehicle_id'                => $vehicleId,
            'travel_mode'               => TravelMode::DRIVING,
            'vehicle_max_cargo_weight'  => 30,
            'vehicle_capacity'          => 10,
            'vehicle_max_distance_mi'   => 10000,
            'trailer_weight_t'          => 10,
            'weight_per_axle_t'         => 10,
            'limited_weight_t'          => 20,
            'rt'                        => true
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

        $this->assertNotNull(sizeof($problem->routes)>1);
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

        if (!is_null(self::$removedVehicle!=null) && strlen(self::$removedVehicle)==32) {

            $vehicle = new Vehicle();

            $vehicleParameters = Vehicle::fromArray([
                'vehicle_id' => self::$removedVehicle,
            ]);

             $result = $vehicle->removeVehicle($vehicleParameters);

            if (!is_null($result)) {
                echo "The vehicle ".$result['vehicle_id']." removed <br>";
            } else {
                echo "Cannot remove the vehicle ".$vehicle['vehicle_id']."<br>";
            }

        }
    }
}