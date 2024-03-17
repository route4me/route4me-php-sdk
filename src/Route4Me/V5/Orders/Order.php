<?php

namespace Route4Me\V5\Orders;

use Route4Me\Common;
use Route4Me\V5\Orders\CustomData;
use Route4Me\V5\Orders\CustomField;
use Route4Me\V5\Orders\GPSCoords;
use Route4Me\V5\Orders\LocalTimeWindow;

/**
 * The Order structure
 *
 * @since 1.3.0
 *
 * @package Route4Me
 */
class Order extends Common
{
    /**
     * Order owner ID.
     */
    public ?int $member_id = null;

    /**
     * The order Address line 1.
     */
    public ?string $address_1 = null;

    /**
     * The order Address line 2.
     */
    public ?string $address_2 = null;

    /**
     * Address alias.
     */
    public ?string $address_alias = null;

    /**
     * The city the address is located in.
     */
    public ?string $address_city = null;

    /**
     * The state the address is located in.
     */
    public ?string $address_state = null;

    /**
     * The zip code the address is located in.
     */
    public ?string $address_zip = null;

    /**
     * The country the address is located in.
     */
    public ?string $address_country = null;

    /**
     * GPS coords of address.
     */
    public ?GPSCoords $address_geo = null;

    /**
     * Curbside GPS coords of address.
     */
    public ?GPSCoords $curbside_geo = null;

    /**
     * Date scheduled.
     * e.g. YY-MM-DD, YYMMDD, ISO 8601
     */
    public ?string $date_scheduled_for = null;

    /**
     * Order status ID.
     */
    public ?int $order_status_id = null;

    /**
     * If true, the order is pending.
     */
    public ?bool $is_pending = null;

    /**
     * If true, the order is accepted.
     */
    public ?bool $is_accepted = null;

    /**
     * If true, the order is started.
     */
    public ?bool $is_started = null;

    /**
     * If true, the order is completed.
     */
    public ?bool $is_completed = null;

    /**
     * If true, the order is validated.
     */
    public ?bool $is_validated = null;

    /**
     * The phone number.
     */
    public ?string $phone = null;

    /**
     * The first name.
     */
    public ?string $first_name = null;

    /**
     * The last name.
     */
    public ?string $last_name = null;

    /**
     * E-mail.
     */
    public ?string $email = null;

    /**
     * Order custom data.
     */
    public ?CustomData $custom_data = null;

    /**
     * Array of Time Window objects.
     */
    public ?array $local_time_windows = null;

    /**
     * Local timezone String.
     */
    public ?string $local_timezone_string = null;

    /**
     * Consumed service time.
     */
    public ?int $service_time = null;

    /**
     * Color of an address, e.g., 'FF0000'.
     */
    public ?string $color = null;

    /**
     * Tracking number
     */
    public ?string $tracking_number = null;

    /**
     * The address type of stop, this is one of 'DELIVERY', 'PICKUP',
     * 'BREAK', 'MEETUP', 'SERVICE', 'VISIT' or 'DRIVEBY'.
     */
    public ?string $address_stop_type = null;

    /**
     * Last known status
     */
    public ?int $last_status = null;

    /**
     * Weight of the cargo.
     */
    public ?float $weight = null;

    /**
     * Cost of the cargo.
     */
    public ?float $cost = null;

    /**
     * The total revenue for the order.
     */
    public ?float $revenue = null;

    /**
     * The cubic volume of the cargo.
     */
    public ?float $cube = null;

    /**
     *The item quantity of the cargo.
     */
    public ?float $pieces = null;

    /**
     * The group.
     */
    public ?string $group = null;

    /**
     * Priority of address
     * 0 is the highest priority, n has higher priority than n + 1
     */
    public ?int $address_priority = null;

    /**
     * The customer purchase order for the address, length <= 50.
     */
    public ?string $address_customer_po = null;

    /**
     * Array of Custom Fields objects.
     */
    public ?array $custom_fields = null;

    public function __construct(array $params = null)
    {
        if ($params !== null) {
            foreach ($this as $key => $value) {
                if (isset($params[$key])) {
                    if ($key === 'local_time_windows') {
                        $this->{$key} = array();
                        foreach ($params[$key] as $ltw_key => $ltw_value) {
                            if (is_array($ltw_value)) {
                                array_push($this->{$key}, new LocalTimeWindow($ltw_value));
                            } elseif (is_object($ltw_value) && $ltw_value instanceof LocalTimeWindow) {
                                array_push($this->{$key}, $ltw_value);
                            }
                        }
                    } elseif ($key === 'custom_fields') {
                        $this->{$key} = array();
                        foreach ($params[$key] as $cf_key => $cf_value) {
                            if (is_array($cf_value)) {
                                array_push($this->{$key}, new CustomField($cf_value));
                            } elseif (is_object($cf_value) && $cf_value instanceof CustomField) {
                                array_push($this->{$key}, $cf_value);
                            }
                        }
                    } elseif ($key === 'address_geo' || $key === 'curbside_geo') {
                        if (is_array($params[$key])) {
                            $this->{$key} = new GPSCoords($params[$key]);
                        } elseif (is_object($params[$key]) && $params[$key] instanceof GPSCoords) {
                            $this->{$key} = $params[$key];
                        }
                    } elseif ($key === 'custom_data') {
                        if (is_array($params[$key])) {
                            $this->{$key} = new CustomData($params[$key]);
                        } elseif (is_object($params[$key]) && $params[$key] instanceof CustomData) {
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
