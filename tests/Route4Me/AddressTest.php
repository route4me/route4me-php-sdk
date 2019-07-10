<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Enum\DeviceType;

class AddressTest extends \PHPUnit_Framework_TestCase
{
    public static $route_id = null;
    public static $address_id = null;

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

        $parameters = RouteParameters::fromArray([
            'device_type' => DeviceType::IPAD,
            'disable_optimization' => false,
            'route_name' => 'phpunit test',
        ]);

        $optimizationParameters = new OptimizationProblemParams();
        $optimizationParameters->setAddresses($addresses);
        $optimizationParameters->setParameters($parameters);

        $problem = OptimizationProblem::optimize($optimizationParameters);
        $routes = $problem->getRoutes();
        self::$route_id = $routes[0]->route_id;

        $addresses = $problem->addresses;
        self::$address_id = $addresses[1]->getAddressId();
    }

    public function testAddressFromArray()
    {
        $address = Address::fromArray([
            'address' => '10609 Mystic Pointe Dr, Fredericksburg, VA 22407',
            'lat' => 38.2513427734,
            'lng' => -77.5993652344,
            'time' => 300,
            'time_window_end' => 75600,
            'time_window_start' => 28800,
        ]);

        $this->assertEquals($address->address, '10609 Mystic Pointe Dr, Fredericksburg, VA 22407');
        $this->assertEquals($address->lat, 38.2513427734);
        $this->assertEquals($address->lng, -77.5993652344);
        $this->assertEquals($address->time, 300);
        $this->assertEquals($address->time_window_start, 28800);
        $this->assertEquals($address->time_window_end, 75600);
    }

    public function testToArray()
    {
        $address = Address::fromArray([
            'address' => '10609 Mystic Pointe Dr, Fredericksburg, VA 22407',
            'lat' => 38.2513427734,
            'lng' => -77.5993652344,
            'time' => 300,
            'time_window_end' => 75600,
            'time_window_start' => 28800,
            'custom_fields' => [
                'cf_1' => 1,
            ],
        ]);

        $this->assertEquals($address->toArray(), [
            'address' => '10609 Mystic Pointe Dr, Fredericksburg, VA 22407',
            'lat' => 38.2513427734,
            'lng' => -77.5993652344,
            'is_depot' => false,
            'time' => 300,
            'time_window_end' => 75600,
            'time_window_start' => 28800,
            'custom_fields' => [
                'cf_1' => 1,
            ],
        ]);
    }

    /**
     *  @expectedException \Route4Me\Exception\BadParam
     *  @expectedExceptionMessage address must be provided
     **/
    public function testAddressNotProvided()
    {
        $address = Address::fromArray([
            'lat' => 38.2513427734,
            'lng' => -77.5993652344,
        ]);
    }

    /**
     *  @expectedException \Route4Me\Exception\BadParam
     *  @expectedExceptionMessage lat must be provided
     **/
    public function testLatNotProvided()
    {
        $address = Address::fromArray([
            'address' => '10609 Mystic Pointe Dr, Fredericksburg, VA 22407',
        ]);
    }

    /**
     *  @expectedException \Route4Me\Exception\BadParam
     *  @expectedExceptionMessage lng must be provided
     **/
    public function testLngNotProvided()
    {
        $address = Address::fromArray([
            'address' => '10609 Mystic Pointe Dr, Fredericksburg, VA 22407',
            'lat' => 38.2513427734,
        ]);
    }

    public function testAddressFromArrayWithBadKeys()
    {
        $address = Address::fromArray([
            'address' => '10609 Mystic Pointe Dr, Fredericksburg, VA 22407',
            'lat' => 38.2513427734,
            'lng' => -77.5993652344,
            'demoaddress' => '333333',
        ]);

        $this->assertNotNull($address->address);
        $this->assertEquals($address->address, '10609 Mystic Pointe Dr, Fredericksburg, VA 22407');
        $this->assertEquals($address->lat, 38.2513427734);
        $this->assertEquals($address->lng, -77.5993652344);

        $this->assertFalse(property_exists($address, 'demoaddress'));
    }

    public function testGetAddressById()
    {
        $address = Address::getAddress(self::$route_id, self::$address_id);

        $this->assertNotNull($address);
        $this->assertNotNull($address->address);
        $this->assertEquals($address->address, '214 Edgewater Branch Drive 32259');
        $this->assertEquals($address->lat, 30.103567123413);
        $this->assertEquals($address->lng, -81.595352172852);
        $this->assertEquals($address->is_depot, false);

        return $address;
    }

    public function testUpdateAddress()
    {
        $address = Address::getAddress(self::$route_id, self::$address_id);
        $this->assertNotNull($address);

        $address->address = 'Updated address';
        $newAddress = $address->update();

        $this->assertEquals($newAddress->address, 'Updated address');
    }

    public function testDeleteAddress()
    {
        $address = Address::getAddress(self::$route_id, self::$address_id);
        $this->assertNotNull($address);

        $state = $address->delete();
        $this->assertTrue($state);
    }

    /**
     *  @expectedException \Route4Me\Exception\ApiError
     **/
    public function testRemovedAddress()
    {
        Address::getAddress(self::$route_id, self::$address_id);
    }
}
