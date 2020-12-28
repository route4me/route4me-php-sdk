<?php

namespace UnitTestFiles\Test;

use Route4Me\Address;
use Route4Me\Common;
use Route4Me\Constants;
use Route4Me\Enum\AlgorithmType;
use Route4Me\Enum\DeviceType;
use Route4Me\Enum\DistanceUnit;
use Route4Me\Enum\OptimizationStates;
use Route4Me\Enum\OptimizationType;
use Route4Me\Enum\TravelMode;
use Route4Me\OptimizationProblemParams;
use Route4Me\Route;
use Route4Me\Route4Me;
use Route4Me\OptimizationProblem;
use Route4Me\RouteParameters;
//use function Sodium\add;

class OptimizationProblemUntTests extends \PHPUnit\Framework\TestCase
{
    public static $problem;

    public static $createdProblems = [];
    public static $addresses = [];

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

    public function testFromArray()
    {
        $problem = self::$createdProblems[0];

        $this->assertNotNull($problem);
        $this->assertContainsOnlyInstancesOf(OptimizationProblem::class, [$problem]);

        $this->assertTrue(isset($problem->parameters));
        $this->assertContainsOnlyInstancesOf(RouteParameters::class, [$problem->parameters]);

        $this->assertTrue(isset($problem->addresses));
        $this->assertTrue(sizeof($problem->addresses)>0);

        $firstAddress = $problem->addresses[0];
        $this->assertContainsOnlyInstancesOf(Address::class, [$firstAddress]);

        $this->assertTrue(isset($problem->routes));
        $this->assertTrue(sizeof($problem->routes)>0);

        $firstRoute = $problem->routes[0];
        $this->assertContainsOnlyInstancesOf(Route::class, [$firstRoute]);
    }

    public function testOptimize()
    {
        $parameters = RouteParameters::fromArray([
            'algorithm_type'            => Algorithmtype::TSP,
            'device_type'               => DeviceType::WEB,
            'distance_unit'             => DistanceUnit::MILES,
            'optimize'                  => OptimizationType::DISTANCE,
            'route_max_duration'        => 86400,
            'store_route'               => true,
            'travel_mode'               => TravelMode::DRIVING,
            'vehicle_capacity'          => 1,
            'vehicle_max_distance_mi'   => 10000,
            'route_name'                => 'phpunit testOptimize',
        ]);

        $optimizationParameters = new OptimizationProblemParams();
        $optimizationParameters->setAddresses(self::$addresses);
        $optimizationParameters->setParameters($parameters);

        $problem = OptimizationProblem::optimize($optimizationParameters);

        self::$createdProblems[] = $problem;

        $this->assertNotNull($problem);
        $this->assertInstanceOf('Route4Me\OptimizationProblem', $problem);
        $this->assertNotNull($problem->getOptimizationId());
        $this->assertNotNull($problem->getRoutes());
    }

    public function testGet()
    {
        $problem = OptimizationProblem::get([
            'optimization_problem_id' => self::$createdProblems[0]->getOptimizationId(),
        ]);

        $this->assertNotNull($problem);
        $this->assertInstanceOf(OptimizationProblem::class, $problem);
        $this->assertNotNull($problem->getRoutes());
    }

    public function testGetOptizationsByState()
    {
        $problems = OptimizationProblem::get([
            'state'     => OptimizationStates::OPTIMIZED,
            'limit'     => 5,
            'offset'    => 0,
        ]);

        $this->assertNotNull($problems);
        $this->assertTrue(is_array($problems));
        $this->assertTrue(sizeof($problems)>0);
        $this->assertInstanceOf(OptimizationProblem::class, $problems[0]);

        foreach ($problems as $problem) {
            $this->assertEquals(OptimizationStates::OPTIMIZED, $problem->state);
        }
    }

    public function testGetOptimizationIDsOnly()
    {
        $this->markTestSkipped('must be revisited.');

        $problems = OptimizationProblem::get([
            'id_only'   => 1,
            'limit'     => 5,
            'offset'    => 0,
        ]);

        $this->assertNotNull($problems);
        $this->assertTrue(is_array($problems));
        $this->assertTrue(sizeof($problems)>0);
    }

    public function testReoptimize()
    {
        $optimizationProblemId = self::$createdProblems[0]->getOptimizationId();

        $problem = OptimizationProblem::fromArray(
            OptimizationProblem::reoptimize(['optimization_problem_id' => $optimizationProblemId])
        );

        $this->assertNotNull($problem);
        $this->assertContainsOnlyInstancesOf(OptimizationProblem::class, [$problem]);
    }

    public function testUpdate()
    {
        $problem = self::$createdProblems[0];

        $initialAddresses = sizeof($problem->addresses);

        $extraAddresses = [];

        $extraAddresses[] = self::$addresses[1]->toArray();
        $extraAddresses[] = self::$addresses[2]->toArray();

        $OptimizationParameters = OptimizationProblem::fromArray([
            'optimization_problem_id'   => $problem->optimization_problem_id,
            'addresses'                 => $extraAddresses,
            'reoptimize'                => 1,
        ]);

        $result = OptimizationProblem::fromArray(
            OptimizationProblem::update($OptimizationParameters)
        );

        $this->assertNotNull($problem);
        $this->assertContainsOnlyInstancesOf(OptimizationProblem::class, [$problem]);
        $this->assertTrue(sizeof($result->addresses)==$initialAddresses+2);
    }

