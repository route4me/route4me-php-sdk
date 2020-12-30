<?php

namespace UnitTestFiles\Test;

use Route4Me\Address;
use Route4Me\Constants;
use Route4Me\Enum\DeviceType;
use Route4Me\Exception\BadParam;
use Route4Me\OptimizationProblem;
use Route4Me\OptimizationProblemParams;
use Route4Me\Route4Me;
use Route4Me\RouteParameters;

class AddressUnitTests extends \PHPUnit\Framework\TestCase {
    protected $address;
    public static $createdAddresses;

    public static $problem;
    public static $problemDest;

    public static $route_id = null;
    public static $address_id = null;
    public static $address_address = null;
    public static $address_lat = null;
    public static $address_lng = null;
    public static $address_is_depot = null;

    public static $addresIdMarkedAsVisited;

    public static $afterAddressId;
    public static $route_id_dest;

    public static function setUpBeforeClass()
    {
        Route4Me::setApiKey(Constants::API_KEY);

        //<editor-fold desc="Prepare Addresses">
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
        //</editor-fold>

        $optimizationParameters = new OptimizationProblemParams();
        $optimizationParameters->setAddresses($addresses);
        $optimizationParameters->setParameters($parameters);

        self::$problem = OptimizationProblem::optimize($optimizationParameters);
        $routes = self::$problem->getRoutes();
        self::$route_id = $routes[0]->route_id;
        self::$createdAddresses = $routes[0]->addresses;

        self::$problemDest = OptimizationProblem::optimize($optimizationParameters);
        $routesDest = self::$problemDest->getRoutes();
        $addressesDest = $routesDest[0]->addresses;
        self::$route_id_dest = $routesDest[0]->route_id;
        self::$afterAddressId = $addressesDest[2]->route_destination_id;

        $addresses = self::$problem->addresses;
        self::$address_id = $addresses[1]->getAddressId();
        self::$address_address = $addresses[1]->address;
        self::$address_lat = $addresses[1]->lat;
        self::$address_lng = $addresses[1]->lng;
        self::$address_is_depot = $addresses[1]->is_depot;

        self::$addresIdMarkedAsVisited = $addresses[2]->getAddressId();

        $params = [
            'route_id'      =>  self::$route_id,
            'address_id'    =>  self::$addresIdMarkedAsVisited,
            'is_visited'    => 1
        ];

        $result =  $addresses[2]->markAsVisited($params);

    }

    public function testAddressFromArray()
    {
        $address = Address::fromArray([
            'address'           => '10609 Mystic Pointe Dr, Fredericksburg, VA 22407',
            'lat'               => 38.2513427734,
            'lng'               => -77.5993652344,
            'time'              => 300,
            'time_window_end'   => 75600,
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
            'address'           => '10609 Mystic Pointe Dr, Fredericksburg, VA 22407',
            'lat'               => 38.2513427734,
            'lng'               => -77.5993652344,
            'time'              => 300,
            'time_window_end'   => 75600,
            'time_window_start' => 28800,
            'custom_fields'     => [
                'cf_1' => 1,
            ],
        ]);

        $this->assertEquals($address->toArray(), [
            'address'           => '10609 Mystic Pointe Dr, Fredericksburg, VA 22407',
            'lat'               => 38.2513427734,
            'lng'               => -77.5993652344,
            'is_depot'          => false,
            'time'              => 300,
            'time_window_end'   => 75600,
            'time_window_start' => 28800,
            'custom_fields'     => [
                'cf_1' => 1,
            ],
        ]);
    }

    public function testBadParameter()
    {
        $this->expectException(BadParam::class);

        $address = Address::fromArray([
            'lat1' => 38.2513427734,
            'lng1' => -77.5993652344,
        ]);

        echo "address: ".$address->lat." <br>";
    }

    public function testAddressFromArrayWithBadKeys()
    {
        $this->expectException(BadParam::class);

        $address = Address::fromArray([
            'address'       => '10609 Mystic Pointe Dr, Fredericksburg, VA 22407',
            'lat'           => 38.2513427734,
            'lng'           => -77.5993652344,
            'demoaddress'   => '333333',
        ]);

        $this->assertNotNull($address->address);
        $this->assertEquals($address->address, '10609 Mystic Pointe Dr, Fredericksburg, VA 22407');
        $this->assertEquals($address->lat, 38.2513427734);
        $this->assertEquals($address->lng, -77.5993652344);

        $this->assertFalse(property_exists($address, 'demoaddress'));
    }

