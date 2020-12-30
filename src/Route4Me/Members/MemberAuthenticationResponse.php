<?php


namespace Route4Me\Members;

/**
 * Class MemberAuthenticationResponse
 * @package Route4Me\Members
 * Members Authentication Response
 */
class MemberAuthenticationResponse extends \Route4Me\Common
{
    /** @var boolean $status
     * True, if authentication process was finished successfuly.
     */
    public $status;

    /** @var string $geocoding_service
     * Geocoding service
     */
    public $geocoding_service;

    /** @var int $session_id
     * Session ID
     */
    public $session_id;

    /** @var string $session_guid
     * Session guid
     */
    public $session_guid;

    /** @var int $member_id
     * Member ID
     */
    public $member_id;

    /** @var string $api_key
     * API key of an user
     */
    public $api_key;

    /** @var int $tracking_ttl
     * Tracking TTL
     */
    public $tracking_ttl;

    /** @var string $update_channel_name
     * Update channel name
     */
    public $update_channel_name;

    /** @var string $geofence_polygon_shape
     * Geofence polygon shape. ENUM('circle', 'poly', 'rect').
     */
    public $geofence_polygon_shape ;

    /** @var int $geofence_polygon_size
     * Geofence polygon size
     */
    public $geofence_polygon_size;

    /** @var int $geofence_time_onsite_trigger_secs
     * Geofence time onsite trigger in seconds.
     */
    public $geofence_time_onsite_trigger_secs;

    /** @var int $geofence_minimum_trigger_speed
     * Geofence minimum trigger speed.
     */
    public $geofence_minimum_trigger_speed;

    /** @var boolean $is_subscription_past_due
     * If true, subscription is past due.
     */
    public $is_subscription_past_due;

    /** @var string $visited_departed_enabled
     * if true, triggering of the visited and departed activities is enabled.
     */
    public $visited_departed_enabled;

    /** @var string $long_press_enabled
     * if true, long press is enabled.
     */
    public $long_press_enabled;

    /** @var string $account_type_id
     * The account type ID
     */
    public $account_type_id;

    /** @var string $account_type_alias
     * Account type alias.
     */
    public $account_type_alias;

    /** @var string $member_type
     * A type of the member.
     * Available values:
     * 'PRIMARY_ACCOUNT',
     * 'SUB_ACCOUNT_ADMIN',
     * 'SUB_ACCOUNT_REGIONAL_MANAGER',
     * 'SUB_ACCOUNT_DISPATCHER',
     * 'SUB_ACCOUNT_PLANNER',
     * 'SUB_ACCOUNT_DRIVER',
     * 'SUB_ACCOUNT_ANALYST',
     * 'SUB_ACCOUNT_VENDOR',
     * 'SUB_ACCOUNT_CUSTOMER_SERVICE'
     */
    public $member_type;

    /** @var string $max_stops_per_route
     * Maximum stops per route.
     */
    public $max_stops_per_route;

    /** @var string $max_routes
     * Maximum number of the routes.
     */
    public $max_routes;

    /** @var int $routes_planned
     * Number of the planned routes by an user.
     */
    public $routes_planned;

    /** @var string $preferred_units
     * Preferred units. Enum('km', 'mi').
     */
    public $preferred_units;

    /** @var string $preferred_language
     * Preferred language. Enum('en', 'fr').
     */
    public $preferred_language;

    /** @var string $HIDE_ROUTED_ADDRESSES
     * If true, routed addresses will be hidden.
     */
    public $HIDE_ROUTED_ADDRESSES;

    /** @var string $HIDE_VISITED_ADDRESSES
     * If true, visited addresses will be hidden.
     */
    public $HIDE_VISITED_ADDRESSES;

    /** @var string $HIDE_NONFUTURE_ROUTES
     * If equal to true, nonfuture addresses will be hidden.
     */
    public $HIDE_NONFUTURE_ROUTES;

    /** @var string $READONLY_USER
     * If equal to true, user can only read data.
     */
    public $READONLY_USER;

    /** @var int $auto_logout_ts
     * Time in seconds. If a user is inactive during this period, he will be logout.
     */
    public $auto_logout_ts;

    /** @var string $last_known_member_payment_device
     * Last known member payment device (e.g. 'web')
     */
    public $last_known_member_payment_device;

    /** @var int $account_expires_timestamp
     * Account expire date
     */
    public $account_expires_timestamp;

    /** @var boolean $account_past_due
     * Account past due
     */
    public $account_past_due;

    /** @var array  $licensed_modules
     * Licensed module. e.g.:
     * 'MODULE__ROUTE_EDITOR_CUSTOM_DATA_EDITING',
     * 'MODULE__VOICE_NAVIGATION:TRUE',
     * 'MODULE__VOICE_NAVIGATION'
     */
    public $licensed_modules;

    /** @var int $last_active_timestamp
     * Last active timestamp
     */
    public $last_active_timestamp;

    public static function fromArray(array $params)
    {
        $memberAurhenticateResponse = new self();

        foreach ($params as $key => $value) {
            if (property_exists($memberAurhenticateResponse, $key)) {
                $memberAurhenticateResponse->{$key} = $value;
            }
        }

        return $memberAurhenticateResponse;
    }
}