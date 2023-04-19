<?php

namespace Route4Me\V5\AddressBook;

use Route4Me\Exception\ApiError;
use Route4Me\Route4Me;
use Route4Me\Common;
use Route4Me\V5\Enum\Endpoint;
use Route4Me\V5\AddressBook\ResponseAll;
use Route4Me\V5\AddressBook\ResponsePagination;
use Route4Me\V5\AddressBook\ResponseClustering;
use Route4Me\V5\AddressBook\StatusChecker;

/**
 * Address Book API
 *
 * @since 1.2.8
 *
 * @package Route4Me
 */
class AddressBook extends Common
{
    public function __construct()
    {
        Route4Me::setBaseUrl('');
    }

    /**
     * Get all Addresses filtered by specifying the corresponding query parameters.
     *
     * @see {@link https://virtserver.swaggerhub.com/Route4Me/address-book/1.0.0}
     *
     * @param  array [$options]            - Array of options.
     *   string [fields]                   - Comma-delimited list of the address
     *                                       fields to be included into the search results
     *                                       e.g., 'address_id, address_alias, address_1'.
     *   string [display = 'all']          - Specify which Addresses to show in the
     *                                       corresponding query results.
     *                                       Possible values:
     *                                         'all' - all records;
     *                                         'routed' - only routed records;
     *                                         'unrouted' - only unrouted records.
     *   string [query]                    - Search in the Addresses by the
     *                                       corresponding query phrase.
     *   int    [limit]                    - Limit of the queried records number.
     *   int    [offset]                   - Offset from the beginning of the queried records.
     * @return ResponseAll
     * @throws Exception\ApiError
     */
    public function getAddresses(?array $options = null) : ResponseAll
    {
        $allQueryFields = ['fields', 'display', 'query', 'limit', 'offset'];

        return $this->toResponseAll(Route4Me::makeRequst([
            'url' => Endpoint::ADDRESSES_INDEX_ALL,
            'method' => 'GET',
            'query' => Route4Me::generateRequestParameters($allQueryFields, $options)
        ]));
    }

