<?php

namespace UnitTestFiles\Test;

use Route4Me\Constants;
use Route4Me\Route4Me;
use Route4Me\V5\Orders\CustomData;
use Route4Me\V5\Orders\CustomField;
use Route4Me\V5\Orders\GPSCoords;
use Route4Me\V5\Orders\LocalTimeWindow;
use Route4Me\V5\Orders\Order;
use Route4Me\V5\Orders\Orders;
use Route4Me\V5\Orders\ResponseOrder;
use Route4Me\V5\Orders\ResponseSearch;

final class OrderUnitTests extends \PHPUnit\Framework\TestCase
{
    public static ?string $created_uuid = null;
    public static ?string $created_field_uuid = null;

    public static function setUpBeforeClass() : void
    {
        Route4Me::setApiKey(Constants::API_KEY);
    }

    public function testCustomDataCanBeCreateEmpty() : void
    {
        $this->assertInstanceOf(CustomData::class, new CustomData());
    }

    public function testCustomDataCanBeCreateFromArray() : void
    {
        $this->assertInstanceOf(CustomData::class, new CustomData([
            'barcode' => '1',
            'airbillno' => '2',
            'sorted_on_date' => '3',
            'sorted_on_utc' => 1
        ]));
    }

    public function testCustomFieldCanBeCreateEmpty() : void
    {
        $this->assertInstanceOf(CustomField::class, new CustomField());
    }

    public function testCustomFieldCanBeCreateFromArray() : void
    {
        $this->assertInstanceOf(CustomField::class, new CustomField([
            'order_custom_field_uuid' => 'uuid',
            'order_custom_field_value' => 'value'
        ]));
    }

    public function testGPSCoordsCanBeCreateEmpty() : void
    {
        $this->assertInstanceOf(GPSCoords::class, new GPSCoords());
    }

    public function testGPSCoordsCanBeCreateByConstructor() : void
    {
        $coords = new GPSCoords(40.5, 90.0);
        $this->assertInstanceOf(GPSCoords::class, $coords);
        $this->assertEquals($coords->lat, 40.5);
        $this->assertEquals($coords->lng, 90.0);
    }

    public function testGPSCoordsCanBeCreateFromArray() : void
    {
        $coords = new GPSCoords([
            'lat' => 40.5,
            'lng' => 90.0
        ]);
        $this->assertInstanceOf(GPSCoords::class, $coords);
        $this->assertEquals($coords->lat, 40.5);
        $this->assertEquals($coords->lng, 90.0);
    }

    public function testLocalTimeWindowCanBeCreateEmpty() : void
    {
        $this->assertInstanceOf(LocalTimeWindow::class, new LocalTimeWindow());
    }

    public function testLocalTimeWindowCanBeCreateByConstructor() : void
    {
        $coords = new LocalTimeWindow(1, 2);
        $this->assertInstanceOf(LocalTimeWindow::class, $coords);
        $this->assertEquals($coords->start, 1);
        $this->assertEquals($coords->end, 2);
    }

    public function testLocalTimeWindowCanBeCreateFromArray() : void
    {
        $coords = new LocalTimeWindow([
            'start' => 1,
            'end' => 2
        ]);
        $this->assertInstanceOf(LocalTimeWindow::class, $coords);
        $this->assertEquals($coords->start, 1);
        $this->assertEquals($coords->end, 2);
    }

    public function testOrderCanBeCreateEmpty() : void
    {
        $this->assertInstanceOf(Order::class, new Order());
    }

    public function testOrderCanBeCreateFromArray() : void
    {
        $order = new Order([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'some@company.com'
        ]);
        $this->assertInstanceOf(Order::class, $order);
        $this->assertEquals($order->first_name, 'John');
        $this->assertEquals($order->last_name, 'Doe');
    }

    public function testResponseOrderCanBeCreateEmpty() : void
    {
        $this->assertInstanceOf(Order::class, new Order());
    }

    public function testResponseOrderCanBeCreateFromArray() : void
    {
        $order = new ResponseOrder([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'some@company.com'
        ]);
        $this->assertInstanceOf(ResponseOrder::class, $order);
        $this->assertEquals($order->first_name, 'John');
        $this->assertEquals($order->last_name, 'Doe');
    }

    public function testCreateMustReturnResponseOrder() : void
    {
        $orders = new Orders();
        $order = $orders->create([
            'address_1' => '1358 E Luzerne St, Philadelphia, PA 19124, US',
            'address_alias' => 'Auto test address',
            'address_city' => 'Philadelphia',
            'address_geo' => [
                'lat' => 48.335991,
                'lng' => 31.18287
            ],
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'some@company.com'
        ]);

        $this->assertInstanceOf(ResponseOrder::class, $order);
        $this->assertNotNull($order->first_name);
        $this->assertEquals($order->first_name, 'John');
        
        self::$created_uuid = $order->order_uuid;
    }

    public function testGetMustReturnResponseOrder() : void
    {
        if (self::$created_uuid !== null) {
            $orders = new Orders();
            $order = $orders->get(self::$created_uuid);

            $this->assertInstanceOf(ResponseOrder::class, $order);
            $this->assertNotNull($order->first_name);
            $this->assertEquals($order->first_name, 'John');
        }
    }

    public function testUpdateMustReturnResponseOrder() : void
    {
        if (self::$created_uuid !== null) {
            $orders = new Orders();
            $order = $orders->update(self::$created_uuid, ['first_name' => 'Jane']);

            $this->assertInstanceOf(ResponseOrder::class, $order);
            $this->assertNotNull($order->first_name);
            $this->assertEquals($order->first_name, 'Jane');
        }
    }

