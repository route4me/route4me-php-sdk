<?php

namespace Route4Me;

use Route4Me\Enum\Endpoint;
use Route4Me\Exception\BadParam;

class Address extends Common
{
    public $route_destination_id;
    public $alias;
    public $member_id;
    public $address;
    public $addressUpdate;
    public $is_depot = false;
    public $lat;
    public $lng;
    public $route_id;
    public $original_route_id;
    public $optimization_problem_id;
    public $sequence_no;
    public $geocoded;
    public $preferred_geocoding;
    public $failed_geocoding;
    public $geocodings = [];
    public $contact_id;
    public $is_visited;
    public $customer_po;
    public $invoice_no;
    public $reference_no;
    public $order_no;
    public $weight;
    public $cost;
    public $revenue;
    public $cube;
    public $pieces;
    public $email;
    public $phone;
    public $tracking_number;
    public $destination_note_count;
    public $drive_time_to_next_destination;
    public $distance_to_next_destination;
    public $generated_time_window_start;
    public $generated_time_window_end;
    public $time_window_start;
    public $time_window_end;
    public $time;
    public $notes;
    public $timestamp_last_visited;
    public $custom_fields = [];
    public $manifest = [];

    public $first_name;
    public $last_name;
    public $is_departed;
    public $timestamp_last_departed;
    public $order_id;
    public $priority;
    public $curbside_lat;
    public $curbside_lng;
    public $time_window_start_2;
    public $time_window_end_2;

    public $timeframe_violation_state;
    public $timeframe_violation_time;
    public $timeframe_violation_rate;
    public $route_name;
    public $address_stop_type;
    public $visited_lat;
    public $visited_lng;
    public $departed_lat;
    public $departed_lng;
    public $group;
    public $abnormal_traffic_time_to_next_destination;
    public $uncongested_time_to_next_destination;
    public $traffic_time_to_next_destination;
    public $channel_name;
    public $pickup;
    public $dropoff;
    public $joint;
    public $geofence_detected_visited_timestamp;
    public $geofence_detected_departed_timestamp;
    public $geofence_detected_service_time;
    public $geofence_detected_visited_lat;
    public $geofence_detected_visited_lng;
    public $geofence_detected_departed_lat;
    public $geofence_detected_departed_lng;
    public $custom_fields_str_json;
    public $custom_fields_config;
    public $custom_fields_config_str_json;
    public $bundle_count;
    public $bundle_items;
    public $order_inventory;
    public $required_skills;
    public $udu_distance_to_next_destination;
    public $wait_time_to_next_destination;
    public $path_to_next = [];
    public $additional_status;
    public $tags = [];

    public function __construct()
    {
        Route4Me::setBaseUrl(Endpoint::BASE_URL);
    }

    public static function fromArray(array $params)
    {
        $address = new self();

        foreach ($params as $key => $value) {
            if (property_exists($address, $key)) {
                $address->{$key} = $value;
            } else {
                throw new BadParam("Correct parameter must be provided. Wrong Parameter: $key");
            }
        }

        return $address;
    }

    public static function getAddress($routeId, $addressId)
    {
        $address = Route4Me::makeRequst([
            'url'       => Endpoint::ADDRESS_V4,
            'method'    => 'GET',
            'query'     => [
                'route_id'              => $routeId,
                'route_destination_id'  => $addressId,
            ],
        ]);

        return self::fromArray($address);
    }

    public function update()
    {
        $addressUpdate = Route4Me::makeRequst([
            'url'       => Endpoint::ADDRESS_V4,
            'method'    => 'PUT',
            'body'      => $this->toArray(),
            'query'     => [
                'route_id'              => $this->route_id,
                'route_destination_id'  => $this->route_destination_id,
            ],
        ]);

        return self::fromArray($addressUpdate);
    }

    /*
     * Marks an address as marked as visited/as departed
     * depending on which parameter is specified: 'is_visited' or 'is_departed'.
     */
    public function markAddress($params)
    {
        $allQueryFields = ['route_id', 'route_destination_id'];
        $allBodyFields = ['is_visited', 'is_departed'];

        $result = Route4Me::makeRequst([
            'url' => Endpoint::ADDRESS_V4,
            'method'    => 'PUT',
            'query'     => Route4Me::generateRequestParameters($allQueryFields, $params),
            'body'      => Route4Me::generateRequestParameters($allBodyFields, $params),
        ]);

        return $result;
    }

    /*
     * Marks an address as departed.
     */
    public function markAsDeparted($params)
    {
        $allQueryFields = ['route_id', 'address_id', 'is_departed', 'member_id'];

        $address = Route4Me::makeRequst([
            'url'       => Endpoint::MARK_ADDRESS_DEPARTED,
            'method'    => 'PUT',
            'query'     => Route4Me::generateRequestParameters($allQueryFields, $params),
        ]);

        return $address;
    }

    /*
     * Marks an address as visited.
     */
    public function markAsVisited($params)
    {
        $allQueryFields = ['route_id', 'address_id', 'is_visited', 'member_id'];

        $address = Route4Me::makeRequst([
            'url'       => Endpoint::UPDATE_ADDRESS_VISITED,
            'method'    => 'PUT',
            'query'     => Route4Me::generateRequestParameters($allQueryFields, $params),
        ]);

        return $address;
    }

    public function deleteAddress()
    {
        $address = Route4Me::makeRequst([
            'url'       => Endpoint::ADDRESS_V4,
            'method'    => 'DELETE',
            'query'     => [
                'route_id'              => $this->route_id,
                'route_destination_id'  => $this->route_destination_id,
            ],
        ]);

        return (bool) $address['deleted'];
    }

    public function moveDestinationToRoute($params)
    {
        $allBodyFields = ['to_route_id', 'route_destination_id', 'after_destination_id'];

        $result = Route4Me::makeRequst([
            'url'           => Endpoint::MOVE_ROUTE_DESTINATION,
            'method'        => 'POST',
            'body'          => Route4Me::generateRequestParameters($allBodyFields, $params),
            'HTTPHEADER'    => 'Content-Type: multipart/form-data',
        ]);

        return $result;
    }

    public function getAddressId()
    {
        return $this->route_destination_id;
    }
}
