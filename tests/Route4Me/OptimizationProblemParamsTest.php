<?php

namespace Route4Me;

use Route4Me\RouteParameters;
use Route4Me\OptimizationProblemParams;
use Route4Me\Exception\BadParam;
use Route4Me\Enum\DeviceType;
use Route4Me\Enum\DistanceUnit;
use Route4Me\Enum\OptimizationType;
use Route4Me\Enum\AlgorithmType;
use Route4Me\Enum\TravelMode;

class OptimizationProblemParamsTest extends \PHPUnit_Framework_TestCase
{
    /**
     *  @expectedException Route4Me\Exception\BadParam
     *  @expectedExceptionMessage addresses must be provided.
     **/
    function testWithoutParams()
    {
        OptimizationProblemParams::fromArray(array());
    }

    function setUp()
    {
        $addresses = array();
        $addresses[] = Address::fromArray(array(
          "address" => "11497 Columbia Park Dr W, Jacksonville, FL 32258",
          "is_depot" => true,
          "lat" => 30.159341812134,
          "lng" => -81.538619995117,
          "time" => 300,
          "time_window_start" => 28800,
          "time_window_end" => 32400
        ));

        $addresses[] = Address::fromArray(array(
          "address" => "214 Edgewater Branch Drive 32259",
          "lat" => 30.103567123413,
          "lng" => -81.595352172852,
          "time" => 300,
          "time_window_start" => 36000,
          "time_window_end" => 37200
        ));

        $addresses[] = Address::fromArray(array(
            "address" => "756 eagle point dr 32092",
            "lat" => 30.046422958374,
            "lng" => -81.508758544922,
            "time" => 300,
            "time_window_start" => 39600,
            "time_window_end" => 41400
        ));

        $this->addresses = $addresses;
        $this->parameters = RouteParameters::fromArray(array(
            "algorithm_type" => Algorithmtype::TSP,
            "device_type" => DeviceType::WEB,
            "distance_unit" => DistanceUnit::MILES,
            "optimize" => OptimizationType::DISTANCE,
            "remote_ip" => 0,
            "route_max_duration" => 86400,
            "route_time" => 0,
            "store_route" => true,
            "travel_mode" => TravelMode::DRIVING,
            "vehicle_capacity" => 1,
            "vehicle_max_distance_mi" => 10000
        ));
    }

    /**
     *  @expectedException Route4Me\Exception\BadParam
     *  @expectedExceptionMessage parameters must be provided.
     **/
    function testWithoutParameters()
    {
        OptimizationProblemParams::fromArray(array(
            'addresses' => $this->addresses
        ));
    }

    function testRedirectDefaultParam()
    {
        $optimizationParameters = new OptimizationProblemParams;
        $this->assertObjectHasAttribute('redirect', $optimizationParameters);
        $this->assertTrue($optimizationParameters->redirect);
    }

    function testRedefineRedirectParam()
    {
        $optimizationParameters = OptimizationProblemParams::fromArray(array(
            'addresses' => $this->addresses,
            'parameters' => $this->parameters,
            'redirect' => false
        ));

        $this->assertObjectHasAttribute('redirect', $optimizationParameters);
        $this->assertFalse($optimizationParameters->redirect);
    }

    function testParameters()
    {
        $opParams = OptimizationProblemParams::fromArray(array(
            'addresses'              => $this->addresses,
            'parameters'             => $this->parameters,
            'directions'             => 0,
            'format'                 => 'json',
            'optimized_callback_url' => 'http://google.com'
        ));

        $this->assertNotNull($opParams->addresses);
        $this->assertEquals(count($opParams->addresses), 3);
        $this->assertNotNull($opParams->parameters);
        $this->assertTrue(is_array($opParams->parameters->toArray()));
        $this->assertEquals(
            $opParams->parameters->toarray(),
            $this->parameters->toArray());

        $this->assertEquals($opParams->directions, 0);
        $this->assertEquals($opParams->format, 'json');
        $this->assertEquals(
            $opParams->optimized_callback_url, 'http://google.com');
    }
}
