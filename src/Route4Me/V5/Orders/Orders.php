<?php

namespace Route4Me\V5\Orders;

use Route4Me\Exception\ApiError;
use Route4Me\Route4Me;
use Route4Me\Common;
use Route4Me\V5\Enum\Endpoint;
use Route4Me\V5\Orders\CustomField;
use Route4Me\V5\Orders\ResponseOrder;
use Route4Me\V5\Orders\ResponseSearch;

/**
 * Orders v5 API
 *
 * @since 1.3.0
 *
 * @package Route4Me
 */
class Orders extends Common
{
    public function __construct()
    {
        Route4Me::setBaseUrl('');
    }

    /**
     * Create single order
     *
     * @since 1.3.0
     *
     * @param  $params_or_order             - Array of order's parameters or Order object
     *   number member_id                   - Order owner ID.
     *   string address_1                   - The order Address line 1.
     *   string address_2                   - The order Address line 2.
     *   string address_alias               - Address alias.
     *   string address_city                - The city the address is located in.
     *   string address_state               - The state the address is located in.
     *   string address_zip                 - The zip code the address is located in.
     *   string address_country             - The country the address is located in.
     *   object address_geo                 - GPS coords of address.
     *     number lat                       - Latitude.
     *     number lng                       - Longitude.
     *   object curbside_geo                - Curbside GPS coords of address.
     *     number lat                       - Curbside latitude.
     *     number lng                       - Curbside longitude.
     *   string date_scheduled_for          - Date scheduled.
     *                                        Possible formats: YY-MM-DD, YYMMDD, ISO 8601
     *   number order_status_id             - Order status ID.
     *   bool   is_pending                  - If true, the order is pending.
     *   bool   is_accepted                 - If true, the order is accepted.
     *   bool   is_started                  - If true, the order is started.
     *   bool   is_completed                - If true, the order is completed.
     *   bool   is_validated                - If true, the order is validated.
     *   string phone                       - The phone number.
     *   string first_name                  - The first name.
     *   string last_name                   - The last name.
     *   string email                       - E-mail.
     *   array  custom_data                 - Order custom data.
     *     string barcode                   - Tracking number for order.
     *     string airbillno                 - Additional tracking number for order.
     *     string sorted_on_date            - Datetime string with "T" delimiter, ISO 8601.
     *     number sorted_on_utc             - Timestamp only; replaced data in
     *                                        sorted_on_date` property.
     *   array  local_time_windows          - Array of Time Window objects.
     *     number start                     - Start of Time Window, unix timestamp.
     *     number end                       - End of Time Window, unix timestamp.
     *   string local_timezone_string       - Local timezone string
     *   number service_time                - Consumed service time.
     *   string color                       - Color of an address, e.g., 'FF0000'.
     *   string tracking_number             - Tracking number
     *   string address_stop_type           - The type of stop that this is
     *                                        one of 'DELIVERY', 'PICKUP', 'BREAK', 'MEETUP',
     *                                        'SERVICE', 'VISIT' or 'DRIVEBY'.
     *   number last_status
     *   number weight                      - Weight of the cargo.
     *   number cost                        - Cost of the cargo.
     *   number revenue                     - The total revenue for the order.
     *   number cube                        - The cubic volume of the cargo.
     *   number pieces                      - The item quantity of the cargo.
     *   string group                       - The group.
     *   number address_priority            - Priority of address 0 is the highest priority,
     *                                        n has higher priority than n + 1
     *   string address_customer_po         - The customer purchase order for
     *                                        the address, length <= 50.
     *   array  custom_fields               - Array of Custom Fields objects.
     *     string order_custom_field_uuid   - HEX-string.
     *     string order_custom_field_value  - Value of Custom Fields.
     * @return ResponseOrder
     * @throws Exception\ApiError
     */
    public function create($params_or_order) : ResponseOrder
    {
        $allBodyFields = ['member_id', 'address_1', 'address_2', 'address_alias',
            'address_city', 'address_state', 'address_zip', 'address_country', 'address_geo', 'curbside_geo',
            'date_scheduled_for', 'order_status_id', 'is_pending', 'is_accepted',
            'is_started', 'is_completed', 'is_validated', 'phone', 'first_name',
            'last_name', 'email', 'custom_data', 'local_time_windows', 'local_timezone_string',
            'service_time', 'color', 'tracking_number', 'address_stop_type', 'last_status', 'weight',
            'cost', 'revenue', 'cube', 'pieces', 'group', 'address_priority',
            'address_customer_po', 'custom_fields'
        ];

        return $this->toResponseOrder(Route4Me::makeRequst([
            'url' => Endpoint::ORDER_CREATE,
            'method' => 'POST',
            'HTTPHEADER' => 'Content-Type: application/json',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params_or_order)
        ]));
    }

    /**
     * Show single order by its id
     *
     * @since 1.3.0
     *
     * @param  string $order_id - Order ID.
     * @return ResponseOrder
     * @throws Exception\ApiError
     */
    public function get(string $order_id) : ResponseOrder
    {
        return $this->toResponseOrder(Route4Me::makeRequst([
            'url' => Endpoint::ORDER . '/' . $order_id,
            'method' => 'GET'
        ]));
    }

    /**
     * Update single order by its id
     *
     * @since 1.3.0
     *
     * @param  string $order_id - Order ID.
     * @param  object $params   - Parameters of order to update, look for more
     *                            information in create()
     * @return ResponseOrder
     * @throws Exception\ApiError
     */
    public function update(string $order_id, $params) : ResponseOrder
    {
        $allBodyFields = ['member_id', 'address_1', 'address_2', 'address_alias',
            'address_city', 'address_state', 'address_zip', 'address_country', 'address_geo', 'curbside_geo',
            'date_scheduled_for', 'order_status_id', 'is_pending', 'is_accepted',
            'is_started', 'is_completed', 'is_validated', 'phone', 'first_name',
            'last_name', 'email', 'custom_data', 'local_time_windows', 'local_timezone_string',
            'service_time', 'color', 'tracking_number', 'address_stop_type', 'last_status', 'weight',
            'cost', 'revenue', 'cube', 'pieces', 'group', 'address_priority',
            'address_customer_po', 'custom_fields'
        ];

        return $this->toResponseOrder(Route4Me::makeRequst([
            'url' => Endpoint::ORDER . '/' . $order_id,
            'method' => 'PUT',
            'HTTPHEADER' => 'Content-Type: application/json',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params)
        ]));
    }

    /**
     * Delete (soft) single order by its id
     *
     * @since 1.3.0
     *
     * @param  string $order_id - Order ID.
     * @return bool
     * @throws Exception\ApiError
     */
    public function delete(string $order_id) : bool
    {
        $res = Route4Me::makeRequst([
            'url' => Endpoint::ORDER . '/' . $order_id,
            'method' => 'DELETE'
        ]);
        return (isset($res['status']) ? $res['status'] : false);
    }

    /**
     * Search orders in ElasticSearch storage or in Spanner database
     *
     * @since 1.3.0
     *
     * @param  $params                    - Search and filter parameters.
     *   string[] [order_ids]             - Array of order ids, HEX-Strings.
     *   bool     return_provided_fields_as_map
     *   array    [orderBy]               - Sort and direction parameters.
     *     string   0                     - The name of the sort field, this is one of
     *                                      'address_alias', 'first_name', 'last_name', 'phone',
     *                                      'is_pending', 'is_validated', 'is_accepted',
     *                                      'is_completed', 'scheduled_for', 'day_added'
     *     string   [1 = 'asc']           - Sorting direction, this is one of 'asc', 'ASC', 'desc', 'DESC'
     *   int      [limit = 30]            - The number of orders per page.
     *   int      [offset = 0]            - The requested page.
     *   string[] [fields]                - An array of returned fields, this is one of
     *                                      'order_uuid', 'member_id', 'address_1', 'address_2',
     *                                      'address_alias', 'address_city', 'address_state', 'address_zip',
     *                                      'address_country', 'coordinates', 'curbside_coordinates',
     *                                      'updated_timestamp', 'created_timestamp', 'day_added',
     *                                      'scheduled_for', 'order_status_id', 'is_pending', 'is_started',
     *                                      'is_completed', 'is_validated', 'phone', 'first_name', 'last_name',
     *                                      'email', 'custom_data', 'local_time_windows', 'local_timezone',
     *                                      'service_time', 'color', 'icon', 'last_visited_timestamp',
     *                                      'visited_count', 'in_route_count', 'last_routed_timestamp',
     *                                      'tracking_number', 'organization_id', 'root_member_id',
     *                                      'address_stop_type', 'last_status', 'sorted_day_id', 'weight',
     *                                      'cost', 'revenue', 'cube', 'pieces', 'done_day_id',
     *                                      'possession_day_id', 'group', 'workflow_uuid', 'address_priority'
     *   string[] [addition]              - An array of additional returned fields, this is one of
     *                                      'territory_ids', 'aggregation_ids'
     *   array    [search]                - Search parameters.
     *     string   [query]               - The string to query to ElasticSearch. If set the `matches` and
     *                                      `terms` sections will be ignored.
     *     array    [matches]             - The object to query to ElasticSearch.
     *       array    [custom_data]       - Order custom data.
     *         string   [barcode]         - Tracking number for order.
     *         string   [airbillno]       - Additional tracking number for order.
     *         string   [sorted_on_date]  - Datetime String with "T" delimiter, ISO 8601.
     *         int      [sorted_on_utc]   - Timestamp only; replaced data in `sorted_on_date` property.
     *       string   [first_name]        - The first name.
     *       string   [last_name]         - The last name.
     *       string   [email]             - E-mail.
     *       string   [phone]             - The phone number.
     *       string   [address_1]         - The order Address line 1.
     *       string   [address_alias]     - Address alias.
     *       string   [address_zip]       - The zip code of the address.
     *     array    [terms]               - The object to query to ElasticSearch.
     *       array    [custom_data]       - Order custom data.
     *         string   [barcode]         - Tracking number for order.
     *         string   [airbillno]       - Additional tracking number for order.
     *         string   [sorted_on_date]  - Datetime String with "T" delimiter, ISO 8601.
     *         int      [sorted_on_utc]   - Timestamp only; replaced data in `sorted_on_date` property.
     *       string   [first_name]        - The first name.
     *       string   [last_name]         - The last name.
     *       string   [email]             - E-mail.
     *       string   [phone]             - The phone number.
     *       string   [address_1]         - The order Address line 1.
     *       string   [address_alias]     - Address alias.
     *       string   [address_zip]       - The zip code the address is located in.
     *   array    [filters]               - Filter parameters.
     *     string[] [order_ids]           - Array of included order ids, HEX-Strings.
     *     string[] [excluded_ids]        - Array of excluded order ids, HEX-Strings.
     *     string[] [tracking_numbers]    - Array of tracking number of orders.
     *     bool  [only_geocoded]
     *     int|string|array [updated_timestamp]  - Can be unix timestamp or ISO 8601 or array [
     *                                                 "start" => "timestamp or ISO 8601",
     *                                                 "end" => "timestamp or ISO 8601"
     *                                             ]
     *     int|string|array [created_timestamp]  - Can be unix timestamp or ISO 8601 or array [
     *                                                 "start" => "timestamp or ISO 8601",
     *                                                 "end" => "timestamp or ISO 8601"
     *                                             ]
     *     int|string|array [scheduled_for]        - Can be unix timestamp or ISO 8601 or array [
     *                                                 "start" => "timestamp or ISO 8601",
     *                                                 "end" => "timestamp or ISO 8601"
     *                                             ]
     *     bool  [only_unscheduled]
     *     int|string|array [day_added]            - Can be unix timestamp or ISO 8601 or array [
     *                                                 "start" => "timestamp or ISO 8601",
     *                                                 "end" => "timestamp or ISO 8601"
     *                                             ]
     *     int|string|array [sorted_on]            - Can be unix timestamp or ISO 8601 or array [
     *                                                 "start" => "timestamp or ISO 8601",
     *                                                 "end" => "timestamp or ISO 8601"
     *                                             ]
     *     string[] [address_stop_types]           - Array of stop type names, possible values
     *                                               'DELIVERY', 'PICKUP', 'BREAK', 'MEETUP',
     *                                               'SERVICE', 'VISIT' or 'DRIVEBY'.
     *     int[]    [last_statuses]                - Array of statuses.
     *     int[]    [territory_ids]                - Array of territory ids.
     *     string   [done_day]
     *     string   [possession_day]
     *     string[] [groups]
     *     string   [display= 'all']               - Filtering by the in_route_count field, is one of
     *                                               'routed', 'unrouted', 'all'
     * @return ResponseSearch
     * @throws Exception\ApiError
     */
    public function search(?array $params = null) : ResponseSearch
    {
        $allBodyFields = ['order_ids', 'return_provided_fields_as_map', 'orderBy', 'limit',
            'offset', 'fields', 'addition', 'search', 'filters'
        ];

        $result = Route4Me::makeRequst([
            'url' => Endpoint::ORDER,
            'method' => 'POST',
            'HTTPHEADER' => 'Content-Type: application/json',
            'body' => ($params ? Route4Me::generateRequestParameters($allBodyFields, $params) : [])
        ]);

        if (isset($result)) {
            return new ResponseSearch($result);
        }
        return [];
    }

    /**
     * Update the batch of orders (asynchronous, by filters)
     *
     * @since 1.3.0
     *
     * @param  array    $params             - Batch update parameters.
     *   array    data                      - Order values for batch update, look for more
     *                                        information in create()
     *   array    search                    - Search parameters for batch update,
     *                                        look for more information in search()
     *   array    filters                   - Filter parameters for batch update,
     *                                        look for more information in search()
     * @return bool
     * @throws Exception\ApiError
     */
    public function batchUpdateByFilters(array $params) : bool
    {
        $allBodyFields = ['data', 'search', 'filters'];

        $res = Route4Me::makeRequst([
            'url' => Endpoint::ORDER_BATCH_UPDATE_FILTER,
            'method' => 'PUT',
            'HTTPHEADER' => 'Content-Type: application/json',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params)
        ]);
        return (isset($res['success']) && $res['success'] == 1 ? true : false);
    }

    /**
     * Delete the batch of orders
     *
     * @since 1.3.0
     *
     * @param  string[] $orderIds           - Array of Order IDs, HEX-Strings.
     * @return bool
     * @throws Exception\ApiError
     */
    public function batchDelete(array $orderIds) : bool
    {
        $res = Route4Me::makeRequst([
            'url' => Endpoint::ORDER_BATCH_DELETE,
            'method' => 'POST',
            'HTTPHEADER' => 'Content-Type: application/json',
            'body' => ['order_ids' => $orderIds]
        ]);
        return (isset($res['status']) ? $res['status'] : false);
    }

    /**
     * Update the batch of orders by ids
     *
     * @since 1.3.0
     *
     * @param  string[] $orderIds           - Array of Order IDs, HEX-Strings.
     * @param  array    $data               - Order values for batch update,
     *                                        look for more information in create()
     * @return ResponseOrder[]
     * @throws Exception\ApiError
     */
    public function batchUpdate(array $orderIds, $data) : array
    {
        $allBodyFields = ['member_id', 'address_1', 'address_2', 'address_alias',
            'address_city', 'address_state', 'address_zip', 'address_country', 'address_geo', 'curbside_geo',
            'date_scheduled_for', 'order_status_id', 'is_pending', 'is_accepted',
            'is_started', 'is_completed', 'is_validated', 'phone', 'first_name',
            'last_name', 'email', 'custom_data', 'local_time_windows', 'local_timezone_string',
            'service_time', 'color', 'tracking_number', 'address_stop_type', 'last_status', 'weight',
            'cost', 'revenue', 'cube', 'pieces', 'group', 'address_priority',
            'address_customer_po', 'custom_fields'
        ];

        $res = Route4Me::makeRequst([
            'url' => Endpoint::ORDER_BATCH_UPDATE,
            'method' => 'POST',
            'HTTPHEADER' => 'Content-Type: application/json',
            'body' => [
                'order_ids' => $orderIds,
                'data' => Route4Me::generateRequestParameters($allBodyFields, $data)
            ]
        ]);

        $orders = [];
        if (is_array($res)) {
            foreach ($res as $key => $value) {
                $orders[] = new ResponseOrder($value);
            }
        }
        return $orders;
    }

    /**
     * Create the batch of orders
     *
     * @since 1.3.0
     *
     * @param  array    $orders             - Array of Orders or of array.
     *                                        look for more information in create()
     * @return bool
     * @throws Exception\ApiError
     */
    public function batchCreate(array $orders) : bool
    {
        $allBodyFields = ['member_id', 'address_1', 'address_2', 'address_alias',
            'address_city', 'address_state', 'address_zip', 'address_country', 'address_geo', 'curbside_geo',
            'date_scheduled_for', 'order_status_id', 'is_pending', 'is_accepted',
            'is_started', 'is_completed', 'is_validated', 'phone', 'first_name',
            'last_name', 'email', 'custom_data', 'local_time_windows', 'local_timezone_string',
            'service_time', 'color', 'tracking_number', 'address_stop_type', 'last_status', 'weight',
            'cost', 'revenue', 'cube', 'pieces', 'group', 'address_priority',
            'address_customer_po', 'custom_fields'
        ];

        $body = [];
        foreach ($orders as $key => $order) {
            $body[] = Route4Me::generateRequestParameters($allBodyFields, $order);
        }

        $res = Route4Me::makeRequst([
            'url' => Endpoint::ORDER_BATCH_CREATE,
            'method' => 'POST',
            'HTTPHEADER' => 'Content-Type: application/json',
            'body' => ['data' => $body]
        ]);
        return (isset($res['status']) ? $res['status'] : false);
    }

    /**
     * Get a list of Order Custom Fields
     *
     * @since 1.3.0
     *
     * @return CustomField[]
     * @throws Exception\ApiError
     */
    public function getOrderCustomFields() : array
    {
        $res = Route4Me::makeRequst([
            'url' => Endpoint::ORDER_CUSTOM_FIELDS,
            'method' => 'GET'
        ]);
        if (isset($result) && isset($result['data']) && is_array($result['data']) && is_array($result['data'][0])) {
            return new ResponseOrder($result['data'][0]);
        }
        $ocf = [];
        if (isset($res) && isset($res['data']) && is_array($res['data'])) {
            foreach ($res['data'] as $key => $value) {
                $ocf[] = new CustomField($value);
            }
        }
        return $ocf;
    }

    /**
     * Create one Order Custom Field
     *
     * @since 1.3.0
     *
     * @param  array    $params_or_custom_field      - Params of CustomField custom field
     *   string   data.order_custom_field_name       - Name, max 128 characters.
     *   string   data.order_custom_field_type       - Type, max 128 characters.
     *   string   data.order_custom_field_label      - Label, max 128 characters.
     *   array    data.order_custom_field_type_info  - Info, as JSON Object max 4096 characters.
     * @return CustomField
     * @throws Exception\ApiError
     */
    public function createOrderCustomField($params_or_custom_field) : CustomField
    {
        $allBodyFields = ['order_custom_field_name', 'order_custom_field_type',
            'order_custom_field_label', 'order_custom_field_type_info'];

        return $this->toCustomField(Route4Me::makeRequst([
            'url' => Endpoint::ORDER_CUSTOM_FIELDS,
            'method' => 'POST',
            'HTTPHEADER' => 'Content-Type: application/json',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params_or_custom_field)
        ]));
    }

    /**
     * Update one Order Custom Fields
     *
     * @since 1.3.0
     *
     * @param  array    $uuid                        - OrderCustomField ID, HEX-string.
     * @param  array    $params_or_custom_field      - Params of Order custom field
     *   string   data.order_custom_field_type       - Type, max 128 characters.
     *   string   data.order_custom_field_label      - Label, max 128 characters.
     *   array    data.order_custom_field_type_info  - Info, as JSON Object max 4096 characters.
     * @return CustomField
     * @throws Exception\ApiError
     */
    public function updateOrderCustomField(string $uuid, $params_or_custom_field) : CustomField
    {
        $allBodyFields = ['order_custom_field_type', 'order_custom_field_label', 'order_custom_field_type_info'];

        return $this->toCustomField(Route4Me::makeRequst([
            'url' => Endpoint::ORDER_CUSTOM_FIELDS . '/' . $uuid,
            'method' => 'PUT',
            'HTTPHEADER' => 'Content-Type: application/json',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params_or_custom_field)
        ]));
    }

    /**
     * Delete an Order Custom Fields
     *
     * @since 1.3.0
     *
     * @param  array    $uuid                        - OrderCustomField ID, HEX-string.
     * @return CustomField
     * @throws Exception\ApiError
     */
    public function deleteOrderCustomField(string $uuid) : CustomField
    {
        return $this->toCustomField(Route4Me::makeRequst([
            'url' => Endpoint::ORDER_CUSTOM_FIELDS . '/' . $uuid,
            'method' => 'DELETE'
        ]));
    }

    private function toResponseOrder($result) : ResponseOrder
    {
        if (is_array($result)) {
            return new ResponseOrder($result);
        }
        throw new ApiError('Can not convert result to ResponseOrder object.');
    }

    private function toCustomField($result) : CustomField
    {
        if (isset($result) && isset($result['data']) && is_array($result['data'])) {
            return new CustomField($result['data']);
        }
        throw new ApiError('Can not convert result to CustomField object.');
    }
}
