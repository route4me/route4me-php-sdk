<?php

namespace UnitTestFiles\Test\V5;

use Route4Me\V5\Addresses\Address as Address;
use Route4Me\Constants as Constants;
use Route4Me\V5\Enum\AlgorithmType as AlgorithmType;
use Route4Me\V5\Enum\DeviceType as DeviceType;
use Route4Me\V5\Enum\DistanceUnit as DistanceUnit;
use Route4Me\V5\Enum\Metric as Metric;
use Route4Me\V5\Enum\OptimizationType as OptimizationType;
use Route4Me\V5\Enum\TravelMode as TravelMode;
use Route4Me\V5\OptimizationProblem as OptimizationProblem;
use Route4Me\V5\OptimizationProblemParams as OptimizationProblemParams;
use Route4Me\V5\Routes\AddonRoutesApi\ApiCapabilities;
use Route4Me\V5\Routes\AddonRoutesApi\ApiPreferences;
use Route4Me\V5\Routes\AddonRoutesApi\Route as Route;
use Route4Me\Route4Me as Route4Me;
use Route4Me\V5\Routes\AddonRoutesApi\RouteDataTableConfigResponse;
use Route4Me\V5\Routes\AddonRoutesApi\RouteDuplicateResponse;
use Route4Me\V5\Routes\AddonRoutesApi\RoutesDeleteResponse;
use Route4Me\V5\Routes\RouteParameters as RouteParameters;
use Route4Me\V5\Routes\AddonRoutesApi\RouteParametersQuery as RouteParametersQuery;
use Route4Me\Vehicles\DataType\Vehicle as Vehicle;
use Route4Me\V5\Routes\AddonRoutesApi\RouteFilterParameters as RouteFilterParameters;
use Route4Me\V5\Routes\AddonRoutesApi\RouteFilterParametersFilters as RouteFilterParametersFilters;

class RouteTests extends \PHPUnit\Framework\TestCase
{
    public static $createdProblems = [];
    public static $testRoutes = [];
    public static $addresses = [];

    public static $removedOptimizationIDs = [];
    public static $removedRouteIDs = [];

