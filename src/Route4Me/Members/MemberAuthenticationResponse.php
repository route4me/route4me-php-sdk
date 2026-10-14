<?php

namespace Route4Me\Members;

/**
 * Class MemberAuthenticationResponse.
 */
class MemberAuthenticationResponse extends \Route4Me\Common
{
    /** @var bool
     * True, if authentication process was finished successfuly.
     */
    public $status;

    /** @var string
     * Geocoding service
     */
    public $geocoding_service;

    /** @var int
     * Session ID
     */
    public $session_id;

    /** @var string
     * Session guid
     */
    public $session_guid;

    /** @var int
     * Member ID
     */
    public $member_id;

    /** @var string
     * API key of an user
     */
    public $api_key;

    /** @var int
     * Tracking TTL
     */
    public $tracking_ttl;

    /** @var string
     * Update channel name
     */
    public $update_channel_name;

    /** @var string
     * Geofence polygon shape. ENUM('circle', 'poly', 'rect').
     */
    public $geofence_polygon_shape;

    /** @var int
     * Geofence polygon size
     */
    public $geofence_polygon_size;

    /** @var int
     * Geofence time onsite trigger in seconds.
     */
    public $geofence_time_onsite_trigger_secs;

    /** @var int
     * Geofence minimum trigger speed.
     */
    public $geofence_minimum_trigger_speed;

    /** @var bool
     * If true, subscription is past due.
     */
    public $is_subscription_past_due;

    /** @var string
     * if true, triggering of the visited and departed activities is enabled.
     */
    public $visited_departed_enabled;

    /** @var string
     * if true, long press is enabled.
     */
    public $long_press_enabled;

    /** @var string
     * The account type ID
     */
    public $account_type_id;

    /** @var string
     * Account type alias.
     */
    public $account_type_alias;

    /** @var string
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

    /** @var string
     * Maximum stops per route.
     */
    public $max_stops_per_route;

    /** @var string
     * Maximum number of the routes.
     */
    public $max_routes;

    /** @var int
     * Number of the planned routes by an user.
     */
    public $routes_planned;

    /** @var string
     * Preferred units. Enum('km', 'mi').
     */
    public $preferred_units;

    /** @var string
     * Preferred language. Enum('en', 'fr').
     */
    public $preferred_language;

    /** @var string
     * If true, routed addresses will be hidden.
     */
    public $HIDE_ROUTED_ADDRESSES;

    /** @var string
     * If true, visited addresses will be hidden.
     */
    public $HIDE_VISITED_ADDRESSES;

    /** @var string
     * If equal to true, nonfuture addresses will be hidden.
     */
    public $HIDE_NONFUTURE_ROUTES;

    /** @var string
     * If equal to true, user can only read data.
     */
    public $READONLY_USER;

    /** @var int
     * Time in seconds. If a user is inactive during this period, he will be logout.
     */
    public $auto_logout_ts;

    /** @var string
     * Last known member payment device (e.g. 'web')
     */
    public $last_known_member_payment_device;

    /** @var int
     * Account expire date
     */
    public $account_expires_timestamp;

    /** @var bool
     * Account past due
     */
    public $account_past_due;

    /** @var array
     * Licensed module. e.g.:
     * 'MODULE__ROUTE_EDITOR_CUSTOM_DATA_EDITING',
     * 'MODULE__VOICE_NAVIGATION:TRUE',
     * 'MODULE__VOICE_NAVIGATION'
     */
    public $licensed_modules;

    /** @var int
     * Last active timestamp
     */
    public $last_active_timestamp;
}
