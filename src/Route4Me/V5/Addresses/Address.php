<?php

namespace Route4Me\V5\Addresses;

use Route4Me\V5\Enum\Endpoint;
use Route4Me\Enum\Endpoint as Endpoint4;
use Route4Me\Exception\BadParam;
use Route4Me\Route4Me;

/**
 * Class Address
 * @package Route4Me\V5
 * Route destination class.
 */
class Address extends \Route4Me\Common
{
    /** Route destination ID
     * @var int $route_destination_id
     */
    public $route_destination_id;

    /** Route alias
     * @var string $alias
     */
    public $alias;

    /** The ID of the member inside the Route4Me system.
     * @var int $member_id
     */
    public $member_id;

    /** Route destination address
     * @var string $address
     */
    public $address;

    /** Designate this stop as a depot.
     * A route may have multiple depots/points of origin.
     * @var boolean $is_depot
     */
    public $is_depot;

    /** Timeframe violation state
     * @var integer $timeframe_violation_state
     */
    public $timeframe_violation_state;

    /** Timeframe violation time
     * @var integer $timeframe_violation_time
     */
    public $timeframe_violation_time;

    /** Timeframe violation rate
     * @var double $timeframe_violation_rate
     */
    public $timeframe_violation_rate;

    /** The latitude of this address
     * @var double $lat
     */
    public $lat;

    /** The longitude of this address
     * @var double $lng
     */
    public $lng;

    /** Curbside latitude.
     * Generate optimal routes and driving directions to this curbside latitude.
     * @var double $curbside_lat
     */
    public $curbside_lat;

    /** Curbside longitude.
     * Generate optimal routes and driving directions to the curbside longitude.
     * @var double $curbside_lng
     */
    public $curbside_lng;

    /** If present, the priority will sequence addresses in all the optimal routes so that
     * higher priority addresses are general at the beginning of the route sequence.
     * 1 is the highest priority, 100000 is the lowest.
     * @var integer $priority
     */
    public $priority;

    /** The ID of the route being viewed, modified, or erased.
     * @var string $route_id
     */
    public $route_id;

    /** If this route was duplicated from an existing route, this value would have the original route's ID.
     * @var string $original_route_id
     */
    public $original_route_id;

    /** Route name of a depot address.
     * @var string route_name
     */
    public $route_name;

    /** The ID of the optimization request that was used to initially instantiate this route.
     * @var string $optimization_problem_id
     */
    public $optimization_problem_id;

    /** The destination's sequence number in the route.
     * @var integer $sequence_no
     */
    public $sequence_no;

    /** True if the address is geocoded.
     * @var boolean $geocoded
     */
    public $geocoded;

    /** The preferred geocoding number.
     * @var integer $preferred_geocoding
     */
    public $preferred_geocoding;

    /** True if geocoding failed.
     * @var boolean $failed_geocoding
     */
    public $failed_geocoding;

    /** An array containing Geocoding objects.
     * @var Geocoding[] $geocodings = []
     */
    public $geocodings = [];

    /** When planning a route from the address book or using existing address book IDs,
     * pass the address book ID (contact_id) for an address so that Route4Me can run
     * analytics on the address book addresses that were used to plan routes, and to find previous visits to
     * favorite addresses.
     * @var integer $contact_id
     */
    public $contact_id;

    /** The address order ID
     * @var integer $order_id
     */
    public $order_id;

    /** Route address stop type
     * @var string $address_stop_type
     */
    public $address_stop_type;

    /** The status flag to mark an address as visited (aka check in).
     * @var boolean $is_visited
     */
    public $is_visited;

    /** The last known visited timestamp of this address.
     * @var integer $timestamp_last_visited
     */
    public $timestamp_last_visited;

    /** Latitude of the visited address
     * @var double $visited_lat
     */
    public $visited_lat;

    /** Longitude of the visited address
     * @var double $visited_lng
     */
    public $visited_lng;

    /** The status flag to mark an address as departed (aka check out).
     * @var boolean $is_departed
     */
    public $is_departed;

    /** Departed address latitude
     * @var double $departed_lat
     */
    public $departed_lat;

    /** Departed address longitude
     * @var double $departed_lng
     */
    public $departed_lng;

    /** The last known departed timestamp of this address.
     * @var integer $timestamp_last_departed
     */
    public $timestamp_last_departed;