    public static function setUpBeforeClass()
    {
        Route4Me::setApiKey(Constants::API_KEY);

        //region -- Prepae Addresses --
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
        //endregion

        $optimizationParameters = new OptimizationProblemParams();
        $optimizationParameters->setAddresses($addresses);
        $optimizationParameters->setParameters($parameters);

        self::$createdProblems[] = OptimizationProblem::optimize($optimizationParameters);

        self::$testRoutes = self::$createdProblems[0]->routes;

        //region -- Extra Testing Addresses --
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

    public function testFromArray()
    {
        //region -- Prepare Addresses --

        $addresses = [];
        $addresses[] = [
            'address'           => '11497 Columbia Park Dr W, Jacksonville, FL 32258',
            'is_depot'          => true,
            'lat'               => 30.159341812134,
            'lng'               => -81.538619995117,
            'time'              => 300,
            'time_window_start' => 28800,
            'time_window_end'   => 32400,
        ];

        $addresses[] = [
            'address'           => '214 Edgewater Branch Drive 32259',
            'lat'               => 30.103567123413,
            'lng'               => -81.595352172852,
            'time'              => 300,
            'time_window_start' => 36000,
            'time_window_end'   => 37200,
        ];

        $addresses[] = [
            'address'           => '756 eagle point dr 32092',
            'lat'               => 30.046422958374,
            'lng'               => -81.508758544922,
            'time'              => 300,
            'time_window_start' => 39600,
            'time_window_end'   => 41400,
        ];

        $addresses[] = [
            'address'           => '63 Stone Creek Cir St Johns, FL 32259, USA',
            'lat'               => 30.048496,
            'lng'               => -81.558716,
            'time'              => 300,
            'time_window_start' => 43200,
            'time_window_end'   => 45000,
        ];

        $addresses[] = [
            'address'           => 'St Johns Florida 32259, USA',
            'lat'               => 30.099642,
            'lng'               => -81.547201,
            'time'              => 300,
            'time_window_start' => 46800,
            'time_window_end'   => 48600,
        ];

        //endregion

        $parameters = [
            'device_type'           => DeviceType::IPAD,
            'disable_optimization'  => false,
            'route_name'            => 'phpunit test '.date('Y-m-d H:i'),
        ];

        $routeParameters = Route::fromArray([
            'parameters'    => $parameters,
            'addresses'     => $addresses
        ]);

        $this->assertEquals(RouteParameters::fromArray($parameters), $routeParameters->parameters);
    }

    public function testGetRoutes()
    {
        $params = new RouteParametersQuery();

        $params->limit = 10;
        $params->offset = 0;

        $route = new Route();

        $routeResults = $route->getRoutes($params->toArray());

        $this->assertNotNull($routeResults);
        $this->assertTrue(is_array($routeResults));
        $this->assertTrue(sizeof($routeResults)>0);
        $this->assertInstanceOf(Route::class, Route::fromArray($routeResults));
    }

    public function testGetAllRoutesWithPagination()
    {
        $params = new RouteParametersQuery();

        $params->page = 1;
        $params->per_page = 10;

        $route = new Route();

        $routeResults = $route->getAllRoutesWithPagination($params->toArray());

        $this->assertNotNull($routeResults);
        $this->assertTrue(is_array($routeResults));
        $this->assertTrue(sizeof($routeResults)>0);
        $this->assertInstanceOf(Route::class, Route::fromArray($routeResults));
    }

    public function testGetPaginatedRouteListWithoutElasticSearch()
    {
        $params = new RouteParametersQuery();

        $params->page = 1;
        $params->per_page = 10;

        $route = new Route();

        $routeResults = $route->getPaginatedRouteListWithoutElasticSearch($params->toArray());

        $this->assertNotNull($routeResults);
        $this->assertTrue(is_array($routeResults));
        $this->assertTrue(sizeof($routeResults)>0);
        $this->assertInstanceOf(Route::class, Route::fromArray($routeResults));
    }

    public function testGetRouteDataTableWithoutElasticSearch()
    {
        $scheduleFilter = new RouteFilterParametersFilters();

        $scheduleFilter->schedule_date = [
            date('Y-m-d', strtotime('-2 days')),
            date('Y-m-d', strtotime('-3 days')),
            date('Y-m-d', strtotime('-4 days'))
        ];

        $filterParams = new RouteFilterParameters();
        $filterParams->page = 1;
        $filterParams->per_page = 20;
        $filterParams->filters = $scheduleFilter;
        $filterParams->order_by = [["route_created_unix", "desc"]];
        $filterParams->timezone = "UTC";

        $route = new Route();

        $routeResults = $route->getRouteDataTableWithoutElasticSearch($filterParams->toArray());

        $this->assertNotNull($routeResults);
        $this->assertTrue(is_array($routeResults));
        $this->assertTrue(sizeof($routeResults)>0);
        $this->assertInstanceOf(Route::class, Route::fromArray($routeResults));
    }

    public function testGetRouteDatatableWithElasticSearch()
    {
        $scheduleFilter = new RouteFilterParametersFilters();

        $scheduleFilter->schedule_date = [
            date('Y-m-d', strtotime('-1 days')),
            date('Y-m-d', strtotime('-2 days')),
            date('Y-m-d', strtotime('-3 days'))
        ];

        $filterParams = new RouteFilterParameters();
        $filterParams->page = 1;
        $filterParams->per_page = 20;
        $filterParams->filters = $scheduleFilter;
        $filterParams->order_by = [["route_created_unix", "desc"]];
        $filterParams->timezone = "UTC";

        $route = new Route();

        $routeResults = $route->getRouteDataTableWithElasticSearch($filterParams->toArray());

        $this->assertNotNull($routeResults);
        $this->assertTrue(is_array($routeResults));
        $this->assertTrue(sizeof($routeResults)>0);
        $this->assertInstanceOf(Route::class, Route::fromArray($routeResults));
    }

    public function testGetRouteListWithoutElasticSearch()
    {
        $params = new RouteParametersQuery();

        $params->limit = 10;
        $params->offset = 0;

        $route = new Route();

        $routeResults = $route->getRouteListWithoutElasticSearch($params->toArray());

        $this->assertNotNull($routeResults);
        $this->assertTrue(is_array($routeResults));
        $this->assertTrue(sizeof($routeResults)>0);
        $this->assertInstanceOf(Route::class, Route::fromArray($routeResults));
    }

    public function testDuplicateRoutes()
    {
        $routeIDs = [
            self::$testRoutes[sizeof(self::$testRoutes) - 1]->route_id
        ];

        $route = new Route();

        $result = $route->duplicateRoute($routeIDs);

        $this->assertNotNull($result);
        $this->assertInstanceOf(RouteDuplicateResponse::class, RouteDuplicateResponse::fromArray( $result));
        $this->assertTrue($result['status']);
    }

    public function testGetRouteDataTableConfig()
    {
        $route = new Route();

        $result = $route->getRouteDataTableConfig();

        $this->assertNotNull($result);
        $this->assertInstanceOf(  RouteDataTableConfigResponse::class, RouteDataTableConfigResponse::fromArray( $result));
        $this->assertInstanceOf(  ApiCapabilities::class, ApiCapabilities::fromArray( $result['api_capabilities']));
        $this->assertInstanceOf(  ApiPreferences::class, ApiPreferences::fromArray( $result['api_preferences']));
    }

    public function testRouteDataTableFallbackConfig()
    {
        $route = new Route();

        $result = $route->getRouteDataTableFallbackConfig();

        $this->assertNotNull($result);
        $this->assertInstanceOf(  RouteDataTableConfigResponse::class, RouteDataTableConfigResponse::fromArray( $result));
        $this->assertInstanceOf(  ApiCapabilities::class, ApiCapabilities::fromArray( $result['api_capabilities']));
        $this->assertInstanceOf(  ApiPreferences::class, ApiPreferences::fromArray( $result['api_preferences']));
    }

    public function testUpdateRouteParameters()
    {
        $routeQueryParams= new RouteParametersQuery();
        $routeQueryParams->route_id = self::$testRoutes[sizeof(self::$testRoutes) - 1]->route_id;
        $routeQueryParams->original = 0;

        $routeParams = new RouteParameters();

        $routeParams->disable_optimization = false;
        $routeParams->vehicle_capacity = 9800;
        $routeParams->target_duration = 0;
        $routeParams->target_distance = 100;
        $routeParams->target_wait_by_tail_size = 0;

        $route = new Route();

        $result = $route->updateRouteParameters($routeQueryParams->toArray(), $routeParams->toArray());

        $this->assertNotNull($result);
        $this->assertInstanceOf(  Route::class, Route::fromArray( $result));
    }

    public function  testDeleteRoutes()
    {
        $routeToDeleteID = self::$testRoutes[sizeof(self::$testRoutes) - 1]->route_id;

        $routeIDs = [ $routeToDeleteID ];

        $route = new Route();

        $result = $route->deleteRoutes($routeIDs);

        $this->assertNotNull($result);
        $this->assertInstanceOf(RoutesDeleteResponse::class, RoutesDeleteResponse::fromArray( $result));
        $this->assertTrue($result['deleted']);

        self::$testRoutes = array_pop(self::$testRoutes);
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