    public function testSearchMustReturnResponseSearchWithoutParams() : void
    {
        $orders = new Orders();
        $res = $orders->search();

        $this->assertInstanceOf(ResponseSearch::class, $res);
        $this->assertNotNull($res->total);
    }

    public function testSearchMustReturnResponseSearchWithParams() : void
    {
        if (self::$created_uuid !== null) {
            $orders = new Orders();
            $params = [
                "filters" => [
                    "order_ids" => [self::$created_uuid]
                ]
            ];
            $res = $orders->search($params);

            $this->assertInstanceOf(ResponseSearch::class, $res);
            $this->assertNotNull($res->total);
            $this->assertNotNull($res->results);
        }
    }

    public function testBatchCreateMustReturnTrue() : void
    {
        $this->markTestSkipped('must be revisited, cannot get back IDs or created Orders.');

        $orders = new Orders();
        $params = [
            [
                'address_1' => '1358 E Luzerne St, Philadelphia, PA 19124, US',
                'address_alias' => 'Address for batch workflow 0',
                'address_city' => 'Philadelphia',
                'address_geo' => [
                    'lat' => 48.335991,
                    'lng' => 31.18287
                ],
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'some@company.com'
            ], [
                'address_1' => '1358 E Luzerne St, Philadelphia, PA 19124, US',
                'address_alias' => 'Address for batch workflow 1',
                'address_city' => 'Philadelphia',
                'address_geo' => [
                    'lat' => 48.335991,
                    'lng' => 31.18287
                ],
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'some@company.com'
            ]
        ];
        $res = $orders->batchCreate($params);

        $this->assertIsBool($res);
        $this->assertTrue($res);
    }

    public function testBatchUpdateMustReturnArray() : void
    {
        $this->markTestSkipped('must be revisited, cannot get back IDs or created Orders.');

        $orders = new Orders();
        $orderIds = ['', ''];
        $data = [
            'first_name' => 'Jane'
        ];
        $res = $orders->batchUpdate($orderIds, $data);

        $this->assertIsArray($res);
    }

    public function testBatchUpdateByFiltersMustReturnTrue() : void
    {
        $this->markTestSkipped('must be revisited, cannot get back IDs or created Orders.');

        $orders = new Orders();
        $params = [
            'data' => [
                'first_name' => 'John'
            ],
            'filters' => [
                'orderIds' => ['', '']
            ]
        ];
        $res = $orders->batchUpdateByFilters($params);

        $this->assertIsBool($res);
        $this->assertTrue($res);
    }

    public function testBatchDeleteMustReturnTrue() : void
    {
        $this->markTestSkipped('must be revisited, cannot get back IDs or created Orders.');

        $orders = new Orders();
        $orderIds = ['', ''];
        $res = $orders->batchDelete($orderIds);

        $this->assertIsBool($res);
        $this->assertTrue($res);
    }

    public function testGetOrderCustomFieldsReturnArray() : void
    {
        $orders = new Orders();
        $res = $orders->getOrderCustomFields();

        $this->assertIsArray($res);
    }

    public function testCreateOrderCustomFieldMustReturnCustomField() : void
    {
        $orders = new Orders();
        $field = $orders->createOrderCustomField([
            'order_custom_field_name' => 'CustomField1',
            'order_custom_field_label' => 'Custom Field 1',
            'order_custom_field_type' => 'checkbox',
            'order_custom_field_type_info' => [
                'short_label' => 'cFl1'
            ]
        ]);

        $this->assertInstanceOf(CustomField::class, $field);
        $this->assertNotNull($field->order_custom_field_label);
        $this->assertEquals($field->order_custom_field_label, 'Custom Field 1');
        
        self::$created_field_uuid = $field->order_custom_field_uuid;
    }

    public function testUpdateOrderCustomFieldMustReturnCustomField() : void
    {
        if (self::$created_field_uuid !== null) {
            $orders = new Orders();
            $field = $orders->updateOrderCustomField(self::$created_field_uuid, [
                'order_custom_field_label' => 'Custom Field New',
                'order_custom_field_type' => 'checkbox',
                'order_custom_field_type_info' => [
                    'short_label' => 'cFl1'
                ]
            ]);

            $this->assertInstanceOf(CustomField::class, $field);
            $this->assertNotNull($field->order_custom_field_label);
            $this->assertEquals($field->order_custom_field_label, 'Custom Field New');
        }
    }

    public function testDeleteOrderCustomFieldMustReturnCustomField() : void
    {
        if (self::$created_field_uuid !== null) {
            $orders = new Orders();
            $field = $orders->deleteOrderCustomField(self::$created_field_uuid);

            $this->assertInstanceOf(CustomField::class, $field);
            self::$created_field_uuid = null;
        }
    }

    public function testDeleteMustReturnTrue() : void
    {
        if (self::$created_uuid !== null) {
            $orders = new Orders();
            $result = $orders->delete(self::$created_uuid);

            $this->assertTrue($result);
            self::$created_uuid = null;
        }
    }

    public static function tearDownAfterClass() : void
    {
        sleep(1);

        if (self::$created_uuid !== null || self::$created_field_uuid !== null) {
            $orders = new Orders();
            if (self::$created_uuid !== null) {
                $orders->delete(self::$created_uuid);
            }
            if (self::$created_field_uuid !== null) {
                $orders->deleteOrderCustomField(self::$created_field_uuid);
            }
        }
    }
}
