<?php

namespace UnitTestFiles\Test;

use Route4Me\Address;
use Route4Me\Constants;
use Route4Me\Enum\AlgorithmType;
use Route4Me\Enum\DeviceType;
use Route4Me\Enum\Metric;
use Route4Me\OptimizationProblem;
use Route4Me\OptimizationProblemParams;
use Route4Me\Route4Me;
use Route4Me\RouteParameters;
use Route4Me\V5\Addresses\RouteAdvancedConstraints;

class AdvancedConstraintsUnitTests extends \PHPUnit\Framework\TestCase {
    public static $problem;

    public static function setUpBeforeClass()
    {
        Route4Me::setApiKey(Constants::API_KEY);
        self::$problem = null;
    }

    public function testAdvancedConstraintsExample12()
    {
        $addresses = array_map('str_getcsv', file(dirname(__FILE__).'/data/locations.csv'));
        array_walk($addresses, function(&$a) use ($addresses) { $a = Address::fromArray(array_combine($addresses[0], $a)); });
        array_shift($addresses);

        $parameters = RouteParameters::fromArray([
            'algorithm_type' => AlgorithmType::ADVANCED_CVRP_TW,
            'store_route' => false,
            'rt' => true,
            'parts' => 30,
            'metric' => Metric::MATRIX,
            'member_id' => 444333,
            'route_name' => "Drivers Schedules - 3 Territories",
            'optimize' => "Distance",
            'distance_unit' => "mi",
            'device_type' => DeviceType::WEB,
            'travel_mode' => "Driving",
            'advanced_constraints' => []
        ]);

        $zones = [["ZONE 01"], ["ZONE 02"], ["ZONE 03"]];

        for($i = 0; $i < 30; ++$i)
        {
            $parameters->advanced_constraints[] = RouteAdvancedConstraints::fromArray([
                'tags' => [$zones[$i % 3]],
                'members_count' => 1,
                'available_time_windows' => [[(8 + 5) * 3600, (11 + 5) * 3600]],
                'location_sequence_pattern' => [Address::fromArray([
                    'address' => "RETAIL LOCATION",
                    'alias' => "RETAIL LOCATION",
                    'lat' => 25.8741751,
                    'lng' => -80.1288583,
                    'time' => 300
                ])]
            ]);
        }
    
        $optimizationParameters = new OptimizationProblemParams();
        $optimizationParameters->setAddresses($addresses);
        $optimizationParameters->setParameters($parameters);

        self::$problem = OptimizationProblem::optimize($optimizationParameters);

        $this->assertNotNull(self::$problem->optimization_problem_id);
        $this->assertEquals(self::$problem->parameters->route_name, 'Drivers Schedules - 3 Territories');
    }

    public static function tearDownAfterClass()
    {
        if(!is_null(self::$problem->optimization_problem_id))
        {
            $params = [
                'optimization_problem_ids' => ['0' => self::$problem->optimization_problem_id],
                'redirect' => 0,
            ];

            $result = self::$problem->removeOptimization($params);

            if ($result != null && $result['status'] == true) {
                echo "The test optimization was removed <br>";
            } else {
                echo "Cannot remove the test optimization <br>";
            }
        }
    }
}