    /** The address group
     * @var string $group
     */
    public $group;

    /** Pass-through data about this route destination.
     * The data will be visible on the manifest, website, and mobile apps.
     * @var string $customer_po
     */
    public $customer_po;

    /** Pass-through data about this route destination.
     * The data will be visible on the manifest, website, and mobile apps.
     * @var string $invoice_no
     */
    public $invoice_no;

    /** Pass-through data about this route destination.
     * The data will be visible on the manifest, website, and mobile apps.
     * @var string $reference_no
     */
    public $reference_no;

    /** Pass-through data about this route destination.
     * The data will be visible on the manifest, website, and mobile apps.
     * @var string $order_no
     */
    public $order_no;

    /** The address cargo weight
     * @var double $weight
     */
    public $weight;

    /** The address cost
     * @var double $cost
     */
    public $cost;

    /** The address revenue
     * @var double $revenue
     */
    public $revenue;

    /** The cubic volume that this destination/order/line-item consumes/contains.
     * This is how much space it will take up on a vehicle.
     * @var double $cube
     */
    public $cube;

    /** The number of pieces/palllets that this destination/order/line-item consumes/contains on a vehicle.
     * @var integer $pieces
     */
    public $pieces;

    /** First name
     * @var string $first_name
     */
    public $first_name;

    /** Last name
     * @var string $last_name
     */
    public $last_name;

    /** Pass-through data about this route destination.
     * The data will be visible on the manifest, website, and mobile apps.
     * Also used to email clients when vehicles are approaching (future capability).
     * @var string $email
     */
    public $email;

    /** Pass-through data about this route destination.
     * The data will be visible on the manifest, website, and mobile apps.
     * Also used to send SMS messages to clients when vehicles are approaching (future capability).
     * @var string $phone
     */
    public $phone;

    /** The number of notes that are already associated with this address on the route.
     * @var integer $destination_note_count
     */
    public $destination_note_count;

    /** Server-side generated amount of km/miles that it will take to get to the next location on the route.
     * @var integer $drive_time_to_next_destination
     */
    public $drive_time_to_next_destination;

    /** Abnormal traffic time to next destination.
     * @var integer $abnormal_traffic_time_to_next_destination
     */
    public $abnormal_traffic_time_to_next_destination;

    /** Uncongested time to next destination.
     * @var integer $uncongested_time_to_next_destination
     */
    public $uncongested_time_to_next_destination;

    /** Traffic time to next destination.
     * @var integer $traffic_time_to_next_destination
     */
    public $traffic_time_to_next_destination;

    /** Server-side generated amount of seconds that it will take to get to the next location.
     * @var double $distance_to_next_destination
     */
    public $distance_to_next_destination;

    /** The unique socket channel name which should be used to get real time alerts.
     * @var string $channel_name
     */
    public $channel_name;

    /** Alias of a pickup point.
     * @var string $pickup
     */
    public $pickup;

    /** Alias of the paired pickup point.
     * @var string $dropoff
     */
    public $dropoff;

    /** If equal to 1, the pickup and dropoff addresses are joint
     * (one by one despite the regular pickup-dropoff addresses
     * when it's possible to have multiple pickup addresses with one dropoff address).
     * @var integer $joint
     */
    public $joint;

    /** Generated time window start.
     * @var integer $generated_time_window_start
     */
    public $generated_time_window_start;

    /** Estimated time window end based on the optimization engine,
     * after all the sequencing has been completed.
     * @var integer $generated_time_window_end
     */
    public $generated_time_window_end;

    /** The address time window start.
     * @var integer $time_window_start
     */
    public $time_window_start;

    /** The address time window end.
     * @var integer $time_window_end
     */
    public $time_window_end;

    /** The address time window start 2.
     * @var integer $time_window_start_2
     */
    public $time_window_start_2;

    /** The address time window end 2.
     * @var integer $time_window_end_2
     */
    public $time_window_end_2;

    /** Geofence detected visited timestamp
     * @var integer $geofence_detected_visited_timestamp
     */
    public $geofence_detected_visited_timestamp;

    /** Geofence detected departed timestamp
     * @var integer $geofence_detected_departed_timestamp
     */
    public $geofence_detected_departed_timestamp;

    /** Geofence detected service time
     * @var integer $geofence_detected_service_time
     */
    public $geofence_detected_service_time;

