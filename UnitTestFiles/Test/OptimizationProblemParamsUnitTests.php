<?php

namespace UnitTestFiles\Test;

use Route4Me\Address;
use Route4Me\Exception\BadParam;
use Route4Me\OptimizationProblemParams;
use Route4Me\RouteParameters;

class OptimizationProblemParamsUnitTests extends \PHPUnit\Framework\TestCase
{
    public static $routeParameters = null;
    public static $addresses = [];

    public static function setUpBeforeClass()
    {
        //region Addresses
        self::$addresses[] = Address::fromArray([
            'address'           => '11497 Columbia Park Dr W, Jacksonville, FL 32258',
            'is_depot'          => true,
            'lat'               => 30.159341812134,
            'lng'               => -81.538619995117,
            'time'              => 300,
            'time_window_start' => 28800,
            'time_window_end'   => 32400,
        ]);

        self::$addresses[] = Address::fromArray([
            'address'           => '214 Edgewater Branch Drive 32259',
            'lat'               => 30.103567123413,
            'lng'               => -81.595352172852,
            'time'              => 300,
            'time_window_start' => 36000,
            'time_window_end'   => 37200,
        ]);

        self::$addresses[] = Address::fromArray([
            'address'           => '756 eagle point dr 32092',
            'lat'               => 30.046422958374,
            'lng'               => -81.508758544922,
            'time'              => 300,
            'time_window_start' => 39600,
            'time_window_end'   => 41400,
        ]);
        //endregion

        self::$routeParameters = RouteParameters::fromArray([
            'is_upload'                 => false,
            'rt'                        => false,
            'route_name'                => 'Saturday 25th of July 2020 04 => 00 => 00 AM UTC',
            'route_date'                => 1595635200,
            'route_time'                => 25200,
            'disable_optimization'      => false,
            'optimize'                  => 'Time',
            'lock_last'                 => false,
            'vehicle_capacity'          => null,
            'vehicle_max_cargo_weight'  => null,
            'vehicle_max_cargo_volume'  => null,
            'vehicle_max_distance_mi'   => null,
            'subtour_max_revenue'       => null,
            'distance_unit'             => 'mi',
            'travel_mode'               => 'Driving',
            'avoid'                     => '',
            'avoidance_zones'           => [],
            'vehicle_id'                => null,
            'driver_id'                 => null,
            'dev_lat'                   => null,
            'dev_lng'                   => null,
            'route_max_duration'        => 86399,
            'route_email'               => null,
            'store_route'               => true,
            'metric'                    => 4,
            'algorithm_type'            => 1,
            'member_id'                 => 444333,
            'ip'                        => 199911333,
            'dm'                        => 12,
            'dirm'                      => 10,
            'parts'                     => 10,
            'parts_min'                 => 1,
            'device_id'                 => null,
            'device_type'               => 'web',
            'first_drive_then_wait_between_stops' => false,
            'has_trailer'               => false,
            'trailer_weight_t'          => null,
            'limited_weight_t'          => null,
            'weight_per_axle_t'         => null,
            'truck_height'              => null,
            'truck_width'               => null,
            'truck_length'              => null,
            'truck_hazardous_goods'     => '',
            'truck_axles'               => 0,
            'truck_toll_road_usage'     => null,
            'truck_avoid_ferries'       => null,
            'truck_hwy_only'            => null,
            'truck_lcv'                 => null,
            'truck_borders'             => null,
            'truck_side_street_adherence' => null,
            'truck_config'              => null,
            'truck_dim_unit'            => null,
            'truck_type'                => null,
            'truck_weight'              => 0,
            'optimization_quality'      => 1,
            'override_addresses'        => [],
            'max_tour_size'             => null,
            'min_tour_size'             => 0,
            'uturn'                     => 1,
            'leftturn'                  => 1,
            'rightturn'                 => 1,
            'route_time_multiplier'     => null,
            'route_service_time_multiplier' => null,
            'optimization_engine'       => '2',
            'is_dynamic_start_time'     => false
        ]);
    }

    public function testFromArray()
    {
        $optParams = OptimizationProblemParams::fromArray([
            'addresses'     => self::$addresses,
            'parameters'    => self::$routeParameters
        ]);

        $this->assertNotNull($optParams);
        $this->assertContainsOnlyInstancesOf(OptimizationProblemParams::class, [$optParams]);
    }

    public function testWithoutParameters()
    {
        $this->expectException(BadParam::class);

        OptimizationProblemParams::fromArray([
            'addresses' => self::$addresses,
        ]);
    }

    public function testRedefineRedirectParam()
    {
        $optimizationParameters = OptimizationProblemParams::fromArray([
            'addresses'     => self::$addresses,
            'parameters'    => self::$routeParameters,
            'redirect'      => false,
        ]);

        $this->assertObjectHasAttribute('redirect', $optimizationParameters);
        $this->assertFalse($optimizationParameters->redirect);
    }

    public function testSetParameters()
    {
        $optimizationParameters = new OptimizationProblemParams();

        $optimizationParameters->parameters = self::$routeParameters;

        $this->assertObjectHasAttribute('parameters', $optimizationParameters);
    }

    public function testAddAddress()
    {
        $optimizationParameters = new OptimizationProblemParams();

        $optimizationParameters->addAddress(self::$addresses[0]);

        $address = $optimizationParameters->addresses[0];

        $this->assertContainsOnlyInstancesOf(Address::class, [$address]);
        $this->assertEquals(self::$addresses[0],$optimizationParameters->addresses[0]);
    }

    public function testGetAddressesArray()
    {
        $optimizationParameters = new OptimizationProblemParams();

        $optimizationParameters->addresses = self::$addresses;

        $addresses = $optimizationParameters->getAddressesArray();

        $firstAddress = Address::fromArray(
            $addresses[0]
        );

        $this->assertNotNull($addresses);
        $this->assertTrue(sizeof($addresses)>0);
        $this->assertContainsOnlyInstancesOf(Address::class, [$firstAddress]);
    }

    public function testGetParametersArray()
    {
        $optimizationParameters = new OptimizationProblemParams();

        $optimizationParameters->parameters = self::$routeParameters;

        $routeParameters = RouteParameters::fromArray(
            $optimizationParameters->getParametersArray()
        );

        $this->assertNotNull($optimizationParameters);
        $this->assertContainsOnlyInstancesOf(RouteParameters::class, [$routeParameters]);
    }

    public function testSetAddresses()
    {
        $optimizationParameters = new OptimizationProblemParams();

        $optimizationParameters->setAddresses(self::$addresses);

        $this->assertEquals(self::$addresses,$optimizationParameters->addresses);

        $address = $optimizationParameters->addresses[0];

        $this->assertContainsOnlyInstancesOf(Address::class, [$address]);

    }

    public static function tearDownAfterClass()
    {
        self::$addresses[] = null;
        self::$routeParameters = null;
    }
}