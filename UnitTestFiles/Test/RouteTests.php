<?php

namespace UnitTestFiles\Test;

use Route4Me\Address;
use Route4Me\Constants;
use Route4Me\Enum\AlgorithmType;
use Route4Me\Enum\DeviceType;
use Route4Me\Enum\DistanceUnit;
use Route4Me\Enum\Metric;
use Route4Me\Enum\OptimizationType;
use Route4Me\Enum\TravelMode;
use Route4Me\Member;
use Route4Me\OptimizationProblem;
use Route4Me\OptimizationProblemParams;
use Route4Me\Route;
use Route4Me\Route4Me;
use Route4Me\RouteParameters;
use Route4Me\Vehicle;

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

        //region -- Create Test Order --



        //endregion
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

    public function testAssignMemberToRoute()
    {
        //region -- Get Random Member --

        $member = new Member();

        $users = $member->getUsers();

        assert(!is_null($users), 'Cannot retrieve list of the users');
        assert(2 == sizeof($users), 'Cannot retrieve list of the users');
        assert(isset($users['results']), 'Cannot retrieve list of the users');
        assert(isset($users['total']), 'Cannot retrieve list of the users');

        $randIndex = rand(0, $users['total'] - 1);

        $randomUserID = $users['results'][$randIndex]['member_id'];

        //endregion

        //region -- Assign Member To Route

        $route = new Route();

        $routeId = self::$createdProblems[0]
            ->routes[sizeof(self::$createdProblems[0]->routes) - 1]
            ->route_id;

        $route->route_id = $routeId;

        $route->parameters = new \stdClass();

        $route->parameters = [
            'member_id' => $randomUserID,
        ];

        $route->httpheaders = 'Content-type: application/json';

        $route->update();

        $this->assertNotNull($route);
        $this->assertInstanceOf(Route::class,$route);

        //endregion

        //region -- Check the Route Assigned --

        $route = new Route();

        $assignedRoute= $route->getRoutes(['route_id' => $routeId]);

        $this->assertNotNull($assignedRoute);
        $this->assertInstanceOf(Route::class,$assignedRoute);
        $this->assertEquals($randomUserID, $assignedRoute->parameters->member_id);

        //endregion
    }

    public function testAssignVehicleToRoute()
    {
        //region -- Get Random Vehicle --

        $vehicle = new Vehicle();

        $vehicleParameters = [
            'with_pagination' => true,
            'page' => 1,
            'perPage' => 10,
        ];

        $response = $vehicle->getVehicles($vehicleParameters);

        $randomIndex = rand(0, 9);
        $vehicleId = $response['data'][$randomIndex]['vehicle_id'];

        //endregion

        //region -- Assign Vehicle To Route

        $route = new Route();

        $routeId = self::$createdProblems[0]
            ->routes[sizeof(self::$createdProblems[0]->routes) - 1]
            ->route_id;

        $route->route_id = $routeId;

        $route->parameters = new \stdClass();

        $route->parameters = [
            'vehicle_id' => $vehicleId,
        ];

        $route->httpheaders = 'Content-type: application/json';

        $route->update();

        $this->assertNotNull($route);
        $this->assertInstanceOf(Route::class,$route);

        //endregion

        //region -- Check the Route Assigned --

        $route = new Route();

        $assignedRoute= $route->getRoutes(['route_id' => $routeId]);

        $this->assertNotNull($assignedRoute);
        $this->assertInstanceOf(Route::class,$assignedRoute);
        $this->assertEquals($vehicleId, $assignedRoute->parameters->vehicle_id);

        //endregion
    }

    public function testDuplicateRoute()
    {
        $route = new Route();

        $routeIDs = [self::$testRoutes[0]->route_id];

        $routeDuplicate = $route->duplicateRoute($routeIDs);

        $this->assertTrue(isset($routeDuplicate['status']), "Cannot created duplicate route");
        $this->assertTrue($routeDuplicate['status'], "Cannot created duplicate route");

        $duplicatedRouteId = $routeDuplicate['route_ids'][0];

        self::$removedRouteIDs[] = $duplicatedRouteId;
    }

    public function testGetRouteDirections()
    {
        $route = new Route();

        $route_id = self::$testRoutes[0]->route_id;

        // Note: not every optimization includes information about directions,
        // only thus, which was generated with the parameter directions = 1

        // Get a route with the directions
        $params = [
            'directions' => 1,
            'route_id' => $route_id,
        ];

        $routeResult = (array)$route->getRoutePoints($params);

        $this->assertNotNull($routeResult);
        $this->assertTrue(is_array($routeResult));
        $this->assertTrue(sizeof($routeResult)>0);
        $this->assertInstanceOf(Route::class, Route::fromArray($routeResult));
        $this->assertTrue(isset($routeResult['directions']));
        $this->assertTrue(sizeof($routeResult['directions'])>0);
    }

    public function testGetRoutePathPoints()
    {
        $route = new Route();

        $route_id = self::$testRoutes[0]->route_id;

        // Note: not every optimization includes information about path points, only thus,
        // which was generated with the parameter route_path_output = "Points"

        // Get a route with the path points
        $params = [
            'route_path_output' => 'Points',
            'route_id' => $route_id,
        ];

        $routeResult = (array) $route->getRoutePoints($params);

        $this->assertNotNull($routeResult);
        $this->assertTrue(is_array($routeResult));
        $this->assertTrue(sizeof($routeResult)>0);
        $this->assertInstanceOf(Route::class, Route::fromArray($routeResult));
        $this->assertTrue(isset($routeResult['path']));
        $this->assertTrue(sizeof($routeResult['path'])>0);
    }

    public function testGetRoute()
    {
        $route = new Route();

        $route_id = self::$testRoutes[0]->route_id;

        // get a route by ID
        $routeResult = $route->getRoutes(['route_id' => $route_id]);

        $this->assertNotNull($routeResult);
        $this->assertInstanceOf(Route::class, $routeResult);
        $this->assertEquals($route_id, $routeResult->route_id);
    }

    public function testGetRoutesByIDs()
    {
        $RouteParameters = [
            'limit' => 5,
            'offset' => 0,
        ];

        $route = new Route();

        $routeResults = $route->getRoutes($RouteParameters);

        $routeId1 = $routeResults[0]->route_id;
        $routeId2 = $routeResults[1]->route_id;

        $routesResult = $route->getRoutes(['route_id' => $routeId1.','.$routeId2]);

        $this->assertNotNull($routesResult);
        $this->assertTrue(is_array($routesResult));
        $this->assertTrue(sizeof($routesResult)==2);
        $this->assertInstanceOf(
            Route::class,
            Route::fromArray($routesResult[0])
        );
    }

    public function testGetRoutesFromDateRange()
    {
        $RouteParameters = [
            'start_date' => date('Y-m-d', strtotime('-1 days')),
            'end_date' => date('Y-m-d', strtotime('+1 days'))
        ];

        $route = new Route();

        $routeResults = $route->getRoutes($RouteParameters);

        $this->assertNotNull($routeResults);
        $this->assertTrue(is_array($routeResults));
        $this->assertTrue(sizeof($routeResults)>0);
        $this->assertInstanceOf(Route::class, Route::fromArray($routeResults));

        $startDateUnix = date_create($RouteParameters['start_date'])->format('U');
        $endtDateUnix = date_create($RouteParameters['end_date'])->format('U');

        foreach ($routeResults as $routeResult) {

            $this->assertTrue(
                $routeResult->parameters->route_date>=$startDateUnix &&
                $routeResult->parameters->route_date<=$endtDateUnix
            );
        }
    }

    public function testGetRoutes()
    {
        $RouteParameters = [
            'limit' => 10,
            'offset' => 0,
        ];

        $route = new Route();

        $routeResults = $route->getRoutes($RouteParameters);

        $this->assertNotNull($routeResults);
        $this->assertTrue(is_array($routeResults));
        $this->assertTrue(sizeof($routeResults)>0);
        $this->assertInstanceOf(Route::class, Route::fromArray($routeResults));
    }

    public function testReoptimizeRoute()
    {
        $route = new Route();

        $route_id = self::$testRoutes[0]->route_id;

        // Re-sequence all addresses
        $params = [
            'route_id' => $route_id,
            'reoptimize' => true,
        ];

        $routeResult = $route->updateRoute($params);

        $this->assertNotNull($routeResult);
        $this->assertTrue(is_array($routeResult));
        $this->assertTrue(sizeof($routeResult)>0);
        $this->assertInstanceOf(Route::class, Route::fromArray($routeResult));
    }

    public function testResequenceReoptimizeRoute()
    {
        $route = new Route();

        $selectedRoute = null;

        foreach (self::$testRoutes as $route1) {
            if (isset($route1->destination_count)) {
                if ($route1->destination_count > 4) {
                    $selectedRoute = $route->getRoutes(['route_id' => $route1->route_id]);
                    break;
                }
            }
        }

        $this->assertNotNull(
            $selectedRoute,
            "Cannot select a route with more than 4 addresses");

        // Resequence a route destination
        $routeID = $selectedRoute->route_id;
        $routeDestinationID = $selectedRoute->addresses[2]->route_destination_id;

        echo "Route ID-> $routeID, Route destination ID -> $routeDestinationID <br>";

        $params = [
            'route_id' => $routeID,
            'route_destination_id' => $routeDestinationID,
            'addresses' => [
                '0' => [
                    'route_destination_id' => $routeDestinationID,
                    'sequence_no' => 3,
                ],
            ],
        ];

        $response = $route->resequenceRoute($params);

        $this->assertNotNull($response);
        $this->assertTrue(is_array($response));
        $this->assertTrue(sizeof($response)>0);
        $this->assertInstanceOf(Route::class, Route::fromArray($response));
    }

    public function testResequenceRouteDestinations()
    {
        $route = new Route();
        $address = new Address();

        $routeID = self::$testRoutes[0]->route_id;
        $routeDestinationID = self::$testRoutes[0]->addresses[2]->route_destination_id;

        $this->assertNotNull($routeID);
        $this->assertNotNull($routeDestinationID);

        //region -- Re-sequence a route destination --

        $params = [
            'route_id' => $routeID,
            'route_destination_id' => $routeDestinationID,
            'addresses' => [
                '0' => [
                    'route_destination_id' => $routeDestinationID,
                    'sequence_no' => 3,
                ],
            ],
        ];

        $response = $route->resequenceRoute($params);

        $this->assertNotNull($response);
        $this->assertTrue(is_array($response));
        $this->assertTrue(sizeof($response)>0);
        $this->assertInstanceOf(Route::class, Route::fromArray($response));

        //endregion

        //region -- Check the Address re-sequenced --

        $addressRetrieved = $address->getAddress($routeID, $routeDestinationID);

        $this->assertEquals(3, $addressRetrieved->sequence_no);

        //endregion
    }

    public function  testRouteOriginParameter()
    {
        $route = new Route();

        $routeID = self::$testRoutes[0]->route_id;

        //region -- Re-sequence the route --

        $params = [
            'route_id' => $routeID,
        ];

        $status = $route->resequenceAllAddresses($params);

        $params = [
            'route_id' => $routeID,
            'original' =>  1
        ];

        $routeWithOriginRoute = $route->getRoutes($params);

        //endregion

        $this->assertNotNull($routeWithOriginRoute);
        $this->assertInstanceOf(Route::class, $routeWithOriginRoute);

        $this->assertNotNull($routeWithOriginRoute->original_route);
        $this->assertInstanceOf(Route::class, $routeWithOriginRoute->original_route);
    }

    public function testShareRoute()
    {
        $route = new Route();

        $routeID = self::$testRoutes[0]->route_id;

        // Share a route with an email
        $params = [
            'route_id' => $routeID,
            'response_format' => 'json',
            'recipient_email' => 'rrrrrrrrrrrrrrrr+share1234@gmail.com',
        ];

        $result = $route->shareRoute($params);

        $this->assertNotNull($result);
        $this->assertTrue(isset($result['status']));
        $this->assertTrue($result['status']);
    }

    public function testUnlinkRouteFromOptimization()
    {
        $route = new Route();

        $routeID = self::$testRoutes[0]->route_id;

        //region -- Unlink a route from master destination --

        $route->route_id = $routeID;
        $route->parameters = new \stdClass();

        $parameters = [
            'route_id' => $routeID,
            'unlink_from_master_optimization' => true,
        ];

        $route->httpheaders = 'Content-type: application/json';

        $result = $route->updateRoute($parameters);

        //endregion

        $this->assertNotNull($result);
        $this->assertInstanceOf(Route::class, Route::fromArray($result));
        $this->assertNull($result['optimization_problem_id']);

        $removedRouteIDs[]= $result['route_id'];
    }

    public function testUpdateRouteAvoidanceZone()
    {
        $route = new Route();

        $routeID = self::$testRoutes[0]->route_id;

        $parameters = [
            'route_id' => $routeID,
            'parameters' => [
                'avoidance_zones' => [
                    'FAA49711A0F1144CE4E203DC18ABDFFB',
                    '9C48E8008E9865006336B99D3595E66A'
                ]
            ]
        ];

        $route->httpheaders = 'Content-type: application/json';

        $result = $route->updateRoute($parameters);

        $this->assertNotNull($result);
        $this->assertInstanceOf(Route::class, Route::fromArray($result));

        $this->assertNotNull($result['parameters']['avoidance_zones']);
        $this->assertTrue(is_array($result['parameters']['avoidance_zones']));
        $this->assertEquals(2, sizeof($result['parameters']['avoidance_zones']));
    }

    public function testUpdateRouteCustomData()
    {
        $route = new Route();

        $routeID = self::$testRoutes[0]->route_id;

        // Get a random address ID from selected route above
        $addressRand = (array)$route->GetRandomAddressFromRoute($routeID);

        $route->route_id = $routeID;
        $route->route_destination_id = $addressRand['route_destination_id'];

        // Update destination custom data
        $route->parameters = new \stdClass();

        $route->parameters->custom_fields = [
            'animal' => 'tiger',
            'bird' => 'canary',
        ];

        $route->httpheaders = 'Content-type: application/json';

        $result = $route->updateAddress();

        $this->assertNotNull($result);
        $this->assertInstanceOf(Address::class, Address::fromArray($result));

        $this->assertTrue(isset($result['custom_fields']));
        $this->assertTrue(is_array($result['custom_fields']));
        $this->assertEquals('tiger', $result['custom_fields']['animal']);
        $this->assertEquals('canary', $result['custom_fields']['bird']);
    }

    public function testUpdateRoute()
    {
        $route = new Route();

        $routeID = self::$testRoutes[0]->route_id;

        $initialRoute = self::$testRoutes[0];

        // Update the route parameters
        $route->route_id = $routeID;

        $route->parameters = new \stdClass();

        $route->parameters = [
            'member_id' => $initialRoute->member_id,
            'optimize' => 'Distance',
            'route_max_duration' => '82400',
            'route_name' => 'updated '.date('m-d-Y'),
        ];

        $route->httpheaders = 'Content-type: application/json';

        $result = $route->update();

        $this->assertNotNull($result);
        $this->assertInstanceOf(Route::class, $result);
    }

    public function testDeleteRoutes()
    {
        $route = new Route();

        $route_ids = join(',', [self::$createdProblems[0]->routes[0]->route_id]);

        $result = $route->deleteRoutes($route_ids);

        $this->assertNotNull($result);
        $this->assertTrue(isset($result['deleted']));
        $this->assertTrue($result['deleted']);
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