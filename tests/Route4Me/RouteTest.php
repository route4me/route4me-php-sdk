<?php

namespace Route4Me;

$d="C:/Program Files (x86)/EasyPHP-Devserver-16.1/eds-www/route4me";
require_once $d.'/vendor/autoload.php';

use Route4Me\Track;
use Route4Me\TrackSetParams;
use Route4Me\Route;
use Route4Me\Address;
use Route4Me\RouteParameters;
use Route4Me\OptimizationProblem;
use Route4Me\OptimizationProblemParams;
use Route4Me\Enum\DeviceType;
use Route4Me\Enum\Format;

class RouteTest extends \PHPUnit_Framework_TestCase
{
    static $route_id = null;
    static function setUpBeforeClass()
    {
    	Route4Me::setApiKey('11111111111111111111111111111111');
        $addresses = array();
        $addresses[] = Address::fromArray(array(
          "address"  => "11497 Columbia Park Dr W, Jacksonville, FL 32258",
          "is_depot" => true,
          "lat"      => 30.159341812134,
          "lng"      => -81.538619995117
        ));

        $addresses[] = Address::fromArray(array(
          "address" => "214 Edgewater Branch Drive 32259",
          "lat"     => 30.103567123413,
          "lng"     => -81.595352172852
        ));

        $addresses[] = Address::fromArray(array(
          "address" => "756 eagle point dr 32092",
          "lat"     => 30.046422958374,
          "lng"     => -81.508758544922
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
        $this->assertInstanceOf("Route4Me\Route", $route);
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
        $this->assertInstanceOf("Route4Me\Route", $route);
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
            $this->assertInstanceOf("Route4Me\Route", $route);
        }
    }

    function testUpdateRouteParams()
    {
        $route = Route::getRoutes(self::$route_id);
        $this->assertNotNull($route);
        $route->parameters->route_name = 'phpunit test';
        $route->parameters->device_type = DeviceType::IPAD;
        $route = $route->update();

        $this->assertInstanceOf("Route4Me\Route", $route);
        $this->assertEquals($route->parameters->route_name, 'phpunit test');
    }

    function testAddAddresses()
    {
    	Route4Me::setApiKey('11111111111111111111111111111111');
		self::setRouteId();
        $route = Route::getRoutes(self::$route_id);
        $this->assertNotNull($route);
		
		$initial_addresses=count($route->addresses);
		
        $addresses = array();
        $addresses[] = Address::fromArray(array(
          "address" => "214 Edgewater Branch Drive 32259",
          "lat"     => 30.103567123413,
          "lng"     => -81.595352172852
        ));
        $addresses[] = Address::fromArray(array(
          "address" => "756 eagle point dr 32092",
          "lat"     => 30.046422958374,
          "lng"     => -81.508758544922
        ));
		
		$routeParameters=array(
			"route_id"	=> self::$route_id,
			"addresses"		=> $addresses,
		);

        $route = $route->addAddresses($routeParameters);
        $this->assertInstanceOf("Route4Me\Route", $route);
        $this->assertEquals(count($route->addresses), $initial_addresses+2);
    }

    function testRemoveRoute()
    {
    	self::setRouteId();
        $route = Route::getRoutes(self::$route_id);
        $this->assertNotNull($route);

        $state = $route->delete(self::$route_id);
        $this->assertTrue($state["deleted"]);
    }
    
    static function setRouteId()
	{
		// Get random route from test routes
		//--------------------------------------------------------
		$route=new Route();
		self::$route_id=$route->getRandomRouteId(0, 10);
		
		if (is_null(self::$route_id)) {
			echo "can't retrieve random route_id!.. Try again.";
			return;
		}
		//--------------------------------------------------------
	}
}

$routetest=new RouteTest();
$routetest->testAddAddresses();
$routetest->testRemoveRoute();
?>
