<?php
namespace Route4Me;

use Route4Me\Enum\Endpoint;

class OrderCustomField extends Common
{
    public $order_custom_field_id;
    public $order_custom_field_name;
    public $order_custom_field_label;
    public $order_custom_field_type;
    public $order_custom_field_value;
    public $root_owner_member_id;
    public $order_custom_field_type_info;

    public function __construct()
    {
        Route4Me::setBaseUrl(Endpoint::BASE_URL);
    }

    public static function fromArray(array $params)
    {
        $orderCustomField = new self();
        foreach ($params as $key => $value) {
            if (property_exists($orderCustomField, $key)) {
                $orderCustomField->{$key} = $value;
            }
        }

        return $orderCustomField;
    }

    public static function addOrderCustomUserField($params)
    {
        $excludeFields = ['order_custom_field_id'];

        $allBodyFields = Route4Me::getObjectProperties(new self(), $excludeFields);

        $response = Route4Me::makeRequst([
            'url' => Endpoint::ORDER_CUSTOM_FIELDS_V4,
            'method' => 'POST',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params),
        ]);

        return $response;
    }

    public static function getOrderCustomUserFields($params)
    {
        $allQueryFields = [];

        $response = Route4Me::makeRequst([
            'url' => Endpoint::ORDER_CUSTOM_FIELDS_V4,
            'method' => 'GET',
            'query' => Route4Me::generateRequestParameters($allQueryFields, $params),
        ]);

        return $response;
    }

    public static function updateOrderCustomUserField($params)
    {
        $excludeFields = ['order_custom_field_name'];

        $allBodyFields = Route4Me::getObjectProperties(new self(), $excludeFields);

        $response = Route4Me::makeRequst([
            'url' => Endpoint::ORDER_CUSTOM_FIELDS_V4,
            'method' => 'PUT',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params),
        ]);

        return $response;
    }

    public static function removeOrderCustomUserField($params)
    {
        $excludeFields = [
            'order_custom_field_name',
            'order_custom_field_type',
            'order_custom_field_label',
            'order_custom_field_type_info',
            'root_owner_member_id'
        ];

        $allBodyFields = Route4Me::getObjectProperties(new self(), $excludeFields);

        $response = Route4Me::makeRequst([
            'url' => Endpoint::ORDER_CUSTOM_FIELDS_V4,
            'method' => 'DELETE',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params),
        ]);

        return $response;
    }
}