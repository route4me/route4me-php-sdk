<?php

namespace Route4Me;

use Route4Me\Enum\DeviceType;
use Route4Me\Enum\DistanceUnit;
use Route4Me\Enum\OptimizationType;
use Route4Me\Enum\AlgorithmType;
use Route4Me\Enum\TravelMode;

class OptimizationProblemTest extends \PHPUnit_Framework_TestCase
{
    public static $addresses = [];

    public static function setUpBeforeClass()
    {
        $addresses = [];
        $addresses[] = Address::fromArray([
          'address' => '11497 Columbia Park Dr W, Jacksonville, FL 32258',
          'is_depot' => true,
          'lat' => 30.159341812134,
          'lng' => -81.538619995117,
          'time' => 300,
          'time_window_start' => 28800,
          'time_window_end' => 32400,
        ]);

        $addresses[] = Address::fromArray([
          'address' => '214 Edgewater Branch Drive 32259',
          'lat' => 30.103567123413,
          'lng' => -81.595352172852,
          'time' => 300,
          'time_window_start' => 36000,
          'time_window_end' => 37200,
        ]);

        $addresses[] = Address::fromArray([
            'address' => '756 eagle point dr 32092',
            'lat' => 30.046422958374,
            'lng' => -81.508758544922,
            'time' => 300,
            'time_window_start' => 39600,
            'time_window_end' => 41400,
        ]);

        self::$addresses = $addresses;
    }

    public function testOptimizationAsyncRedirect()
    {
        $parameters = RouteParameters::fromArray([
            'algorithm_type' => Algorithmtype::TSP,
            'device_type' => DeviceType::WEB,
            'distance_unit' => DistanceUnit::MILES,
            'optimize' => OptimizationType::DISTANCE,
            'route_max_duration' => 86400,
            'store_route' => true,
            'travel_mode' => TravelMode::DRIVING,
            'vehicle_capacity' => 1,
            'vehicle_max_distance_mi' => 10000,
            'route_name' => 'phpunit test',
        ]);

        $optimizationParameters = new OptimizationProblemParams();
        $optimizationParameters->setAddresses(self::$addresses);
        $optimizationParameters->setParameters($parameters);
        $optimizationParameters->redirect = false;

        $problem = OptimizationProblem::optimize($optimizationParameters);

        $this->assertNotNull($problem);
        $this->assertInstanceOf('Route4Me\OptimizationProblem', $problem);
        $this->assertNotNull($problem->getOptimizationId());
        $this->assertEmpty($problem->getRoutes());
    }

    public function testCreateSingleDriverRoute()
    {
        $parameters = RouteParameters::fromArray([
            'algorithm_type' => Algorithmtype::TSP,
            'device_type' => DeviceType::WEB,
            'distance_unit' => DistanceUnit::MILES,
            'optimize' => OptimizationType::DISTANCE,
            'route_max_duration' => 86400,
            'store_route' => true,
            'travel_mode' => TravelMode::DRIVING,
            'vehicle_capacity' => 1,
            'vehicle_max_distance_mi' => 10000,
            'route_name' => 'phpunit test',
        ]);

        $optimizationParameters = new OptimizationProblemParams();
        $optimizationParameters->setAddresses(self::$addresses);
        $optimizationParameters->setParameters($parameters);

        $problem = OptimizationProblem::optimize($optimizationParameters);

        $this->assertNotNull($problem);
        $this->assertInstanceOf('Route4Me\OptimizationProblem', $problem);
        $this->assertNotNull($problem->getOptimizationId());
        $this->assertNotNull($problem->getRoutes());
    }

    public function testCreateSingleDriverRouteWithRoundTrip()
    {
        $parameters = RouteParameters::fromArray([
            'algorithm_type' => Algorithmtype::TSP,
            'device_type' => DeviceType::WEB,
            'distance_unit' => DistanceUnit::MILES,
            'optimize' => OptimizationType::DISTANCE,
            'travel_mode' => TravelMode::DRIVING,
            'route_max_duration' => 86400,
            'store_route' => true,
            'vehicle_capacity' => 1,
            'vehicle_max_distance_mi' => 10000,
            'route_name' => 'phpunit test',
        ]);

        $optimizationParameters = new OptimizationProblemParams();
        $optimizationParameters->setAddresses(self::$addresses);
        $optimizationParameters->setParameters($parameters);

        $problem = OptimizationProblem::optimize($optimizationParameters);

        $this->assertNotNull($problem);
        $this->assertInstanceOf('Route4Me\OptimizationProblem', $problem);
        $this->assertNotNull($problem->getOptimizationId());
        $this->assertNotNull($problem->getRoutes());
    }

