<?php

namespace Route4Me\V5\AddressBook;

use Route4Me\Common;
use Route4Me\V5\AddressBook\AssignedTo;
use Route4Me\V5\AddressBook\ScheduleItem;

/**
 * Address Book API ResponseAddress structure
 *
 * @since 1.2.8
 *
 * @package Route4Me
 */
class ResponseAddress extends Common
{
    /**
     * Time when the contact was created.
     * @example 1627120286
     */
    public ?int $created_timestamp = null;

    /**
     * Unique ID of the address.
     * @example 1
     */
    public ?int $address_id = null;

    /**
     * A group the contact belongs.
     */
    public ?string $address_group = null;

    /**
     * Address group.
     * @example 'Jenkins Ways'
     */
    public ?string $address_alias = null;

    /**
     * The route Address Line 1.
     * @example '999 Aurelio Summit, Jamirtown, CO 52979-8465'
     */
    public ?string $address_1 = null;

    /**
     * The route Address Line 2 which is not used for geocoding.
     */
    public ?string $address_2 = null;

    /**
     * A member the address assigned to.
     * @example 1
     */
    public ?int $member_id = null;

    /**
     * The first name of the receiving address.
     * @example 'Keyon'
     */
    public ?string $first_name = null;

    /**
     * The last name of the receiving party.
     * @example 'Will'
     */
    public ?string $last_name = null;

    /**
     * The contact's email.
     */
    public ?string $address_email = null;

    /**
     * The contact's phone number.
     */
    public ?string $address_phone_number = null;

    /**
     * The city the address is located in.
     */
    public ?string $address_city = null;

    /**
     * The state the address is located in.
     * @example '10'
     */
    public ?string $address_state_id = null;

    /**
     * The country the address is located in.
     * @example '223'
     */
    public ?string $address_country_id = null;

    /**
     * The zip code the address is located in.
     */
    public ?string $address_zip = null;

    /**
     * A latitude of the contact's cached position.
     * @example -79.102999
     */
    public ?float $cached_lat = null;

    /**
     * A longitude of the contact's cached position.
     * @example -162.156663
     */
    public ?float $cached_lng = null;

    /**
     * A latitude of the contact's curbside.
     * @example -79.102999
     */
    public ?float $curbside_lat = null;

    /**
     * A longitude of the contact's curbside.
     * @example -162.156663
     */
    public ?float $curbside_lng = null;

    /**
     * An array of the contact's custom field-value pairs.
     * @example ['custom_data_key' => 'custom_data_value']
     */
    public ?array $address_custom_data = null;

    /**
     * Array of the trip schedules to a location.
     * @var Schedule[]
     */
    public ?array $schedule = null;

    /**
     * Array of the dates, which should be excluded from a trip schedule to a location.
     * Also can be a date string with the 'YYYY-MM-DD' format.
     * @var string|string[]
     * @example ['2019-12-12']
     */
    public $schedule_blacklist = null;

    /**
     * Number of the routes containing the contact.
     */
    public ?int $in_route_count = null;

    /**
     * How many times visited the contact.
     */
    public ?int $visited_count = null;

    /**
     * When the contact was last visited.
     */
    public ?int $last_visited_timestamp = null;

    /**
     * When the contact was last routed.
     */
    public ?int $last_routed_timestamp = null;

    /**
     * Start of the contact's local time window.
     */
    public ?int $local_time_window_start = null;

    /**
     * End of the contact's local time window.
     */
    public ?int $local_time_window_end = null;

    /**
     * Start of the contact's second local time window.
     */
    public ?int $local_time_window_start_2 = null;

    /**
     * End of the contact's second local time window.
     */
    public ?int $local_time_window_end_2 = null;

    /**
     * The service time at the contact's address.
     */
    public ?int $service_time = null;

    /**
     * The contact's local timezone.
     */
    public ?string $local_timezone_string = null;

    /**
     * The contact's color on the map.
     * @example '000000'
     */
    public ?string $color = null;

    /**
     * The contact's icon on the map.
     */
    public ?string $address_icon = null;

    /**
     * The contact's stop type.
     * String array, available types: 'DELIVERY', 'PICKUP',
     *   'BREAK', 'MEETUP', 'SERVICE', 'VISIT', 'DRIVEBY'
     */
    public ?string $address_stop_type = null;

    /**
     * The cubic volume of the cargo being delivered or picked up at the address.
     */
    public ?float $address_cube = null;

    /**
     * The item quantity of the cargo being delivered or picked up at the address.
     */
    public ?float $address_pieces = null;

    /**
     * The reference number of the address.
     */
    public ?string $address_reference_no = null;

    /**
     * The total revenue for the address.
     */
    public ?float $address_revenue = null;

    /**
     * Weight of the cargo being delivered or picked up at the address.
     */
    public ?float $address_weight = null;

    /**
     * If present, the priority will sequence addresses in all the optimal routes so that
     * higher priority addresses are general at the beginning of the route sequence.
     * 0 is the highest priority, n has higher priority than n + 1
     */
    public ?int $address_priority = null;

    /**
     * The customer purchase order for the address.
     */
    public ?string $address_customer_po = null;

    /**
     * If true, the address is eligible to pickup.
     */
    public ?bool $eligible_pickup = null;

    /**
     * If true, the addrss is eligible to depot.
     */
    public ?bool $eligible_depot = null;

    /**
     * If true, the addrss is eligible to depot.
     */
    public ?AssignedTo $assigned_to = null;

    public function __construct(?array $params = null)
    {
        if ($params !== null) {
            foreach ($this as $key => $value) {
                if (isset($params[$key])) {
                    if ($key === 'schedule') {
                        $this->{$key} = array();
                        foreach ($params[$key] as $si_key => $si_value) {
                            if (is_array($si_value)) {
                                array_push($this->{$key}, new ScheduleItem($si_value));
                            } elseif (is_object($si_value) && $si_value instanceof ScheduleItem) {
                                array_push($this->{$key}, $si_value);
                            }
                        }
                    } elseif ($key === 'assigned_to') {
                        if (is_array($params[$key])) {
                            $this->{$key} = new AssignedTo($params[$key]);
                        } elseif (is_object($params[$key]) && $params[$key] instanceof AssignedTo) {
                            $this->{$key} = $params[$key];
                        }
                    } else {
                        $this->{$key} = $params[$key];
                    }
                }
            }
        }
    }
}
