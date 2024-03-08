<?php

namespace UnitTestFiles\Test;

use Route4Me\Address;
use Route4Me\AddressBundling;
use Route4Me\Constants;
use Route4Me\Enum\AlgorithmType;
use Route4Me\Enum\DeviceType;
use Route4Me\Enum\DistanceUnit;
use Route4Me\Enum\Metric;
use Route4Me\Enum\OptimizationType;
use Route4Me\OptimizationProblem;
use Route4Me\OptimizationProblemParams;
use Route4Me\Order;
use Route4Me\OrderCustomField;
use Route4Me\Route;
use Route4Me\Route4Me;
use Route4Me\RouteParameters;

class OrderTests extends \PHPUnit\Framework\TestCase
{
    public static $createdOrders = [];
    public static $createdProblems = [];

    public static function setUpBeforeClass()
    {
        Route4Me::setApiKey(Constants::API_KEY);

        //region -- Create Test Optimization --

        // Huge list of addresses
        $json = json_decode(file_get_contents(dirname(__FILE__).'/data/addresses.json'), true);
        $json = array_slice($json, 0, 10);

        $addresses = [];
        foreach ($json as $address) {
            $addresses[] = Address::fromArray($address);
        }

        $parameters = RouteParameters::fromArray([
            'algorithm_type'    => Algorithmtype::TSP,
            'route_name'        => 'Single Driver Multiple TW 10 Stops '.date('Y-m-d H:i'),
            'route_date'        => time() + 24 * 60 * 60,
            'route_time'        => 5 * 3600 + 30 * 60,
            'distance_unit'     => DistanceUnit::MILES,
            'device_type'       => DeviceType::WEB,
            'optimize'          => OptimizationType::DISTANCE,
            'metric'            => Metric::GEODESIC,
        ]);

        $optimizationParams = new OptimizationProblemParams();
        $optimizationParams->setAddresses($addresses);
        $optimizationParams->setParameters($parameters);

        $problem = OptimizationProblem::optimize($optimizationParams);

        self::$createdProblems[] = $problem;

        //endregion

        //region -- Create Test Order --

        $orderParameters = Order::fromArray([
            'address_1'                 => '1358 E Luzerne St, Philadelphia, PA 19124, US',
            'cached_lat'                => 48.335991,
            'cached_lng'                => 31.18287,
            'address_alias'             => 'Auto test address',
            'address_city'              => 'Philadelphia',
            'day_scheduled_for_YYMMDD'  => date('Y-m-d'),
            'EXT_FIELD_first_name'      => 'Igor',
            'EXT_FIELD_last_name'       => 'Progman',
            'EXT_FIELD_email'           => 'progman@gmail.com',
            'EXT_FIELD_phone'           => '380380380380',
            'EXT_FIELD_custom_data'     => [
                0 => [
                    'order_id'  => '10',
                    'name'      => 'Bill Soul',
                ],
            ],
        ]);

        $order = new Order();

        $response = $order->addOrder($orderParameters);

        self::assertNotNull($response);
        self::assertInstanceOf(Order::class, Order::fromArray($response));

        self::$createdOrders[] = $response;

        //endregion
    }

    public function testFromArray()
    {
        $orderParameters = Order::fromArray([
            'address_1'                 => '1358 E Luzerne St, Philadelphia, PA 19124, US',
            'cached_lat'                => 48.335991,
            'cached_lng'                => 31.18287,
            'address_alias'             => 'Auto test address',
            'address_city'              => 'Philadelphia',
            'day_scheduled_for_YYMMDD'  => date('Y-m-d'),
            'EXT_FIELD_first_name'      => 'Igor',
            'EXT_FIELD_last_name'       => 'Progman',
            'EXT_FIELD_email'           => 'progman@gmail.com',
            'EXT_FIELD_phone'           => '380380380380',
            'EXT_FIELD_custom_data'     => [
                0 => [
                    'order_id'  => '10',
                    'name'      => 'Bill Soul',
                ],
            ],
            'EXT_FIELD_cost'            => 50
        ]);

        $this->assertEquals('1358 E Luzerne St, Philadelphia, PA 19124, US', $orderParameters->address_1);
        $this->assertEquals(48.335991, $orderParameters->cached_lat);
        $this->assertEquals(31.18287, $orderParameters->cached_lng);
        $this->assertEquals('Auto test address', $orderParameters->address_alias);
        $this->assertEquals('Philadelphia', $orderParameters->address_city);
        $this->assertEquals(date('Y-m-d'), $orderParameters->day_scheduled_for_YYMMDD);
        $this->assertEquals('Igor', $orderParameters->EXT_FIELD_first_name);
        $this->assertEquals('Progman', $orderParameters->EXT_FIELD_last_name);
        $this->assertEquals('progman@gmail.com', $orderParameters->EXT_FIELD_email);
        $this->assertEquals('380380380380', $orderParameters->EXT_FIELD_phone);
        $this->assertEquals([
            0 => [
                'order_id'  => '10',
                'name'      => 'Bill Soul',
            ],
        ], $orderParameters->EXT_FIELD_custom_data);
        $this->assertEquals(50, $orderParameters->EXT_FIELD_cost);
    }

