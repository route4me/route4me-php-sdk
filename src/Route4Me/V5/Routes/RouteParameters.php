<?php

namespace Route4Me\V5\Routes;

use Route4Me\Route4Me as Route4Me;
use \Route4Me\Common as Common;

class RouteParameters extends Common
{
    public $is_upload;
    public $rt;
    public $route_name;
    public $route_date;
    public $shared_publicly;
    public $disable_optimization;
    public $optimize;
    public $lock_last;
    public $vehicle_capacity;
    public $vehicle_max_cargo_weight;
    public $vehicle_max_cargo_volume;
    public $vehicle_max_distance_mi;
    public $subtour_max_revenue;
    public $distance_unit;
    public $travel_mode;
    public $avoid;
    public $avoidance_zones = [];
    public $vehicle_id;
    public $driver_id;
    public $dev_lat;
    public $dev_lng;
    public $route_max_duration;
    public $route_email;
    public $store_route;
    public $metric;
    public $algorithm_type;
    public $member_id;
    public $ip;
    public $dm;
    public $dirm;
    public $parts;
    public $parts_min;
    public $device_id;
    public $device_type;
    public $first_drive_then_wait_between_stops;
    public $has_trailer;
    public $trailer_weight_t;
    public $limited_weight_t;
    public $weight_per_axle_t;
    public $truck_height;
    public $truck_width;
    public $truck_length;
    public $truck_hazardous_goods;
    public $truck_axles;
    public $truck_toll_road_usage;
    public $truck_avoid_ferries;
    public $truck_hwy_only;
    public $truck_lcv;
    public $truck_borders;
    public $truck_side_street_adherence;
    public $truck_config;
    public $truck_dim_unit;
    public $truck_type;
    public $truck_weight;
    public $optimization_quality;
    public $override_addresses = [];
    public $max_tour_size;
    public $min_tour_size;
    public $uturn;
    public $leftturn;
    public $rightturn;
    public $route_time_multiplier;
    public $route_service_time_multiplier;
    public $optimization_engine;
    public $is_dynamic_start_time;
    public $bundling;

    public static function fromArray(array $params)
    {
        $routeParams = new self();
        foreach ($params as $key => $value) {
            if (property_exists($routeParams, $key)) {
                $routeParams->{$key} = $value;
            }
        }

        return $routeParams;
    }

    public function setAddressBundle($addressBundle)
    {
        $this->bundling = $addressBundle;
    }

    public function getAddressBundle()
    {
        return $this->bundling;
    }

    public static function getAllProperties()
    {
        $routeParams = new self();

        $fields = array_keys(get_object_vars($routeParams));

        return $fields;
    }
}