    /** Geofence detected visited latitude
     * @var double $geofence_detected_visited_lat
     */
    public $geofence_detected_visited_lat;

    /** Geofence detected visited longitude
     * @var double Geofence detected visited longitude
     */
    public $geofence_detected_visited_lng;

    /** Geofence detected departed latitude
     * @var double $geofence_detected_departed_lat
     */
    public $geofence_detected_departed_lat;

    /** Geofence detected departed longitude
     * @var double $geofence_detected_departed_lng
     */
    public $geofence_detected_departed_lng;

    /** The expected amount of time that will be spent at this address by the driver/user.
     * @var integer $time
     */
    public $time;

    /** System-wide unique code, which permits end-users (recipients) to track the status of their order.
     * @var string $tracking_number
     */
    public $tracking_number;

    /** The address custom fields.
     * @var array $custom_fields
     */
    public $custom_fields = [];

    /** The custom fields configuration in JSON format.
     * @var string $custom_fields_str_json
     */
    public $custom_fields_str_json;

    /** The custom fields configuration.
     * @var string[] $custom_fields_config
     */
    public $custom_fields_config = [];

    /** The custom fields configuration in JSON format.
     * @var string $custom_fields_config_str_json
     */
    public $custom_fields_config_str_json;

    /** The address notes
     * @var AddressNote[] $notes
     */
    public $notes = [];

    /** Bundle count
     * @var integer $bundle_count
     */
    public $bundle_count;

    /** Bundle items
     * @var BundledItemResponse[] $bundle_items
     */
    public $bundle_items;

    /** List of the order inventories
     * @var OrderInventory[] $order_inventory
     */
    public $order_inventory;

    /** UDU distance to next destination.
     * @var double $udu_distance_to_next_destination
     */
    public $udu_distance_to_next_destination;

    /** Wait time to next destination.
     * @var integer $wait_time_to_next_destination
     */
    public $wait_time_to_next_destination;

    /** Manifest of a route address.
     * @var AddressManifest $manifest
     */
    public $manifest;

    /** An array of the required driver skills for the address.
     * @var array $required_skills
     */
    public $required_skills = [];

    public $additional_status;

    public function __construct()
    {
        // TO DO: replace with API 5 endpoint after finishing.
        Route4Me::setBaseUrl(  Endpoint4::BASE_URL);
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
            'url' => Endpoint4::ADDRESS_V4,
            'method' => 'GET',
            'query' => [
                'route_id' => $routeId,
                'route_destination_id' => $addressId,
            ],
        ]);

        return self::fromArray($address);
    }

    public function update()
    {
        $addressUpdate = Route4Me::makeRequst([
            'url' => Endpoint4::ADDRESS_V4,
            'method' => 'PUT',
            'body' => $this->toArray(),
            'query' => [
                'route_id' => $this->route_id,
                'route_destination_id' => $this->route_destination_id,
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
            'url' => Endpoint4::ADDRESS_V4,
            'method' => 'PUT',
            'query' => Route4Me::generateRequestParameters($allQueryFields, $params),
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params),
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
            'url' => Endpoint4::MARK_ADDRESS_DEPARTED,
            'method' => 'PUT',
            'query' => Route4Me::generateRequestParameters($allQueryFields, $params),
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
            'url' => Endpoint4::UPDATE_ADDRESS_VISITED,
            'method' => 'PUT',
            'query' => Route4Me::generateRequestParameters($allQueryFields, $params),
        ]);

        return $address;
    }

    public function deleteAddress()
    {
        $address = Route4Me::makeRequst([
            'url' => Endpoint4::ADDRESS_V4,
            'method' => 'DELETE',
            'query' => [
                'route_id' => $this->route_id,
                'route_destination_id' => $this->route_destination_id,
            ],
        ]);

        return (bool)$address['deleted'];
    }

    public function moveDestinationToRoute($params)
    {
        $allBodyFields = ['to_route_id', 'route_destination_id', 'after_destination_id'];

        $result = Route4Me::makeRequst([
            'url' => Endpoint4::MOVE_ROUTE_DESTINATION,
            'method' => 'POST',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params),
            'HTTPHEADER' => 'Content-Type: multipart/form-data',
        ]);

        return $result;
    }

    public function getAddressId()
    {
        return $this->route_destination_id;
    }
}
