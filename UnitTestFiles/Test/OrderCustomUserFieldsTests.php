<?php

namespace UnitTestFiles\Test;

use Route4Me\Constants;
use Route4Me\OrderCustomField;
use Route4Me\Route4Me;

class OrderCustomUserFieldsTests extends \PHPUnit\Framework\TestCase
{
    public static $createdCustomUserFields = [];

    public static function setUpBeforeClass()
    {
        Route4Me::setApiKey(Constants::API_KEY);

        $orderCustomField = new OrderCustomField();

        $orderCustomFieldParameters = OrderCustomField::fromArray([]);

        $response = $orderCustomField->getOrderCustomUserFields($orderCustomFieldParameters);

        $field333Exists = false;
        $field444Id = null;

        foreach ($response as $userCustomField) {
            if ($userCustomField['order_custom_field_name']=='CustomField333') {
                $field333Exists = true;
            }

            if ($userCustomField['order_custom_field_name']=='CustomField444') {
                $field444Id = $userCustomField['order_custom_field_id'];
            }
        }

        if (!$field333Exists) {
            $orderCustomFieldParameters = OrderCustomField::fromArray([
                'order_custom_field_name'      => 'CustomField333',
                'order_custom_field_label'     => 'Custom Field 333',
                'order_custom_field_type'      => 'checkbox',
                'order_custom_field_type_info' => ['short_label' => 'cFl333']
            ]);

            $newField = $orderCustomField->addOrderCustomUserField($orderCustomFieldParameters);

            if (!is_null($newField) && isset($newField['result']) && $newField['result']=='OK') {
                self::$createdCustomUserFields[] = $newField['data']['order_custom_field_id'];
            }
        }

        if ($field444Id!=null) {
            $orderCustomFieldParameters = OrderCustomField::fromArray([
                'order_custom_field_id' => $field444Id
            ]);

            $response = $orderCustomField->removeOrderCustomUserField($orderCustomFieldParameters);

            if (!is_null($response) &&
                isset($response['result']) &&
                $response['result']=='OK' &&
                $response['affected']==1) {
                echo "The order custom user field $field444Id removed <br>";
            }
        }
    }

    public function testFromArray()
    {
        $orderCustomFields = OrderCustomField::fromArray([
            'order_custom_field_name'      => 'CustomField4',
            'order_custom_field_label'     => 'Custom Field 4',
            'order_custom_field_type'      => 'checkbox',
            'order_custom_field_type_info' => ['short_label' => 'cFl4']
        ]);

        $this->assertEquals('CustomField4', $orderCustomFields->order_custom_field_name);
        $this->assertEquals('Custom Field 4', $orderCustomFields->order_custom_field_label);
        $this->assertEquals('checkbox', $orderCustomFields->order_custom_field_type);
        $this->assertEquals(['short_label' => 'cFl4'], $orderCustomFields->order_custom_field_type_info);
    }

    public function testToArray()
    {
        $orderCustomFields = OrderCustomField::fromArray([
            'order_custom_field_name'      => 'CustomField4',
            'order_custom_field_label'     => 'Custom Field 4',
            'order_custom_field_type'      => 'checkbox',
            'order_custom_field_type_info' => ['short_label' => 'cFl4']
        ]);

        $this->assertEquals($orderCustomFields->toArray(),
            [
                'order_custom_field_name'      => 'CustomField4',
                'order_custom_field_label'     => 'Custom Field 4',
                'order_custom_field_type'      => 'checkbox',
                'order_custom_field_type_info' => ['short_label' => 'cFl4']
            ]
        );
    }

    public function testGetOrderCustomUserFields()
    {
        $orderCustomField = new OrderCustomField();

        $orderCustomFieldParameters = OrderCustomField::fromArray([]);

        $response = $orderCustomField->getOrderCustomUserFields($orderCustomFieldParameters);

        $this->assertNotNull($response);
        $this->assertTrue(is_array($response));
        $this->assertInstanceOf(OrderCustomField::class, OrderCustomField::fromArray($response[0]));
    }

    public function testAddOrderCustomUserField()
    {
        $orderCustomField = new OrderCustomField();

        $orderCustomFieldParameters = OrderCustomField::fromArray([
            'order_custom_field_name'      => 'CustomField444',
            'order_custom_field_label'     => 'Custom Field 444',
            'order_custom_field_type'      => 'checkbox',
            'order_custom_field_type_info' => ['short_label' => 'cFl444']
        ]);

        $response = $orderCustomField->addOrderCustomUserField($orderCustomFieldParameters);

        $this->assertNotNull($response);
        $this->assertTrue(isset($response['result']));
        $this->assertEquals('OK', $response['result']);

        self::$createdCustomUserFields[] = $response['data']['order_custom_field_id'];
    }

    public function testUpdateOrderCustomUserField()
    {
        $orderCustomField = new OrderCustomField();

        $orderCustomFieldParameters = OrderCustomField::fromArray([
            'order_custom_field_id'        => self::$createdCustomUserFields[0],
            'order_custom_field_label'     => 'Custom Field 333 Updated',
            'order_custom_field_type'      => 'checkbox',
            'order_custom_field_type_info' => ['short_label' => 'cFl333']
        ]);

        $response = $orderCustomField->updateOrderCustomUserField($orderCustomFieldParameters);

        $this->assertNotNull($response);
        $this->assertTrue(isset($response['result']));
        $this->assertEquals('OK', $response['result']);

        $this->assertEquals('Custom Field 333 Updated', $response['data']['order_custom_field_label']);
    }

    public function testRemoveOrderCustomUserField()
    {
        $orderCustomField = new OrderCustomField();

        $orderCustomFieldParameters = OrderCustomField::fromArray([
            'order_custom_field_id' => self::$createdCustomUserFields[0]
        ]);

        $response = $orderCustomField->removeOrderCustomUserField($orderCustomFieldParameters);

        $this->assertNotNull($response);
        $this->assertTrue(isset($response['result']));
        $this->assertEquals('OK', $response['result']);
        $this->assertTrue(isset($response['affected']));
        $this->assertEquals(1, $response['affected']);

        array_shift(self::$createdCustomUserFields);
    }

    public static function tearDownAfterClass()
    {
        if (sizeof(self::$createdCustomUserFields)>0) {
            $orderCustomField = new OrderCustomField();

            foreach (self::$createdCustomUserFields as $customFieldId) {
                $orderCustomFieldParameters = OrderCustomField::fromArray([
                    'order_custom_field_id' => $customFieldId
                ]);

                $response = $orderCustomField->removeOrderCustomUserField($orderCustomFieldParameters);

                if (!is_null($response) &&
                    isset($response['result']) &&
                    $response['result']=='OK' &&
                    $response['affected']==1) {
                        echo "The order custom user field $customFieldId removed <br>";
                }
            }
        }
    }
}