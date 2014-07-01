<?php

namespace Route4me;

use Route4me\Track;
use Route4me\TrackSetParams;
use Route4me\Route;
use Route4me\Address;
use Route4me\RouteParameters;
use Route4me\OptimizationProblem;
use Route4me\OptimizationProblemParams;
use Route4me\Enum\DeviceType;
use Route4me\Enum\Format;

class RouteTest extends \PHPUnit_Framework_TestCase
{
    static $route_id = null;
    static function setUpBeforeClass()
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

        $parameters = RouteParameters::fromArray(array(
            "device_type"          => DeviceType::IPAD,
            "disable_optimization" => false,
            "route_name"           => "phpunit test"
        ));

        $optimizationParameters = new OptimizationProblemParams;
        $optimizationParameters->setAddresses($addresses);
        $optimizationParameters->setParameters($parameters);

        $problem = OptimizationProblem::optimize($optimizationParameters);
        $routes = $problem->getRoutes();
        self::$route_id = $routes[0]->getRouteId();
    }

    function testGetRouteById()
    {
        $route = Route::getRoutes(self::$route_id);
        $this->assertInstanceOf("Route4me\Route", $route);
        $this->assertNotNull($route);
        $this->assertNotNull($route->addresses);
        $this->assertEmpty($route->tracking_history);
        $this->assertTrue(is_array($route->addresses));
    }

    function testGetTrackingHistory()
    {
        $params = TrackSetParams::fromArray(array(
            'format'           => Format::CSV,
            'route_id'         => self::$route_id,
            'member_id'        => 1,
            'course'           => 1,
            'speed'            => 120,
            'lat'              => 41.8927521,
            'lng'              => -109.0803888,
            'device_type'      => DeviceType::IPHONE,
            'device_guid'      => 'qweqweqwe',
            'device_timestamp' => date('Y-m-d H:i:s')
        ));
        $status = Track::set($params);
        $this->assertTrue($status);

        $route = Route::getRoutes(self::$route_id, array(
            'device_tracking_history' => true
        ));
        $this->assertInstanceOf("Route4me\Route", $route);
        $this->assertNotNull($route);
        $this->assertNotNull($route->addresses);
        $this->assertNotEmpty($route->tracking_history);
        $this->assertTrue(is_array($route->addresses));
    }

    function testGetRoutes()
    {
        $routes = Route::getRoutes();
        $this->assertNotNull($routes);
        $this->assertTrue(is_array($routes));
        $this->assertTrue(count($routes) > 0);

        foreach($routes as $route) {
            $this->assertInstanceOf("Route4me\Route", $route);
        }
    }

    function testUpdateRouteParams()
    {
        $route = Route::getRoutes(self::$route_id);
        $this->assertNotNull($route);
        $route->parameters->route_name = 'phpunit test';
        $route->parameters->device_type = DeviceType::IPAD;

        $state = $route->update();

        $this->assertTrue($state);
    }

    function testAddAddresses()
    {
        $route = Route::getRoutes(self::$route_id);
        $this->assertNotNull($route);

        $addresses = array();
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

        $state = $route->addAddresses($addresses);
        $this->assertTrue($state);
    }

    function testRemoveRoute()
    {
        $route = Route::getRoutes(self::$route_id);
        $this->assertNotNull($route);

        $state = $route->delete();
        $this->assertTrue($state);
    }
}
