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
    /**
     * Route destination ID
     * @var integer
     */
    public $route_destination_id;

    /**
     * Route alias
     * @var string
     */
    public $alias;

    /**
     * The ID of the member inside the Route4Me system.
     * @var integer
     */
    public $member_id;

    /**
     * Route destination address
     * @var string
     */
    public $address;

    /**
     * Designate this stop as a depot.
     * A route may have multiple depots/points of origin.
     * @var boolean
     */
    public $is_depot;

    /**
     * Timeframe violation state
     * @var integer
     */
    public $timeframe_violation_state;

    /**
     * Timeframe violation time
     * @var integer
     */
    public $timeframe_violation_time;

    /**
     * Timeframe violation rate
     * @var double
     */
    public $timeframe_violation_rate;

    /**
     * The latitude of this address
     * @var double
     */
    public $lat;

    /**
     * The longitude of this address
     * @var double
     */
    public $lng;

    /**
     * Curbside latitude.
     * Generate optimal routes and driving directions to this curbside latitude.
     * @var double
     */
    public $curbside_lat;

    /**
     * Curbside longitude.
     * Generate optimal routes and driving directions to the curbside longitude.
     * @var double
     */
    public $curbside_lng;

    /**
     * If present, the priority will sequence addresses in all the optimal routes so that
     * higher priority addresses are general at the beginning of the route sequence.
     * 1 is the highest priority, 100000 is the lowest.
     * @var integer
     */
    public $priority;

    /**
     * The ID of the route being viewed, modified, or erased.
     * @var string
     */
    public $route_id;

    /**
     * If this route was duplicated from an existing route,
     * this value would have the original route's ID.
     * @var string
     */
    public $original_route_id;

    /**
     * Route name of a depot address.
     * @var string
     */
    public $route_name;

    /**
     * The ID of the optimization request that was used to initially instantiate this route.
     * @var string
     */
    public $optimization_problem_id;

    /**
     * The destination's sequence number in the route.
     * @var integer
     */
    public $sequence_no;

    /**
     * True if the address is geocoded.
     * @var boolean
     */
    public $geocoded;

    /**
     * The preferred geocoding number.
     * @var integer
     */
    public $preferred_geocoding;

    /**
     * True if geocoding failed.
     * @var boolean
     */
    public $failed_geocoding;

    /**
     * An array containing Geocoding objects.
     * @var Geocoding[]
     */
    public $geocodings = [];

    /**
     * When planning a route from the address book or using existing address book IDs,
     * pass the address book ID (contact_id) for an address so that Route4Me can run
     * analytics on the address book addresses that were used to plan routes, and to find previous visits to
     * favorite addresses.
     * @var integer
     */
    public $contact_id;

    /**
     * The address order ID
     * @var integer
     */
    public $order_id;

    /**
     * Route address stop type
     * @var string
     */
    public $address_stop_type;

    /**
     * The status flag to mark an address as visited (aka check in).
     * @var boolean
     */
    public $is_visited;

    /**
     * The last known visited timestamp of this address.
     * @var integer
     */
    public $timestamp_last_visited;

    /**
     * Latitude of the visited address
     * @var double
     */
    public $visited_lat;

    /**
     * Longitude of the visited address
     * @var double
     */
    public $visited_lng;

    /**
     * The status flag to mark an address as departed (aka check out).
     * @var boolean
     */
    public $is_departed;

    /**
     * Departed address latitude
     * @var double
     */
    public $departed_lat;

    /** Departed address longitude
     * @var double
     */
    public $departed_lng;

    /**
     * he last known departed timestamp of this address.
     * @var integer
     */
    public $timestamp_last_departed;

    /**
     * The address group
     * @var string
     */
    public $group;

    /**
     * Pass-through data about this route destination.<br>
     * The data will be visible on the manifest, website, and mobile apps.
     * @var string
     */
    public $customer_po;

    /**
     * Pass-through data about this route destination.<br>
     * The data will be visible on the manifest, website, and mobile apps.
     * @var string
     */
    public $invoice_no;

    /**
     * Pass-through data about this route destination.<br>
     * The data will be visible on the manifest, website, and mobile apps.
     * @var string
     */
    public $reference_no;

    /**
     * Pass-through data about this route destination.<br>
     * The data will be visible on the manifest, website, and mobile apps.
     * @var string
     */
    public $order_no;

    /**
     * The address cargo weight
     * @var double
     */
    public $weight;

    /**
     * The address cost
     * @var double
     */
    public $cost;

    /**
     * The address revenue
     * @var double
     */
    public $revenue;

    /**
     * The cubic volume that this destination/order/line-item consumes/contains.<br>
     * This is how much space it will take up on a vehicle.
     * @var double
     */
    public $cube;

    /**
     * The number of pieces/palllets that this destination/order/line-item consumes/contains on a vehicle.
     * @var integer
     */
    public $pieces;

    /**
     * First name
     * @var string
     */
    public $first_name;

    /**
     * Last name
     * @var string
     */
    public $last_name;

    /**
     * Pass-through data about this route destination.
     * The data will be visible on the manifest, website, and mobile apps.
     * Also used to email clients when vehicles are approaching (future capability).
     * @var string
     */
    public $email;

    /**
     * Pass-through data about this route destination.
     * The data will be visible on the manifest, website, and mobile apps.
     * Also used to send SMS messages to clients when vehicles are approaching (future capability).
     * @var string
     */
    public $phone;

    /**
     * The number of notes that are already associated with this address on the route.
     * @var integer
     */
    public $destination_note_count;

    /**
     * Server-side generated amount of km/miles that
     * it will take to get to the next location on the route.
     * @var integer
     */
    public $drive_time_to_next_destination;

    /**
     * Abnormal traffic time to next destination.
     * @var integer
     */
    public $abnormal_traffic_time_to_next_destination;

    /**
     * Uncongested time to next destination.
     * @var integer
     */
    public $uncongested_time_to_next_destination;

    /**
     * Traffic time to next destination.
     * @var integer
     */
    public $traffic_time_to_next_destination;

    /**
     * Server-side generated amount of seconds
     * that it will take to get to the next location.
     * @var double
     */
    public $distance_to_next_destination;

    /**
     * The unique socket channel name which
     * should be used to get real time alerts.
     * @var string
     */
    public $channel_name;

    /**
     * Alias of a pickup point.
     * @var string
     */
    public $pickup;

    /**
     * Alias of the paired pickup point.
     * @var string
     */
    public $dropoff;

    /**
     * If equal to 1, the pickup and dropoff addresses are joint
     * (one by one despite the regular pickup-dropoff addresses
     * when it's possible to have multiple pickup addresses with one dropoff address).
     * @var integer
     */
    public $joint;

    /**
     * Generated time window start.
     * @var integer
     */
    public $generated_time_window_start;

    /**
     * Estimated time window end based on the optimization engine,
     * after all the sequencing has been completed.
     * @var integer
     */
    public $generated_time_window_end;

    /**
     * The address time window start.
     * @var integer
     */
    public $time_window_start;

    /**
     * The address time window end.
     * @var integer
     */
    public $time_window_end;

    /**
     * The address time window start 2.
     * @var integer
     */
    public $time_window_start_2;

    /**
     * The address time window end 2.
     * @var integer
     */
    public $time_window_end_2;

    /**
     * Geofence detected visited timestamp
     * @var integer
     */
    public $geofence_detected_visited_timestamp;

    /**
     * Geofence detected departed timestamp
     * @var integer
     */
    public $geofence_detected_departed_timestamp;

    /**
     * Geofence detected service time
     * @var integer
     */
    public $geofence_detected_service_time;

    /**
     * Geofence detected visited latitude
     * @var double
     */
    public $geofence_detected_visited_lat;

    /**
     * Geofence detected visited longitude
     * @var double
     */
    public $geofence_detected_visited_lng;

    /**
     * Geofence detected departed latitude
     * @var double
     */
    public $geofence_detected_departed_lat;

    /**
     * Geofence detected departed longitude
     * @var double
     */
    public $geofence_detected_departed_lng;

    /**
     * The expected amount of time that will be spent
     * at this address by the driver/user.
     * @var integer
     */
    public $time;

    /**
     * System-wide unique code, which permits end-users (recipients)
     * to track the status of their order.
     * @var string
     */
    public $tracking_number;

    /**
     * The address custom fields.
     * @var array
     */
    public $custom_fields = [];

    /**
     * The custom fields configuration in JSON format.
     * @var string
     */
    public $custom_fields_str_json;

    /**
     * The custom fields configuration.
     * @var string[]
     */
    public $custom_fields_config = [];

    /**
     * The custom fields configuration in JSON format.
     * @var string
     */
    public $custom_fields_config_str_json;

    /**
     * The address notes
     * @var AddressNote[]
     */
    public $notes = [];

    /**
     * Bundle count
     * @var integer
     */
    public $bundle_count;

    /**
     * Bundle items
     * @var BundledItemResponse[]
     */
    public $bundle_items;

    /**
     * List of the order inventories
     * @var OrderInventory[]
     */
    public $order_inventory;

    /**
     * UDU distance to next destination.
     * @var double
     */
    public $udu_distance_to_next_destination;

    /**
     * Wait time to next destination.
     * @var integer
     */
    public $wait_time_to_next_destination;

    /**
     * Manifest of a route address.
     * @var AddressManifest
     */
    public $manifest;

    /**
     * An array of the required driver skills for the address.
     * @var array
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

    /**
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

    /**
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

    /**
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