    public function testToArray()
    {
        $orderParameters = Order::fromArray([
            'address_1'                 => '1358 E Luzerne St, Philadelphia, PA 19124, US',
            'cached_lat'                => 48.335991,
            'cached_lng'                => 31.18287,
            'address_alias'             => 'Auto test address',
            'address_city'              => 'Philadelphia',
            'day_scheduled_for_YYMMDD'  => date('Y-m-d'),
            'EXT_FIELD_first_name'      => 'Igor',
            'EXT_FIELD_last_name'       => 'Progman',
            'EXT_FIELD_email'           => 'progman@gmail.com',
            'EXT_FIELD_phone'           => '380380380380',
            'EXT_FIELD_custom_data'     => [
                0 => [
                    'order_id'  => '10',
                    'name'      => 'Bill Soul',
                ],
            ],
        ]);

        $this->assertEquals(
            $orderParameters->toArray(),
            [
                'address_1'                 => '1358 E Luzerne St, Philadelphia, PA 19124, US',
                'cached_lat'                => 48.335991,
                'cached_lng'                => 31.18287,
                'address_alias'             => 'Auto test address',
                'address_city'              => 'Philadelphia',
                'day_scheduled_for_YYMMDD'  => date('Y-m-d'),
                'EXT_FIELD_first_name'      => 'Igor',
                'EXT_FIELD_last_name'       => 'Progman',
                'EXT_FIELD_email'           => 'progman@gmail.com',
                'EXT_FIELD_phone'           => '380380380380',
                'EXT_FIELD_custom_data'     => [
                    0 => [
                        'order_id'  => '10',
                        'name'      => 'Bill Soul',
                    ],
                ],
            ],
        ]);
    }

    public function testGetOrders()
    {
        $order = new Order();

        $orderParameters = Order::fromArray([
            'offset'    => 0,
            'limit'     => 5,
        ]);

        $response = $order->getOrders($orderParameters);

        $this->assertNotNull($response);
        $this->assertTrue(is_array($response));
        $this->assertTrue(isset($response['total']));
        $this->assertTrue(isset($response['results']));
        $this->assertInstanceOf(
            Order::class,
            Order::fromArray($response['results'][0])
        );
    }

    public function testCreateNewOrder()
    {
        $orderParameters = Order::fromArray([
            'address_1'                 => '106 Liberty St, New York, NY 10006, USA',
            'address_alias'             => 'BK Restaurant #: 2446',
            'cached_lat'                => 40.709637,
            'cached_lng'                => -74.011912,
            'curbside_lat'              => 40.709637,
            'curbside_lng'              => -74.011912,
            'address_city'              => 'New York',
            'EXT_FIELD_first_name'      => 'Lui',
            'EXT_FIELD_last_name'       => 'Carol',
            'EXT_FIELD_email'           => 'lcarol654@yahoo.com',
            'EXT_FIELD_phone'           => '897946541',
            'local_time_window_end'     => 39000,
            'local_time_window_end_2'   => 46200,
            'local_time_window_start'   => 37800,
            'local_time_window_start_2' => 45000,
            'local_timezone_string'     => 'America/New_York',
            'order_icon'                => 'emoji/emoji-bank',
        ]);

        $order = new Order();

        $response = $order->addOrder($orderParameters);

        self::assertNotNull($response);
        self::assertInstanceOf(Order::class, Order::fromArray($response));

        self::$createdOrders[] = $response;
    }

    public function testAddOrdersToOptimization()
    {
        $body = json_decode(file_get_contents(dirname(__FILE__).'/data/add_order_to_optimization_data.json'), true);

        $optimizationProblemId = self::$createdProblems[0]->optimization_problem_id;

        $orderParameters = [
            'optimization_problem_id'   => $optimizationProblemId,
            'redirect'                  => 0,
            'device_type'               => 'web',
            'addresses'                 => $body['addresses'],
        ];

        $order = new Order();

        $response = $order->addOrder2Optimization($orderParameters);

        self::assertNotNull($response);
        self::assertInstanceOf(OptimizationProblem::class, OptimizationProblem::fromArray($response));
    }

    public function testAddOrdersToRoute()
    {
        $this->markTestSkipped('Read old data.');

        $body = json_decode(file_get_contents(dirname(__FILE__).'/data/add_order_to_route_data.json'), true);

        $routeId = self::$createdProblems[0]->routes[0]->route_id;

        $orderParameters = Order::fromArray([
            'route_id'  => $routeId,
            'redirect'  => 0,
            'addresses' => $body['addresses'],
        ]);

        $order = new Order();

        $response = $order->addOrder2Route($orderParameters);

        self::assertNotNull($response);
        self::assertInstanceOf(Route::class, Route::fromArray($response));
    }

    public function testAddScheduledOrder()
    {
        $orderParameters = Order::fromArray([
            'address_1'                 => '318 S 39th St, Louisville, KY 40212, USA',
            'cached_lat'                => 38.259326,
            'cached_lng'                => -85.814979,
            'curbside_lat'              => 38.259326,
            'curbside_lng'              => -85.814979,
            'address_alias'             => '318 S 39th St 40212',
            'address_city'              => 'Louisville',
            'EXT_FIELD_first_name'      => 'Lui',
            'EXT_FIELD_last_name'       => 'Carol',
            'EXT_FIELD_email'           => 'lcarol654@yahoo.com',
            'EXT_FIELD_phone'           => '897946541',
            'EXT_FIELD_custom_data'     => ['order_type' => 'scheduled order'],
            'day_scheduled_for_YYMMDD'  => date('Y-m-d'),
            'local_time_window_end'     => 39000,
            'local_time_window_end_2'   => 46200,
            'local_time_window_start'   => 37800,
            'local_time_window_start_2' => 45000,
            'local_timezone_string'     => 'America/New_York',
            'order_icon'                => 'emoji/emoji-bank',
        ]);

        $order = new Order();

        $response = $order->addOrder($orderParameters);

        self::assertNotNull($response);
        self::assertInstanceOf(Order::class, Order::fromArray($response));

        self::$createdOrders[] = $response;
    }

    public function testCreateOrderWithCustomField()
    {
        $orderParameters = Order::fromArray([
            'address_1'                => '1358 E Luzerne St, Philadelphia, PA 19124, US',
            'cached_lat'               => 48.335991,
            'cached_lng'               => 31.18287,
            'day_scheduled_for_YYMMDD' => '2019-10-11',
            'address_alias'            => 'Auto test address',
            'custom_user_fields' => [
                OrderCustomField::fromArray([
                    'order_custom_field_id'    => 93,
                    'order_custom_field_value' => 'false'
                ])
            ]
        ]);

        $order = new Order();

        $response = $order->addOrder($orderParameters);

        self::assertNotNull($response);
        self::assertInstanceOf(Order::class, Order::fromArray($response));
        $this->assertEquals(93, $response['custom_user_fields'][0]['order_custom_field_id']);
        $this->assertEquals(false, $response['custom_user_fields'][0]['order_custom_field_value']);

        self::$createdOrders[] = $response;
    }

    public function testGetOrderByID()
    {
        $order = new Order();

        $orderID = self::$createdOrders[0]['order_id'];

        // Get an order
        $orderParameters = Order::fromArray([
            'order_id' => $orderID,
        ]);

        $response = $order->getOrder($orderParameters);

        self::assertNotNull($response);
        self::assertInstanceOf(Order::class, Order::fromArray($response));
    }

    public function testGetOrderByUUID()
    {
        $order = new Order();

        $orderUUID = self::$createdOrders[0]['order_uuid'];

        // Get an order
        $orderParameters = Order::fromArray([
            'order_id' => $orderUUID,
        ]);

        $response = $order->getOrder($orderParameters);

        self::assertNotNull($response);
        self::assertInstanceOf(Order::class, Order::fromArray($response));
    }

    public function testGetOrderByInsertedDate()
    {
        $orderParameters = Order::fromArray([
            'day_added_YYMMDD'  => date('Y-m-d', strtotime('0 days')),
            'offset'            => 0,
            'limit'             => 5,
        ]);

        $order = new Order();

        $response = $order->getOrder($orderParameters);

        $this->assertNotNull($response);
        $this->assertTrue(is_array($response));
        $this->assertTrue(isset($response['total']));
        $this->assertTrue(isset($response['results']));
        $this->assertInstanceOf(
            Order::class,
            Order::fromArray($response['results'][0])
        );
    }

    public function testGetOrderByScheduledDate()
    {
        $orderParameters = Order::fromArray([
            'day_scheduled_for_YYMMDD'  => date('Y-m-d', strtotime('0 days')),
            'offset'                    => 0,
            'limit'                     => 5,
        ]);

        $order = new Order();

        $response = $order->getOrder($orderParameters);

        $this->assertNotNull($response);
        $this->assertTrue(is_array($response));
        $this->assertTrue(isset($response['total']));
        $this->assertTrue(isset($response['results']));
        $this->assertInstanceOf(
            Order::class,
            Order::fromArray($response['results'][0])
        );
    }

    public function testGetOrdersByCustomFields()
    {
        $orderParameters = Order::fromArray([
            'fields'    => 'order_id,member_id',
            'offset'    => 0,
            'limit'     => 5,
        ]);

        $order = new Order();

        $response = $order->getOrder($orderParameters);

        $response = $order->getOrder($orderParameters);

        $this->assertNotNull($response);
        $this->assertTrue(is_array($response));
        $this->assertTrue(isset($response['total']));
        $this->assertTrue(isset($response['results']));
        $this->assertTrue(isset($response['fields']));
        $this->assertInstanceOf(
            Order::class,
            Order::fromArray($response['results'][0])
        );
    }

    public function testGetOrdersByScheduleFilter()
    {
        $orderParameters = Order::fromArray([
            'limit'  => 5,
            'filter' => [
                'display'               => 'all',
                'scheduled_for_YYMMDD'  => [
                    date('Y-m-d', strtotime('-1 days')),
                    date('Y-m-d', strtotime('1 days'))
                ]
            ]
        ]);

        $order = new Order();

        $response = $order->getOrder($orderParameters);

        $this->assertNotNull($response);
        $this->assertTrue(is_array($response));
        $this->assertTrue(isset($response['total']));
        $this->assertTrue(isset($response['results']));
        $this->assertInstanceOf(
            Order::class,
            Order::fromArray($response['results'][0])
        );
    }

    public function testGetOrdersBySpecifiedText()
    {
        $orderParameters = Order::fromArray([
            'query'     => 'Auto test',
            'offset'    => 0,
            'limit'     => 5,
        ]);

        $order = new Order();

        $response = $order->getOrder($orderParameters);

        $this->assertNotNull($response);
        $this->assertTrue(is_array($response));
        $this->assertTrue(isset($response['total']));
        $this->assertTrue(isset($response['results']));
        $this->assertInstanceOf(
            Order::class,
            Order::fromArray($response['results'][0])
        );
    }

    public function testUpdateOrder()
    {
        $order = new Order();

        // Update the order
        self::$createdOrders[0]['address_2'] = 'Lviv';
        self::$createdOrders[0]['EXT_FIELD_phone'] = '032268593';
        self::$createdOrders[0]['EXT_FIELD_custom_data'] = [
            0 => [
                'customer_no' => '11',
            ],
        ];

        $response = $order->updateOrder(self::$createdOrders[0]);

        $this->assertNotNull($response);
        $this->assertInstanceOf(Order::class, Order::fromArray($response));
        $this->assertEquals('Lviv', $response['address_2']);
        $this->assertEquals('032268593', $response['EXT_FIELD_phone']);
        $this->assertEquals(
            [
                0 => '{"order_id":"10","name":"Bill Soul"}'
            ],
            $response['EXT_FIELD_custom_data']
        );
    }

    public function testUpdateOrderWithCustomFiel()
    {
        $orderParameters = Order::fromArray([
            'order_id'              => self::$createdOrders[0]['order_id'],
            'custom_user_fields'    => [
                OrderCustomField::fromArray([
                    'order_custom_field_id'    => 93,
                    'order_custom_field_value' => 'true'
                ])
            ]
        ]);

        $order = new Order();

        $response = $order->updateOrder($orderParameters);

        $this->assertNotNull($response);
        $this->assertInstanceOf(Order::class, Order::fromArray($response));
        $this->assertEquals(93, $response['custom_user_fields'][0]['order_custom_field_id']);
        $this->assertEquals(true, $response['custom_user_fields'][0]['order_custom_field_value']);
    }

    public function testDeleteOrderByUuid()
    {
        $lastOrder = array_pop(self::$createdOrders);
        if ($lastOrder != null) {
            $order = new Order();
            $ids = [
                "order_ids" => [$lastOrder['order_uuid']]
            ];

            $response = $order->removeOrder($ids);

            if (!is_null($response) && isset($response['status']) && $response['status']) {
                echo "The test order removed by UUID <br>";
            }
        }
    }

    public static function tearDownAfterClass()
    {
        if (sizeof(self::$createdOrders)) {
            $orderIDs = [];

            foreach (self::$createdOrders as $ord) {
                $orderIDs[] = $ord['order_id'];
            }

            $orderParameters = Order::fromArray([
                'order_ids' => $orderIDs
            ]);

            $order = new Order();

            $response = $order->removeOrder($orderParameters);

            if (!is_null($response) &&
                isset($response['status']) &&
                $response['status']) {
                echo "The test orders removed <br>";
            }
        }

        if (sizeof(self::$createdProblems)>0) {
            $optimizationProblemIDs = [];

            foreach (self::$createdProblems as $problem) {
                $optimizationProblemId = $problem->optimization_problem_id;

                $optimizationProblemIDs[] = $optimizationProblemId;
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
    }
}
