<?php


namespace Route4Me\Tracking;


class FindAssetResponse extends \Route4Me\Common
{
    public $tracking_number;
    public $large_logo_uri;
    public $large_logo_uri_2x;
    public $mobile_logo_uri;
    public $mobile_logo_uri_2x;
    public $map_color;
    public $large_logo_alignment;
    public $mobile_logo_alignment;
    public $show_map_zoom_controls;
    public $customer_service_phone;
    public $hide_covid19_warning;
    public $driver_phone;
    public $route_started;
    public $driver_name;
    public $driver_picture;
    public $tracking_page_subheadline;
    public $destination_address_1;
    public $destination_address_2;
    public $delivered;
    public $status_history = [];
    public $locations = [];
    public $custom_data;
    public $arrival = [];

    public static function fromArray(array $params)
    {
        $findAssetResponse = new self();

        foreach ($params as $key => $value) {
            if (property_exists($findAssetResponse, $key)) {
                $findAssetResponse->{$key} = $value;
            }
        }

        return $findAssetResponse;
    }
}