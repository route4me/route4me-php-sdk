<?php

namespace Route4Me\V5\TeamManagement;

use Route4Me\Exception\ApiError;
use Route4Me\Route4Me;
use Route4Me\Common;
use Route4Me\V5\Enum\Endpoint;
use Route4Me\V5\TeamManagement\ResponseTeam;

/**
 * Team Management API
 *
 * @since 1.2.7
 *
 * @package Route4Me
 */
class TeamManagement extends Common
{
    public function __construct()
    {
        Route4Me::setBaseUrl('');
    }

    /**
     * Add a new sub-user to the Member account by sending the corresponding
     * body payload with the sub-users' parameters.
     *
     * @see {@link https://virtserver.swaggerhub.com/Route4Me}
     *
     * @param  array $params                   - Sub-user properties.
     *   string new_password                   - Password.
     *   string new_member_picture             - Member picture.
     *   string member_first_name              - First name.
     *   string member_last_name               - Last name.
     *   string member_email                   - E-mail.
     *   string member_company                 - Company.
     *   string member_type                    - Member type.
     *   int    OWNER_MEMBER_ID                - Owner member ID.
     *   string member_phone                   - Phone.
     *   string date_of_birth                  - Date of birth.
     *   int    user_reg_state_id              - User state ID.
     *   int    user_reg_country_id            - User country ID.
     *   float  DriverHourlyRate               - Drive hourly rate.
     *   bool   HIDE_ROUTED_ADDRESSES          - Hide routed addresses.
     *   bool   HIDE_VISITED_ADDRESSES         - Hide visited addresses.
     *   bool   HIDE_NONFUTURE_ROUTES          - Hide nonfuture routes.
     *   bool   READONLY_USER                  - Readonly user.
     *   bool   SHOW_SUSR_ADDR                 - Show sub-user addresses.
     *   bool   SHOW_SUSR_ORDERS               - Show sub-user orders.
     *   bool   SHOW_ALL_DRIVERS               - Show all drivers.
     *   bool   SHOW_ALL_VEHICLES              - Show all vehicles.
     *   bool   display_max_routes_future_days - Display max routes.
     *   int    vendor_id                      - Vendoe ID.
     *   float  driving_rate                   - Driving rate.
     *   float  working_rate                   - Working rate.
     *   float  mile_rate                      - Mile rate.
     *   float  idling_rate                    - Idling rate.
     *   string timezone                       - Timezone.
     *   string optimization_profile_id        - Optimization profile ID.
     *   array  permissions                    - Array of permissions
     *     string id                           - ID of permission
     *     array  value                        - Array of string values
     * @return ResponseTeam
     * @throws Exception\ApiError
     */
    public function create(array $params) : ResponseTeam
    {
        $allBodyFields = ['new_password', 'new_member_picture', 'member_first_name', 'member_last_name',
            'member_email', 'member_company', 'member_type', 'OWNER_MEMBER_ID', 'member_phone', 'date_of_birth',
            'user_reg_state_id', 'user_reg_country_id', 'DriverHourlyRate', 'HIDE_ROUTED_ADDRESSES',
            'HIDE_VISITED_ADDRESSES', 'HIDE_NONFUTURE_ROUTES', 'READONLY_USER', 'SHOW_SUSR_ADDR', 'SHOW_SUSR_ORDERS',
            'SHOW_ALL_DRIVERS', 'SHOW_ALL_VEHICLES', 'display_max_routes_future_days', 'vendor_id', 'driving_rate',
            'working_rate', 'mile_rate', 'idling_rate', 'timezone', 'optimization_profile_id', 'permissions'
        ];

        return $this->toResponseTeam(Route4Me::makeRequst([
            'url' => Endpoint::TEAM_USERS,
            'method' => 'POST',
            'HTTPHEADER' => 'Content-Type: application/json',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params)
        ]));
    }

    /**
     * View all existing sub-users associated with the Member’s account.
     *
     * @see {@link https://virtserver.swaggerhub.com/Route4Me}
     *
     * @return ResponseTeam[]
     * @throws Exception\ApiError
     */
    public function getUsers() : ?array
    {
        $result = Route4Me::makeRequst([
            'url' => Endpoint::TEAM_USERS,
            'method' => 'GET'
        ]);

        if (is_array($result)) {
            $arr = [];
            foreach ($result as $key => $value) {
                array_push($arr, $this->toResponseTeam($value));
            }
            return $arr;
        }
        return null;
    }

    /**
     * Get the sub-user by specifying the path parameter ID.
     *
     * @see {@link https://virtserver.swaggerhub.com/Route4Me}
     *
     * @param  int $userId                                  - User ID.
     * @return ResponseTeam
     * @throws Exception\ApiError
     */
    public function getUser(int $userId) : ResponseTeam
    {
        return $this->toResponseTeam(Route4Me::makeRequst([
            'url' => Endpoint::TEAM_USERS . '/' . $userId,
            'method' => 'GET'
        ]));
    }

    /**
     * Delete the sub-user by specifying the path parameter ID.
     *
     * @see {@link https://virtserver.swaggerhub.com/Route4Me}
     *
     * @param  int $userId                                  - User ID.
     * @return ResponseTeam                                 - Deleted object
     * @throws Exception\ApiError
     */
    public function delete(int $userId) : ResponseTeam
    {
        return $this->toResponseTeam(Route4Me::makeRequst([
            'url' => Endpoint::TEAM_USERS . '/' . $userId,
            'method' => 'DELETE'
        ]));
    }

    /**
     * Update the sub-user by specifying the path parameter ID and by sending the
     * corresponding body payload with the sub-user's parameters..
     *
     * @see {@link https://virtserver.swaggerhub.com/Route4Me}
     *
     * @param int $userId                                  - User ID.
     * @param  array $params                   - Sub-user properties.
     *   string new_password                   - Password.
     *   string new_member_picture             - Member picture.
     *   string member_first_name              - First name.
     *   string member_last_name               - Last name.
     *   string member_email                   - E-mail.
     *   string member_company                 - Company.
     *   string member_type                    - Member type.
     *   int    OWNER_MEMBER_ID                - Owner member ID.
     *   string member_phone                   - Phone.
     *   string date_of_birth                  - Date of birth.
     *   int    user_reg_state_id              - User state ID.
     *   int    user_reg_country_id            - User country ID.
     *   float  DriverHourlyRate               - Drive hourly rate.
     *   bool   HIDE_ROUTED_ADDRESSES          - Hide routed addresses.
     *   bool   HIDE_VISITED_ADDRESSES         - Hide visited addresses.
     *   bool   HIDE_NONFUTURE_ROUTES          - Hide nonfuture routes.
     *   bool   READONLY_USER                  - Readonly user.
     *   bool   SHOW_SUSR_ADDR                 - Show sub-user addresses.
     *   bool   SHOW_SUSR_ORDERS               - Show sub-user orders.
     *   bool   SHOW_ALL_DRIVERS               - Show all drivers.
     *   bool   SHOW_ALL_VEHICLES              - Show all vehicles.
     *   bool   display_max_routes_future_days - Display max routes.
     *   int    vendor_id                      - Vendoe ID.
     *   float  driving_rate                   - Driving rate.
     *   float  working_rate                   - Working rate.
     *   float  mile_rate                      - Mile rate.
     *   float  idling_rate                    - Idling rate.
     *   string timezone                       - Timezone.
     *   string optimization_profile_id        - Optimization profile ID.
     *   array  permissions                    - Array of permissions
     *     string id                           - ID of permission
     *     array  value                        - Array of string values
     * @return ResponseTeam
     * @throws Exception\ApiError
     */
    public function update(int $userId, array $params) : ResponseTeam
    {
        $allBodyFields = ['new_password', 'new_member_picture', 'member_first_name', 'member_last_name',
            'member_email', 'member_company', 'member_type', 'OWNER_MEMBER_ID', 'member_phone', 'date_of_birth',
            'user_reg_state_id', 'user_reg_country_id', 'DriverHourlyRate', 'HIDE_ROUTED_ADDRESSES',
            'HIDE_VISITED_ADDRESSES', 'HIDE_NONFUTURE_ROUTES', 'READONLY_USER', 'SHOW_SUSR_ADDR', 'SHOW_SUSR_ORDERS',
            'SHOW_ALL_DRIVERS', 'SHOW_ALL_VEHICLES', 'display_max_routes_future_days', 'vendor_id', 'driving_rate',
            'working_rate', 'mile_rate', 'idling_rate', 'timezone', 'optimization_profile_id', 'permissions'
        ];

        return $this->toResponseTeam(Route4Me::makeRequst([
            'url' => Endpoint::TEAM_USERS . '/' . $userId,
            'method' => 'PATCH',
            'HTTPHEADER' => 'Content-Type: application/json',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params)
        ]));
    }

    /**
     * Add multiple sub-users to the User account by sending the corresponding
     * body payload with the array of the sub-users' parameters
     *
     * @see {@link https://virtserver.swaggerhub.com/Route4Me}
     *
     * @param  array $params                   - Array of array of Sub-user properties.
     *   string new_password                   - Password.
     *   string new_member_picture             - Member picture.
     *   string member_first_name              - First name.
     *   string member_last_name               - Last name.
     *   string member_email                   - E-mail.
     *   string member_company                 - Company.
     *   string member_type                    - Member type.
     *   int    OWNER_MEMBER_ID                - Owner member ID.
     *   string member_phone                   - Phone.
     *   string date_of_birth                  - Date of birth.
     *   int    user_reg_state_id              - User state ID.
     *   int    user_reg_country_id            - User country ID.
     *   float  DriverHourlyRate               - Drive hourly rate.
     *   bool   HIDE_ROUTED_ADDRESSES          - Hide routed addresses.
     *   bool   HIDE_VISITED_ADDRESSES         - Hide visited addresses.
     *   bool   HIDE_NONFUTURE_ROUTES          - Hide nonfuture routes.
     *   bool   READONLY_USER                  - Readonly user.
     *   bool   SHOW_SUSR_ADDR                 - Show sub-user addresses.
     *   bool   SHOW_SUSR_ORDERS               - Show sub-user orders.
     *   bool   SHOW_ALL_DRIVERS               - Show all drivers.
     *   bool   SHOW_ALL_VEHICLES              - Show all vehicles.
     *   bool   display_max_routes_future_days - Display max routes.
     *   int    vendor_id                      - Vendoe ID.
     *   float  driving_rate                   - Driving rate.
     *   float  working_rate                   - Working rate.
     *   float  mile_rate                      - Mile rate.
     *   float  idling_rate                    - Idling rate.
     *   string timezone                       - Timezone.
     *   string optimization_profile_id        - Optimization profile ID.
     *   array  permissions                    - Array of permissions
     *     string id                           - ID of permission
     *     array  value                        - Array of string values
     * @param  array options                   - Array of insert options.
     *   string [api_key]                      - User API key.
     *   string [conflicts]                    - Conflict resolving rule.
     *                                           Possible values: 'fail', 'overwrite' and 'skip'.
     * @return ResponseTeam
     * @throws Exception\ApiError
     */
    public function bulkInsert(array $params, ?array $options = null)
    {
        $allBodyFields = ['new_password', 'new_member_picture', 'member_first_name', 'member_last_name',
            'member_email', 'member_company', 'member_type', 'OWNER_MEMBER_ID', 'member_phone', 'date_of_birth',
            'user_reg_state_id', 'user_reg_country_id', 'DriverHourlyRate', 'HIDE_ROUTED_ADDRESSES',
            'HIDE_VISITED_ADDRESSES', 'HIDE_NONFUTURE_ROUTES', 'READONLY_USER', 'SHOW_SUSR_ADDR', 'SHOW_SUSR_ORDERS',
            'SHOW_ALL_DRIVERS', 'SHOW_ALL_VEHICLES', 'display_max_routes_future_days', 'vendor_id', 'driving_rate',
            'working_rate', 'mile_rate', 'idling_rate', 'timezone', 'optimization_profile_id', 'permissions'
        ];

        $allQueryFields = ['api_key', 'conflicts'];

        $body = [];
        foreach ($params as $key => $value) {
            $body[] = Route4Me::generateRequestParameters($allBodyFields, $value);
        }

        $result = Route4Me::makeRequst([
            'url' => Endpoint::TEAM_USERS_BULK_INSERT,
            'method' => 'POST',
            'HTTPHEADER' => 'Content-Type: application/json',
            'body' => ['users' => $body],
            'query' => Route4Me::generateRequestParameters($allQueryFields, $options)
        ]);

        if (is_array($result)) {
            $arr = [];
            foreach ($result as $key => $value) {
                array_push($arr, $this->toResponseTeam($value));
            }
            return $arr;
        }
        return null;
    }

    private function toResponseTeam($result) : ResponseTeam
    {
        if (is_array($result)) {
            return new ResponseTeam($result);
        }
        throw new ApiError('Can not convert result to ResponseTeam object.');
    }
}