    public function testGetAddress()
    {
        $address = Address::getAddress(self::$route_id, self::$address_id);

        $this->assertNotNull($address);
        $this->assertNotNull($address->address);
        $this->assertEquals($address->address, self::$address_address);
        $this->assertEquals($address->lat, self::$address_lat);
        $this->assertEquals($address->lng, self::$address_lng);
        $this->assertEquals($address->is_depot, self::$address_is_depot);

        return $address;
    }

    public function testUpdateAddress()
    {
        $address = Address::getAddress(self::$route_id, self::$address_id);
        $this->assertNotNull($address);

        $address->route_id = self::$route_id;

        $address->address = 'Updated address';
        $newAddress = $address->update();

        $this->assertEquals($newAddress->address, 'Updated address');
    }

    public function testMarkAsDeparted()
    {
        $address = new Address();

        $params = [
            'route_id'      =>  self::$route_id,
            'address_id'    =>  self::$addresIdMarkedAsVisited,
            'is_departed'   => 1
        ];

        $result = $address->markAsDeparted($params);

        $this->assertNotNull($result);
        $this->assertIsBool($result['status']);
        $this->assertTrue($result['status']);
    }

    public function testMarkAsVisited()
    {
        $address = new Address();

        $params = [
            'route_id'   =>  self::$route_id,
            'address_id' =>  self::$address_id,
            'is_visited' => 1
        ];

        $result = $address->markAsVisited($params);

        $this->assertNotNull($result);
        $this->assertIsInt($result);
        $this->assertEquals(1,$result);
    }

    public function testDeleteAddress()
    {
        $lastAddressId = self::$createdAddresses[sizeof(self::$createdAddresses)-1]->route_destination_id;

        $address = Address::getAddress(self::$route_id, $lastAddressId);
        $this->assertNotNull($address);

        $state = $address->deleteAddress();
        $this->assertTrue($state);

        array_pop(self::$createdAddresses);
    }

    public function testMoveDestinationToRoute()
    {
        $lastAddressId = self::$createdAddresses[sizeof(self::$createdAddresses)-1]->route_destination_id;

        // Move the destination to the route
        $routeParams = [
            'to_route_id'           => self::$route_id_dest,
            'route_destination_id'  => $lastAddressId,
            'after_destination_id'  => self::$afterAddressId,
        ];

        $address = new Address();
        $result = $address->moveDestinationToRoute($routeParams);

        $this->assertNotNull($result);
        $this->assertNotNull($result['success']);
        $this->assertEquals(true,$result['success']);
    }

    public function testChangeRouteDepote()
    {
        $address1 = Address::getAddress(
            self::$route_id,
            self::$createdAddresses[0]->route_destination_id);

        $address1->route_id = self::$route_id;

        $address2 = Address::getAddress(
            self::$route_id,
            self::$createdAddresses[1]->route_destination_id);

        $address2->route_id = self::$route_id;

        $this->assertEquals(true, $address1->is_depot);
        $this->assertEquals(false, $address2->is_depot);

        $address1->is_depot = false;
        $updatedAddress1 = $address1->update();

        $address2->is_depot = true;
        $updatedAddress2 = $address2->update();

        $this->assertEquals(false, $updatedAddress1->is_depot);
        $this->assertEquals(true, $updatedAddress2->is_depot);
    }

    public static function tearDownAfterClass()
    {
        $optimizationProblemId = self:: $problem->optimization_problem_id;
        $destOptimizationProblemId = self::$problemDest->optimization_problem_id;

        $params = [
            'optimization_problem_ids' => [
                '0' => $optimizationProblemId,
                '1' => $destOptimizationProblemId
            ],
            'redirect' => 0,
        ];

        $result = self:: $problem->removeOptimization($params);

        if ($result!=null && $result['status']==true) {
            echo "The test optimization was removed <br>";
        } else {
            echo "Cannot remove the test optimization <br>";
        }
    }
}