    /**
     * Get all Addresses filtered and sorted by sending the corresponding body payload, with
     * the option to search by the specified areas.
     *
     * @see {@link https://virtserver.swaggerhub.com/Route4Me/address-book/1.0.0}
     *
     * @param  array [$options]            - Array of options.
     *   array  [fields = []]              - An array of the fields to be included
     *                                       in the search result.
     *                                       e.g., ['address_id', 'address_alias', 'address_1'].
     *   array  [filter]                   - FIlter parameters
     *     string [query]                  - Query string.
     *     array  [selected_areas]         - Selected areas
     *       string [type]                 - Area type.
     *                                       Possible values: 'circle', 'polygon', 'rect'.
     *       array  [value]                - Area parameters.
     *         e.g.,
     *         'type' => 'circle',
     *         'value' => [
     *             'center' => ['lat' => 40, 'lng' => 80],
     *             'distance' => 1000
     *         ]
     *
     *         'type' => 'polygon',
     *         'value' => [
     *             'points' => [[74, 40], [88, 30], [90, 25]]
     *         ]
     *
     *         'type' => 'rect',
     *         'value' => [
     *             'top_left' => [50, 90],
     *             'bottom_right' => [48, 70]
     *         ]
     *
     *     array  [bounding_box]           - Coordinates of bounding box
     *       float [top]                   - Top
     *       float [left]                  - Left
     *       float [bottom                 - Bottom
     *       float [right]                 - Right
     *
     *     array  [center]                 - GPS coordinates of central point.
     *       float [lat]                   - Latitude.
     *       float [lng]                   - Longitude.
     *     float  [distance]               - Distance from the area center.
     *     string [display]                - Display option of the contacts.
     *                                       Possible values:
     *                                         'all' - all records;
     *                                         'routed' - only routed records;
     *                                         'unrouted' - only unrouted records.
     *     float  [assigned_member_id]     - A member the contact assigned to.
     *     float  [is_assigned]            - If true, the contact assigned to a member.
     *   array  [order_by]                 - Array of order fields
     *                                       You can sort the results using the specified fields:
     *                                       address_1, address_alias, first_name, last_name,
     *                                       address_phone_number, address_email, address_group,
     *                                       in_route_count, visited_count, last_visited_timestamp,
     *                                       last_routed_timestamp
     *                                       e.g., [["address_1", "asc"], ["last_name", "desc"]]
     *
     *   int    [limit]                    - Limit of the queried records number.
     *   int    [offset]                   - Offset from the beginning of the queried records.
     * @return ResponseAll
     * @throws Exception\ApiError
     */
    public function getAddressesByBodyPayload(?array $options = null) : ResponseAll
    {
        $allBodyFields = ['fields', 'filter', 'order_by', 'limit', 'offset'];

        return $this->toResponseAll(Route4Me::makeRequst([
            'url' => Endpoint::ADDRESSES_INDEX_ALL,
            'method' => 'POST',
            'HTTPHEADER' => 'Content-Type: application/json',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $options)
        ]));
    }

    /**
     * Get a paginated list of all Addresses.
     *
     * @see {@link https://virtserver.swaggerhub.com/Route4Me/address-book/1.0.0}
     *
     * @param  array [$options]            - Array of options.
     *   string [fields]                   - Comma-delimited list of the address
     *                                       fields to be included into the search results
     *                                       e.g., 'address_id, address_alias, address_1'.
     *   string [display = 'all']          - Specify which Addresses to show in the
     *                                       corresponding query results.
     *                                       Possible values:
     *                                         'all' - all records;
     *                                         'routed' - only routed records;
     *                                         'unrouted' - only unrouted records.
     *   string [query]                    - Search in the Addresses by the
     *                                       corresponding query phrase.
     *   int    [page = 1]                 - Requested page.
     *   int    [per_page = 30]            - Number of Addresses per page.
     * @return ResponsePagination
     * @throws Exception\ApiError
     */
    public function getAddressesPaginated(?array $options = null) : ResponsePagination
    {
        $allQueryFields = ['fields', 'display', 'query', 'page', 'per_page'];

        return $this->toResponsePagination(Route4Me::makeRequst([
            'url' => Endpoint::ADDRESSES_INDEX_PAGINATION,
            'method' => 'GET',
            'query' => Route4Me::generateRequestParameters($allQueryFields, $options)
        ]));
    }

    /**
     * Get the paginated list of all Addresses filtered and sorted by sending the corresponding
     * body payload, with the option to search by the specified areas.
     *
     * @see {@link https://virtserver.swaggerhub.com/Route4Me/address-book/1.0.0}
     *
     * @param  array [$options]            - Array of options.
     *   array  [fields = []]              - An array of the fields to be included
     *                                       in the search result.
     *                                       e.g., ['address_id', 'address_alias', 'address_1'].
     *   array  [filter]                   - FIlter parameters
     *     string [query]                  - Query string.
     *     array  [selected_areas]         - Selected areas
     *       string [type]                 - Area type.
     *                                       Possible values: 'circle', 'polygon', 'rect'.
     *       array  [value]                - Area parameters.
     *         e.g.,
     *         'type' => 'circle',
     *         'value' => [
     *             'center' => ['lat' => 40, 'lng' => 80],
     *             'distance' => 1000
     *         ]
     *
     *         'type' => 'polygon',
     *         'value' => [
     *             'points' => [[74, 40], [88, 30], [90, 25]]
     *         ]
     *
     *         'type' => 'rect',
     *         'value' => [
     *             'top_left' => [50, 90],
     *             'bottom_right' => [48, 70]
     *         ]
     *
     *     array  [bounding_box]           - Coordinates of bounding box
     *       float [top]                   - Top
     *       float [left]                  - Left
     *       float [bottom                 - Bottom
     *       float [right]                 - Right
     *
     *     array  [center]                 - GPS coordinates of central point.
     *       float [lat]                   - Latitude.
     *       float [lng]                   - Longitude.
     *     float  [distance]               - Distance from the area center.
     *     string [display]                - Display option of the contacts.
     *                                       Possible values:
     *                                         'all' - all records;
     *                                         'routed' - only routed records;
     *                                         'unrouted' - only unrouted records.
     *     float  [assigned_member_id]     - A member the contact assigned to.
     *     float  [is_assigned]            - If true, the contact assigned to a member.
     *   array  [order_by]                 - Array of order fields
     *                                       You can sort the results using the specified fields:
     *                                       address_1, address_alias, first_name, last_name,
     *                                       address_phone_number, address_email, address_group,
     *                                       in_route_count, visited_count, last_visited_timestamp,
     *                                       last_routed_timestamp
     *                                       e.g., [["address_1", "asc"], ["last_name", "desc"]]
     *
     *   int    [page = 1]                 - Page number.
     *   int    [per_page = 30]            - Records number per page.
     * @return ResponsePagination
     * @throws Exception\ApiError
     */
    public function getAddressesPaginatedByBodyPayload(?array $options = null) : ResponsePagination
    {
        $allBodyFields = ['fields', 'filter', 'order_by', 'page', 'per_page'];

        return $this->toResponsePagination(Route4Me::makeRequst([
            'url' => Endpoint::ADDRESSES_INDEX_PAGINATION,
            'method' => 'POST',
            'HTTPHEADER' => 'Content-Type: application/json',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $options)
        ]));
    }

    /**
     * Get the Address clusters filtered by the corresponding query text, and with the option
     * to filter the result by the 'routed' and 'unrouted' state.
     *
     * @see {@link https://virtserver.swaggerhub.com/Route4Me/address-book/1.0.0}
     *
     * @param  array [$options]            - Array of options.
     *   string [display = 'all']          - Specify which Addresses to show in the
     *                                       corresponding query results.
     *                                       Possible values:
     *                                         'all' - all records;
     *                                         'routed' - only routed records;
     *                                         'unrouted' - only unrouted records.
     *   string [query]                    - Search in the Addresses by the
     * @return ResponseClustering
     * @throws Exception\ApiError
     */
    public function getAddressClusters(?array $options = null) : ResponseClustering
    {
        $allQueryFields = ['display', 'query'];

        return $this->toResponseClustering(Route4Me::makeRequst([
            'url' => Endpoint::ADDRESSES_INDEX_CLUSTERING,
            'method' => 'GET',
            'query' => Route4Me::generateRequestParameters($allQueryFields, $options)
        ]));
    }

    /**
     * Get the Address clusters by sending the corresponding body payload.
     *
     * @see {@link https://virtserver.swaggerhub.com/Route4Me/address-book/1.0.0}
     *
     * @param  array [$options]            - Array of options.
     *   array [clustering]                - Clustering
     *     int    [precision = 5]          - Clusering precision.
     *                                       Possible values from 1 to 12.
     *   array  [filter]                   - FIlter parameters
     *     string [query]                  - Query string.
     *     array  [selected_areas]         - Selected areas
     *       string [type]                 - Area type.
     *                                       Possible values: 'circle', 'polygon', 'rect'.
     *       array  [value]                - Area parameters.
     *         e.g.,
     *         'type' => 'circle',
     *         'value' => [
     *             'center' => ['lat' => 40, 'lng' => 80],
     *             'distance' => 1000
     *         ]
     *
     *         'type' => 'polygon',
     *         'value' => [
     *             'points' => [[74, 40], [88, 30], [90, 25]]
     *         ]
     *
     *         'type' => 'rect',
     *         'value' => [
     *             'top_left' => [50, 90],
     *             'bottom_right' => [48, 70]
     *         ]
     *
     *     array  [bounding_box]           - Coordinates of bounding box
     *       float [top]                   - Top
     *       float [left]                  - Left
     *       float [bottom                 - Bottom
     *       float [right]                 - Right
     *
     *     array  [center]                 - GPS coordinates of central point.
     *       float [lat]                   - Latitude.
     *       float [lng]                   - Longitude.
     *     float  [distance]               - Distance from the area center.
     *     string [display]                - Display option of the contacts.
     *                                       Possible values:
     *                                         'all' - all records;
     *                                         'routed' - only routed records;
     *                                         'unrouted' - only unrouted records.
     *     float  [assigned_member_id]     - A member the contact assigned to.
     *     float  [is_assigned]            - If true, the contact assigned to a member.
     * @return ResponseClustering
     * @throws Exception\ApiError
     */
    public function getAddressClustersByBodyPayload(?array $options = null) : ResponseClustering
    {
        $allBodyFields = ['clustering', 'filter'];

        return $this->toResponseClustering(Route4Me::makeRequst([
            'url' => Endpoint::ADDRESSES_INDEX_CLUSTERING,
            'method' => 'POST',
            'HTTPHEADER' => 'Content-Type: application/json',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $options)
        ]));
    }

    /**
     * Find an Address by sending the 'address_id' query parameter.
     *
     * @see {@link https://virtserver.swaggerhub.com/Route4Me/address-book/1.0.0}
     *
     * @param  int    $addressId           - The Address ID to be searched for.
     * @return ResponseAddress
     * @throws Exception\ApiError
     */
    public function getAddressById(int $addressId) : ResponseAddress
    {
        return $this->toResponseAddress(Route4Me::makeRequst([
            'url' => Endpoint::ADDRESSES_SHOW,
            'method' => 'GET',
            'query' => ['address_id' => $addressId]
        ]));
    }

    /**
     * Find multiple Addresses by sending a body payload with the array of
     * the corresponding Address IDs.
     *
     * @see {@link https://virtserver.swaggerhub.com/Route4Me/address-book/1.0.0}
     *
     * @param  array  $addressIds          - The array of Address IDs to be searched for.
     * @return ResponseAll
     * @throws Exception\ApiError
     */
    public function getAddressesByIds(array $addressIds) : ResponseAll
    {
        return $this->toResponseAll(Route4Me::makeRequst([
            'url' => Endpoint::ADDRESSES_SHOW,
            'method' => 'POST',
            'HTTPHEADER' => 'Content-Type: application/json',
            'body' => ['address_ids' => $addressIds]
        ]));
    }

    /**
     * Add a new Address Book Contact by sending a body payload with the corresponding parameters.
     *
     * @see {@link https://route4me.io/docs/#create-a-location}
     *
     * @param  $params_or_address           - Array of address's parameters or Address object
     *   string address_1                   - The route Address Line 1.
     *   float  cached_lat                  - Cached latitude.
     *   float  cached_lng                  - Cached longitude.
     *   string address_stop_type           - The type of stop that this is one of:
     *                                        'DELIVERY', 'PICKUP', 'BREAK', 'MEETUP',
     *                                        'SERVICE', 'VISIT' or 'DRIVEBY'.
     *   int    [created_timestamp]         - When the contact created.
     *   string [address_2]                 - The route Address Line 2 which is not used for geocoding.
     *   int    [member_id]                 - Address book contact owner ID.
     *   string [address_zip]               - The zip code the address is located in.
     *   string [address_group]             - Address group.
     *   string [address_alias]             - Address alias.
     *   string [address_city]              - The city the address is located in.
     *   string [address_state_id]          - The state the address is located in.
     *   string [address_country_id]        - The country the address is located in.
     *   string [first_name]                - The first name of the receiving address.
     *   string [last_name]                 - The last name of the receiving party.
     *   string [address_email]             - Address email.
     *   string [address_phone_number]      - The phone number for the address.
     *   float  [curbside_lat]              - Curbside latitude.
     *   float  [curbside_lng]              - Curbside longitude.
     *   array  [address_custom_data]       - Array of Address custom data, as 'key' => value
     *   int    [local_time_window_start]   - Time Window Start in seconds, relative to the route start
     *                                        date (midnight), UTC time zone. It is relative to start
     *                                        date because start time changes would shift time windows.
     *   int    [local_time_window_end]     - Time Window End in seconds, relative to the route start
     *                                        date (midnight), UTC time zone. It is relative to start
     *                                        datebecause start time changes would shift time windows.
     *   int    [local_time_window_start_2] - See local_time_window_start
     *   int    [local_time_window_end_2]   - See local_time_window_end
     *   string [local_timezone_string]     - Local timezone string
     *   int    [service_time]              - Consumed service time at an address.
     *   string [color]                     - Color of an address, e.g., 'FF0000'.
     *   string [address_icon]              - URL to an address icon file.
     *   array  [schedule[]]                - Array of array of the trip schedules to a location.
     *     bool   [enabled]                 - If true, the schedule is enabled.
     *     string [mode]                    - Schedule mode.
     *     array  [monthly]                 - Monthly.
     *       int    [every]                 - Every.
     *   array  [schedule_blacklist]        - Array of the dates, which should be excluded from a trip
     *                                        schedule to a location. Also can be a date string with
     *                                        the 'YYYY-MM-DD' format or null.
     *   float  [address_cube]              - The cubic volume of the cargo being delivered or picked
     *                                        up at the address.
     *   float  [address_pieces]            - The item quantity of the cargo being delivered or picked
     *                                        up at the address.
     *   string [address_reference_no]      - The reference number for the address.
     *   float  [address_revenue]           - The total revenue for the address
     *   float  [address_weight]            - Weight of the cargo being delivered or picked up
     *                                        at the address.
     *   int    [address_priority]          - Priority of address 0 is the highest priority,
     *                                        n has higher priority than n + 1
     *   string [address_customer_po]       - The customer purchase order for the address
     *   bool   [eligible_pickup]           - If true, the address is eligible to pickup.
     *   bool   [eligible_depot]            - If true, the addrss is eligible to depot.
     *   array  [assigned_to]               - Assigned to
     *     int    [member_id]               - A member the address assigned to.
     *     string [member_first_name]       - Member first name.
     *     string [member_last_name]        - Member last name.
     *     string [member_email]            - Member email.
     *     string [until]                   - The assignment is valid until to.
     * @return ResponseAddress
     * @throws Exception\ApiError
     */
    public function addAddress($params_or_address) : ResponseAddress
    {
        $allBodyFields = ['address_1', 'cached_lat', 'cached_lng', 'address_stop_type', 'created_timestamp',
            'address_2', 'member_id', 'address_zip', 'address_group', 'address_alias', 'address_city',
            'address_state_id', 'address_country_id', 'first_name', 'last_name', 'address_email',
            'address_phone_number', 'curbside_lat', 'curbside_lng', 'address_custom_data',
            'local_time_window_start', 'local_time_window_end', 'local_time_window_start_2',
            'local_time_window_end_2', 'local_timezone_string', 'service_time', 'color', 'address_icon',
            'schedule', 'schedule_blacklist', 'address_cube', 'address_pieces', 'address_reference_no',
            'address_revenue', 'address_weight', 'address_priority', 'address_customer_po', 'eligible_pickup',
            'eligible_depot', 'assigned_to'
        ];

        return $this->toResponseAddress(Route4Me::makeRequst([
            'url' => Endpoint::ADDRESSES,
            'method' => 'POST',
            'HTTPHEADER' => 'Content-Type: application/json',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params_or_address)
        ]));
    }

    /**
     * Add multiple new Address Book Contacts by sending a body payload with the array of
     * the corresponding Address parameters.
     *
     * @see {@link https://route4me.io/docs/#create-a-location}
     *
     * @param  array  $arr                 - Array of Address for more information look addAddress.
     * @return bool
     * @throws Exception\ApiError
     */
    public function addMultipleAddresses($arr) : bool
    {
        $allBodyFields = ['address_1', 'cached_lat', 'cached_lng', 'address_stop_type', 'created_timestamp',
            'address_2', 'member_id', 'address_zip', 'address_group', 'address_alias', 'address_city',
            'address_state_id', 'address_country_id', 'first_name', 'last_name', 'address_email',
            'address_phone_number', 'curbside_lat', 'curbside_lng', 'address_custom_data',
            'local_time_window_start', 'local_time_window_end', 'local_time_window_start_2',
            'local_time_window_end_2', 'local_timezone_string', 'service_time', 'color', 'address_icon',
            'schedule', 'schedule_blacklist', 'address_cube', 'address_pieces', 'address_reference_no',
            'address_revenue', 'address_weight', 'address_priority', 'address_customer_po', 'eligible_pickup',
            'eligible_depot', 'assigned_to'
        ];

        $data = [];
        foreach ($arr as $key => $value) {
            $data[] = Route4Me::generateRequestParameters($allBodyFields, $value);
        }

        $result = Route4Me::makeRequst([
            'url' => Endpoint::ADDRESSES_BATCH_CREATE,
            'method' => 'POST',
            'HTTPHEADER' => 'Content-Type: application/json',
            'body' => ['data' => $data]
        ]);

        if (is_array($result) && isset($result['status'])) {
            return (bool)$result['status'];
        }
        return false;
    }

    /**
     * Update the Address Book Contact by specifying the 'address_id' path parameter
     * and by sending a body payload with the corresponding Address parameters.
     *
     * @see {@link https://virtserver.swaggerhub.com/Route4Me/address-book/1.0.0}
     *
     * @param  int    $addressId           - The Address ID to update.
     * @param  array  $params              - Parameters of address to update, for more
     *                                       information look addAddress
     * @return ResponseAddress
     * @throws Exception\ApiError
     */
    public function updateAddressById(int $addressId, $params) : ResponseAddress
    {
        $allBodyFields = ['address_1', 'cached_lat', 'cached_lng', 'address_stop_type', 'created_timestamp',
            'address_2', 'member_id', 'address_zip', 'address_group', 'address_alias', 'address_city',
            'address_state_id', 'address_country_id', 'first_name', 'last_name', 'address_email',
            'address_phone_number', 'curbside_lat', 'curbside_lng', 'address_custom_data',
            'local_time_window_start', 'local_time_window_end', 'local_time_window_start_2',
            'local_time_window_end_2', 'local_timezone_string', 'service_time', 'color', 'address_icon',
            'schedule', 'schedule_blacklist', 'address_cube', 'address_pieces', 'address_reference_no',
            'address_revenue', 'address_weight', 'address_priority', 'address_customer_po', 'eligible_pickup',
            'eligible_depot', 'assigned_to'
        ];

        return $this->toResponseAddress(Route4Me::makeRequst([
            'url' => Endpoint::ADDRESSES . '/' . $addressId,
            'method' => 'PUT',
            'HTTPHEADER' => 'Content-Type: application/json',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params)
        ]));
    }

    /**
     * Update multiple Address Book Contacts by sending a body payload with the array
     * of the corresponding Address IDs and Address parameters.
     *
     * @see {@link https://virtserver.swaggerhub.com/Route4Me/address-book/1.0.0}
     *
     * @param  array $address_ids           - An array of the address IDs (int).
     * @param  $params_or_updateAddress     - Array of addresses parameters or "UpdateAddress" object
     *                                        for more information look addAddress, requires only
     *                                        one parameter service_time, all other are optional.
     * @return ResponseAddress[]
     * @throws Exception\ApiError
     */
    public function updateAddressesByIds(array $address_ids, $params_or_updateAddress) : array
    {
        $allBodyFields = ['address_1', 'cached_lat', 'cached_lng', 'address_stop_type', 'created_timestamp',
            'address_2', 'member_id', 'address_zip', 'address_group', 'address_alias', 'address_city',
            'address_state_id', 'address_country_id', 'first_name', 'last_name', 'address_email',
            'address_phone_number', 'curbside_lat', 'curbside_lng', 'address_custom_data',
            'local_time_window_start', 'local_time_window_end', 'local_time_window_start_2',
            'local_time_window_end_2', 'local_timezone_string', 'service_time', 'color', 'address_icon',
            'schedule', 'schedule_blacklist', 'address_cube', 'address_pieces', 'address_reference_no',
            'address_revenue', 'address_weight', 'address_priority', 'address_customer_po', 'eligible_pickup',
            'eligible_depot'
        ];

        $params = Route4Me::generateRequestParameters($allBodyFields, $params_or_updateAddress);
        $params['address_ids'] = $address_ids;

        $result = Route4Me::makeRequst([
            'url' => Endpoint::ADDRESSES_BATCH_UPDATE,
            'method' => 'PUT',
            'HTTPHEADER' => 'Content-Type: application/json',
            'body' => $params
        ]);

        if (is_array($result)) {
            $data = [];
            foreach ($result as $key => $value) {
                $data[] = $this->toResponseAddress($value);
            }
            return $data;
        }
        return [];
    }

    /**
     * Update Address Book Contacts by sending a body payload with the corresponding query
     * text and specified territory areas.
     *
     * @see {@link https://virtserver.swaggerhub.com/Route4Me/address-book/1.0.0}
     *
     * @todo request has uncheckable result - 403 forbidden
     *
     * @param  array  $filter              - FIlter parameters
     *   string [query]                    - Search in the Addresses by the query phrase.
     *   array  [bounding_box]             - Coordinates of bounding box
     *     float [top]                     - Top
     *     float [left]                    - Left
     *     float [bottom                   - Bottom
     *     float [right]                   - Right
     *   array  [selected_areas]           - Selected areas
     *     string [type]                   - Area type.
     *                                       Possible values: 'circle', 'polygon', 'rect'.
     *     array  [value]                  - Area parameters.
     *       e.g.,
     *       'type' => 'circle',
     *       'value' => [
     *           'center' => ['lat' => 40, 'lng' => 80],
     *           'distance' => 1000
     *       ]
     *
     *       'type' => 'polygon',
     *       'value' => [
     *           'points' => [[74, 40], [88, 30], [90, 25]]
     *       ]
     *
     *       'type' => 'rect',
     *       'value' => [
     *           'top_left' => [50, 90],
     *           'bottom_right' => [48, 70]
     *       ]
     * @param  array  $params               - Parameters of address to update, for more
     *                                        information look addAddresses
     *   string [address_group]             - Address group.
     *   string [address_alias]             - Address alias.
     *   int    [member_id]                 - Address book contact owner ID.
     *   string [first_name]                - The first name of the receiving address.
     *   string [last_name]                 - The last name of the receiving party.
     *   string [address_email]             - Address email.
     *   string [address_phone_number]      - The phone number for the address.
     *   array  [address_custom_data]       - Array of Address custom data, as 'key' => value
     *   int    [local_time_window_start]   - Time Window Start in seconds, relative to the route start
     *                                        date (midnight), UTC time zone. It is relative to start
     *                                        date because start time changes would shift time windows.
     *   int    [local_time_window_end]     - Time Window End in seconds, relative to the route start
     *                                        date (midnight), UTC time zone. It is relative to start
     *                                        datebecause start time changes would shift time windows.
     *   int    [local_time_window_start_2] - See local_time_window_start
     *   int    [local_time_window_end_2]   - See local_time_window_end
     *   string [local_timezone_string]     - Local timezone string
     *   int    [service_time]              - Consumed service time at an address.
     *   string [color]                     - Color of an address, e.g., 'FF0000'.
     *   string [address_icon]              - URL to an address icon file.
     *   bool   [eligible_pickup]           - If true, the address is eligible to pickup.
     *   bool   [eligible_depot]            - If true, the addrss is eligible to depot.
     * @return StatusChecker
     * @throws Exception\ApiError
     */
    public function updateAddressesByAreas(array $filter, array $params) : StatusChecker
    {
        $allFilterFields = ['query', 'bounding_box', 'selected_areas'];

        $allParamsFields = ['member_id', 'address_group', 'address_alias', 'first_name', 'last_name',
            'address_email', 'address_phone_number', 'address_custom_data', 'local_time_window_start',
            'local_time_window_end', 'local_time_window_start_2', 'local_time_window_end_2',
            'local_timezone_string', 'service_time', 'color', 'address_icon', 'eligible_pickup',
            'eligible_depot'
        ];

        return new StatusChecker(Route4Me::makeRequst([
            'url' => Endpoint::ADDRESSES_UPDATE_BY_AREAS,
            'method' => 'PUT',
            'HTTPHEADERS' => ['Content-Type: application/json', 'Accept: application/json'],
            'return_headers' => ['location'],
            'body' => [
                'filter' => Route4Me::generateRequestParameters($allFilterFields, $filter),
                'data' => Route4Me::generateRequestParameters($allParamsFields, $params)
            ]
        ]));
    }

    /**
     * Delete multiple Address Book Contacts by sending a body payload with the
     * array of the corresponding Address IDs.
     *
     * @see {@link https://virtserver.swaggerhub.com/Route4Me/address-book/1.0.0}
     *
     * @param  array  addressIds           - The array of Address IDs to delete.
     * @return StatusChecker
     * @throws Exception\ApiError
     */
    public function deleteAddressesByIds(array $addressIds) : StatusChecker
    {
        return new StatusChecker(Route4Me::makeRequst([
            'url' => Endpoint::ADDRESSES_DELETE,
            'method' => 'DELETE',
            'HTTPHEADER' => 'Content-Type: application/json',
            'return_headers' => ['location', 'x-job-id'],
            'body' => ['address_ids' => $addressIds]
        ]));
    }

    /**
     * Delete the Address Book Contacts located in the selected areas by sending
     * the corresponding body payload.
     *
     * @see {@link https://virtserver.swaggerhub.com/Route4Me/address-book/1.0.0}
     *
     * @todo request has uncheckable result - 403 forbidden
     *
     * @param  array  $filter              - FIlter parameters
     *   string [query]                    - Search in the Addresses by the query phrase.
     *   array  [bounding_box]             - Coordinates of bounding box
     *     float [top]                     - Top
     *     float [left]                    - Left
     *     float [bottom                   - Bottom
     *     float [right]                   - Right
     *   array  [selected_areas]           - Selected areas
     *     string [type]                   - Area type.
     *                                       Possible values: 'circle', 'polygon', 'rect'.
     *     array  [value]                  - Area parameters.
     *       e.g.,
     *       'type' => 'circle',
     *       'value' => [
     *           'center' => ['lat' => 40, 'lng' => 80],
     *           'distance' => 1000
     *       ]
     *
     *       'type' => 'polygon',
     *       'value' => [
     *           'points' => [[74, 40], [88, 30], [90, 25]]
     *       ]
     *
     *       'type' => 'rect',
     *       'value' => [
     *           'top_left' => [50, 90],
     *           'bottom_right' => [48, 70]
     *       ]
     * @return StatusChecker
     * @throws Exception\ApiError
     */
    public function deleteAddressesByAreas($filter) : StatusChecker
    {
        $allFilterFields = ['query', 'bounding_box', 'selected_areas'];

        return new StatusChecker(Route4Me::makeRequst([
            'url' => Endpoint::ADDRESSES_DELETE_BY_AREAS,
            'method' => 'DELETE',
            'return_headers' => ['location', 'x-job-id'],
            'HTTPHEADERS' => ['Content-Type: application/json', 'Accept: application/json'],
            'body' => ['filter' => Route4Me::generateRequestParameters($allFilterFields, $filter)]
        ]));
    }

    /**
     * Get all Address custom fields.
     *
     * @see {@link https://virtserver.swaggerhub.com/Route4Me/address-book/1.0.0}
     *
     * @return array
     * @throws Exception\ApiError
     */
    public function getAddressCustomFields() : array
    {
        return Route4Me::makeRequst([
            'url' => Endpoint::ADDRESSES_CUSTOM_FIELDS,
            'method' => 'GET'
        ]);
    }

    /**
     * Get depots Addresses.
     *
     * @see {@link https://virtserver.swaggerhub.com/Route4Me/address-book/1.0.0}
     *
     * @return array
     * @throws Exception\ApiError
     */
    public function getAddressesDepots() : array
    {
        return Route4Me::makeRequst([
            'url' => Endpoint::ADDRESSES_DEPOTS,
            'method' => 'GET'
        ]);
    }

    /**
     * Export Address Book Contacts to the specified file by sending a body
     * payload with the array of the corresponding Address IDs.
     *
     * @see {@link https://virtserver.swaggerhub.com/Route4Me/address-book/1.0.0}
     *
     * @param  array  addressIds           - Array of addresses ID to export.
     * @param  string filename             - The name of the file to export.
     * @return StatusChecker
     * @throws Exception\ApiError
     */
    public function exportAddressesByIds(array $addressIds, string $filename) : StatusChecker
    {
        return new StatusChecker(Route4Me::makeRequst([
            'url' => Endpoint::ADDRESSES_EXPORT,
            'method' => 'POST',
            'HTTPHEADER' => 'Content-Type: application/json',
            'return_headers' => ['location'],
            'body' => ['ids' => $addressIds, 'filename' => $filename]
        ]));
    }

    /**
     * Export the Address Book Contacts located in the selected areas
     * by sending the corresponding body payload.
     *
     * @see {@link https://virtserver.swaggerhub.com/Route4Me/address-book/1.0.0}
     *
     * @todo request has uncheckable result - 403 forbidden
     *
     * @param  array  $filter              - FIlter parameters
     *   string [query]                    - Search in the Addresses by the query phrase.
     *   array  [bounding_box]             - Coordinates of bounding box
     *     float [top]                     - Top
     *     float [left]                    - Left
     *     float [bottom                   - Bottom
     *     float [right]                   - Right
     *   array  [selected_areas]           - Selected areas
     *     string [type]                   - Area type.
     *                                       Possible values: 'circle', 'polygon', 'rect'.
     *     array  [value]                  - Area parameters.
     *       e.g.,
     *       'type' => 'circle',
     *       'value' => [
     *           'center' => ['lat' => 40, 'lng' => 80],
     *           'distance' => 1000
     *       ]
     *
     *       'type' => 'polygon',
     *       'value' => [
     *           'points' => [[74, 40], [88, 30], [90, 25]]
     *       ]
     *
     *       'type' => 'rect',
     *       'value' => [
     *           'top_left' => [50, 90],
     *           'bottom_right' => [48, 70]
     *        ]
     *   string filename                   - The name of the file to export.
     * @return StatusChecker
     * @throws Exception\ApiError
     */
    public function exportAddressesByAreas(array $filter) : StatusChecker
    {
        $allFilterFields = ['query', 'bounding_box', 'selected_areas', 'filename'];

        return new StatusChecker(Route4Me::makeRequst([
            'url' => Endpoint::ADDRESSES_EXPORT_BY_AREAS,
            'method' => 'POST',
            'HTTPHEADERS' => ['Content-Type: application/json', 'Accept: application/json'],
            'return_headers' => ['location'],
            'body' => ['filter' => Route4Me::generateRequestParameters($allFilterFields, $filter)]
        ]));
    }

    /**
     * Export Addresses by the specified area IDs.
     *
     * @see {@link https://virtserver.swaggerhub.com/Route4Me/address-book/1.0.0}
     *
     * @todo request has uncheckable result - 403 forbidden
     *
     * @param  array  territoryIds         - An array of the territory IDs.
     * @param  string filename             - The name of the file to export.
     * @return StatusChecker
     * @throws Exception\ApiError
     */
    public function exportAddressesByAreaIds(array $territoryIds, string $filename) : StatusChecker
    {
        return new StatusChecker(Route4Me::makeRequst([
            'url' => Endpoint::ADDRESSES_EXPORT_BY_AREA_IDS,
            'method' => 'POST',
            'HTTPHEADERS' => ['Content-Type: application/json', 'Accept: application/json'],
            'return_headers' => ['location'],
            'body' => ['territory_ids' => $territoryIds, 'filename' => $filename]
        ]));
    }

    /**
     * Check the asynchronous job status by specifying the 'job_id' path parameter.
     *
     * @see {@link https://virtserver.swaggerhub.com/Route4Me/address-book/1.0.0}
     *
     * @param  int    filename             - Job ID to check status.
     * @return StatusChecker
     * @throws Exception\ApiError
     */
    public function getAddressesAsynchronousJobStatus(string $jobId) : StatusChecker
    {
        return new StatusChecker(Route4Me::makeRequst([
            'url' => Endpoint::ADDRESSES_JOB_TRACKER_STATUS . '/' . $jobId,
            'method' => 'GET',
            'HTTPHEADER' => 'Accept: application/json',
            'return_headers' => ['X-R4M-Async-Job-Running-Time']
        ]));
    }

    /**
     * Get the asynchronous job result by specifying the 'job_id' path parameter.
     *
     * @see {@link https://virtserver.swaggerhub.com/Route4Me/address-book/1.0.0}
     *
     * @param  int    filename             - Job ID get result.
     * @return bool
     * @throws Exception\ApiError
     */
    public function getAddressesAsynchronousJobResult(string $jobId) : bool
    {
        $result = Route4Me::makeRequst([
            'url' => Endpoint::ADDRESSES_JOB_TRACKER_RESULT . '/' . $jobId,
            'method' => 'GET'
        ]);
        return (is_array($result) && isset($result['status']) ? $result['status'] : false);
    }

    private function toResponseAddress($result) : ResponseAddress
    {
        if (is_array($result)) {
            return new ResponseAddress($result);
        }
        throw new ApiError('Can not convert result to ResponseAddress object.');
    }

    private function toResponseAll($result) : ResponseAll
    {
        if (is_array($result)) {
            return new ResponseAll($result);
        }
        throw new ApiError('Can not convert result to ResponseAll object.');
    }

    private function toResponsePagination($result) : ResponsePagination
    {
        if (is_array($result)) {
            return new ResponsePagination($result);
        }
        throw new ApiError('Can not convert result to ResponsePagination object.');
    }

    private function toResponseClustering($result) : ResponseClustering
    {
        if (is_array($result)) {
            return new ResponseClustering($result);
        }
        throw new ApiError('Can not convert result to ResponseClustering object.');
    }
}