    public function testGetRandomOptimizationId()
    {

        $optimization_problem_id = self::$createdProblems[0]->getRandomOptimizationId(0, 10);

        $this->assertNotNull($optimization_problem_id);
        $this->assertTrue(strlen($optimization_problem_id)==32);

        define('R_MD5_MATCH', '/^[a-fA-F0-9]{32}$/i');

        $this->assertTrue(preg_match(R_MD5_MATCH, $optimization_problem_id)==1);
    }

    public function testGetAddresses()
    {
        $problem = self::$createdProblems[0];

        $addresses = $problem->getAddresses($problem->optimization_problem_id);

        $this->assertNotNull($addresses);
        $this->assertTrue(sizeof($addresses)>0);

        $this->assertContainsOnlyInstancesOf(Address::class, [$addresses[0]]);
    }

    public function testGetRandomAddressFromOptimization()
    {
        $problem = self::$createdProblems[0];

        $address = $problem->getRandomAddressFromOptimization($problem->optimization_problem_id);

        $this->assertNotNull($address);
        $this->assertContainsOnlyInstancesOf(Address::class, [$address]);
    }

    public function testRemoveAddress()
    {
        $problem = self::$createdProblems[0];

        $address = end($problem->addresses);

        $params = [
            'optimization_problem_id' => $problem->optimization_problem_id,
            'route_destination_id'    => $address->route_destination_id,
        ];

        $result = $problem->removeAddress($params);

        $this->assertNotNull($result);
        $this->assertTrue(isset($result['deleted']));
        $this->assertTrue(isset($result['route_destination_id']));
        $this->assertTrue($result['deleted']);
        $this->assertEquals($address->route_destination_id, $result['route_destination_id']);
    }

    public function testRemoveOptimization()
    {
        $problem = end(self::$createdProblems);

        $params = [
            'optimization_problem_ids' => [
                '0' => $problem->optimization_problem_id,
            ],
            'redirect' => 0,
        ];

        $result = $problem->removeOptimization($params);

        $this->assertNotNull($result);
        $this->assertTrue(isset($result['status']));
        $this->assertTrue(isset($result['removed']));
        $this->assertTrue($result['status']);
        $this->assertEquals(1, $result['removed']);

        self::$createdProblems[] = array_pop(self::$createdProblems);
    }

    public function testGetHybridOptimization()
    {
        $this->markTestSkipped('must be revisited.');

        $ep = time() + 604800;
        $scheduleDate = date('Y-m-d', $ep);

        $hybridParams = [
            'target_date_string'      => $scheduleDate,
            'timezone_offset_minutes' => 480,
        ];

        $optimization = new OptimizationProblem();

        $hybridOptimization = OptimizationProblem::fromArray(
            $optimization->getHybridOptimization($hybridParams)
        );

        $this->assertNotNull($hybridOptimization);
        $this->assertContainsOnlyInstancesOf(OptimizationProblem::class, [$hybridOptimization]);

        self::$createdProblems[] = $hybridOptimization;
    }

    public function testAddDepotsToHybrid()
    {
        $this->markTestSkipped('must be revisited.');

        $ep = time() + 604800;
        $scheduleDate = date('Y-m-d', $ep);

        $hybridParams = [
            'target_date_string'      => $scheduleDate,
            'timezone_offset_minutes' => 480,
        ];

        $optimization = new OptimizationProblem();

        $hybridOptimization = OptimizationProblem::fromArray(
            $optimization->getHybridOptimization($hybridParams)
        );

        $this->assertNotNull($hybridOptimization);
        $this->assertContainsOnlyInstancesOf(OptimizationProblem::class, [$hybridOptimization]);

        self::$createdProblems[] = $hybridOptimization;

        $depotAddresses = [];

        $depotsParams = [
            'optimization_problem_id' => $hybridOptimization->optimization_problem_id,
            'delete_old_depots'       => true,
        ];

        $depotAddresses[] = self::$addresses[0];
        $depotAddresses[] = self::$addresses[1];

        $depotsParams['new_depots'] = $depotAddresses;

        $resultDepots = $hybridOptimization->addDepotsToHybrid($depotsParams);
        $this->assertNotNull($resultDepots);

        $problemParams = [
            'optimization_problem_id' => $hybridOptimization->optimization_problem_id,
        ];

        $problem = OptimizationProblem::fromArray(
            OptimizationProblem::reoptimize($problemParams)
        );

        $this->assertNotNull($problem);
        $this->assertContainsOnlyInstancesOf(OptimizationProblem::class, [$problem]);
    }

    public static function tearDownAfterClass()
    {
        $optimizationProblemIDs = [];

        foreach (self::$createdProblems as $problem) {
            $optimizationProblemId = $problem->optimization_problem_id;

            $optimizationProblemIDs[] = $optimizationProblemId;
        }

        $params = [
            'optimization_problem_ids' => $optimizationProblemIDs,
            'redirect'                 => 0,
        ];

        $result = OptimizationProblem::removeOptimization($params);

        if ($result!=null && $result['status']==true) {
            echo "The test optimization was removed <br>";
        } else {
            echo "Cannot remove the test optimization <br>";
        }
    }
}