    public function testCreateMultipleDriverProblem()
    {
        $parameters = RouteParameters::fromArray([
            'algorithm_type' => Algorithmtype::CVRP_TW_SD,
            'device_type' => DeviceType::WEB,
            'distance_unit' => DistanceUnit::MILES,
            'optimize' => OptimizationType::DISTANCE,
            'travel_mode' => TravelMode::DRIVING,
            'rt' => true,
            'route_max_duration' => 86400,
            'store_route' => true,
            'vehicle_capacity' => 99,
            'vehicle_max_distance_mi' => 10000,
            'route_name' => 'phpunit test',
        ]);

        $optimizationParameters = new OptimizationProblemParams();
        $optimizationParameters->setAddresses(self::$addresses);
        $optimizationParameters->setParameters($parameters);

        $problem = OptimizationProblem::optimize($optimizationParameters);

        $this->assertNotNull($problem);
        $this->assertInstanceOf('Route4Me\OptimizationProblem', $problem);
        $this->assertNotNull($problem->getOptimizationId());
        $this->assertNotNull($problem->getRoutes());
    }

    public function testCreateSingleDriverWithTimeWindow()
    {
        $parameters = RouteParameters::fromArray([
            'algorithm_type' => Algorithmtype::CVRP_TW_MD,
            'device_type' => DeviceType::WEB,
            'distance_unit' => DistanceUnit::MILES,
            'optimize' => OptimizationType::DISTANCE,
            'travel_mode' => TravelMode::DRIVING,
            'rt' => true,
            'route_max_duration' => 86400,
            'store_route' => true,
            'vehicle_capacity' => 1,
            'vehicle_max_distance_mi' => 10000,
            'route_name' => 'phpunit test',
        ]);

        $optimizationParameters = new OptimizationProblemParams();
        $optimizationParameters->setAddresses(self::$addresses);
        $optimizationParameters->setParameters($parameters);

        $problem = OptimizationProblem::optimize($optimizationParameters);

        $this->assertNotNull($problem);
        $this->assertInstanceOf('Route4Me\OptimizationProblem', $problem);
        $this->assertNotNull($problem->getOptimizationId());
        $this->assertNotNull($problem->getRoutes());
    }

    public function testCreateSingleDriverProblemWithoutOptimization()
    {
        $parameters = RouteParameters::fromArray([
            'disable_optimization' => false,
            'route_name' => 'phpunit test',
        ]);

        $optimizationParameters = new OptimizationProblemParams();
        $optimizationParameters->setAddresses(self::$addresses);
        $optimizationParameters->setParameters($parameters);

        $problem = OptimizationProblem::optimize($optimizationParameters);

        $this->assertNotNull($problem);
        $this->assertInstanceOf('Route4Me\OptimizationProblem', $problem);
        $this->assertNotNull($problem->getOptimizationId());
        $this->assertNotNull($problem->getRoutes());
        $routes = $problem->getRoutes();

        $this->assertNotNull($routes[0]);
        $this->assertInstanceOf("Route4Me\Route", $routes[0]);
        $this->assertNotNull($routes[0]->getRouteId());
    }

    public function testGetProblem()
    {
        $parameters = RouteParameters::fromArray([
            'disable_optimization' => false,
            'route_name' => 'phpunit test',
        ]);

        $optimizationParameters = new OptimizationProblemParams();
        $optimizationParameters->setAddresses(self::$addresses);
        $optimizationParameters->setParameters($parameters);

        $problem = OptimizationProblem::optimize($optimizationParameters);

        $problem = OptimizationProblem::get([
            'optimization_problem_id' => $problem->getOptimizationId(),
        ]);

        $this->assertNotNull($problem);
        $this->assertNotNull($problem->getRoutes());
    }

    public function testGetThreeProblem()
    {
        $problem = OptimizationProblem::get([
            'limit' => 3,
        ]);

        $this->assertEquals(count($problem), 3);
        foreach ($problem as $p) {
            $this->assertNotNull($p);
            $this->assertNotNull($p->getRoutes());
        }
    }
}
