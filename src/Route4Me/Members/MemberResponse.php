<?php

namespace Route4Me\Members;

/**
 * Class MemberResponse.
 */
class MemberResponse extends \Route4Me\Common
{
    /** @var bool
     * A boolean flag indicating if the session is valid.
     */
    public $authenticated;

    /** @var bool
     * Process status
     */
    public $status;

    /** @var string
     * Geocoding service
     */
    public $geocoding_service;

    /** @var string
     * The integer session id of the current session.
     */
    public $session_id;

    /** @var string
     * An MD5 hash string of the currently authenticated sesssion,
     * important to use this with future requests.
     */
    public $session_guid;

    /** @var string
     * The first name of the user.
     */
    public $member_first_name;

    /** @var string
     * The last name of the user.
     */
    public $member_last_name;

    /** @var int
     * The unix timestamp when the user joined the service.
     */
    public $member_timestamp_added;

    /** @var string
     * The industry the authenticated user specified.
     */
    public $industry;

    /** @var int
     * Member ID
     */
    public $member_id;

    /** @var string
     * Member email
     */
    public $member_email;

    /** @var bool
     * If the user is currently a trial customer.
     */
    public $is_trial;

    /** @var bool
     * If the user is currently an active customer.
     */
    public $is_active;

    /** @var string
     * User's API key
     */
    public $api_key;

    /** @var int
     * Tracking TTL
     */
    public $tracking_ttl;

    /** @var bool
     * Hide billing section.
     */
    public $hide_billing_section;

    /** @var string
     * Last known member payment device (e.g. 'web').
     */
    public $last_known_member_payment_device;

    /** @var array
     * Licensed module. e.g.:
     * 'MODULE__ROUTE_EDITOR_CUSTOM_DATA_EDITING',
     * 'MODULE__VOICE_NAVIGATION:TRUE',
     * 'MODULE__VOICE_NAVIGATION'
     */
    public $licensed_modules;

    /** @var bool
     * Member business type (e.g. 'BUSINESS_EMPLOYEE').
     */
    public $member_business_type;

    /** @var string
     * Geofence polygon shape. Available values:
     * 'circle', 'poly', 'rect'.
     */
    public $geofence_polygon_shape;

    /** @var int
     * Geofence polygon size
     */
    public $geofence_polygon_size;

    /** @var int
     * Geofence onsite trigger time (seconds).
     */
    public $geofence_time_onsite_trigger_secs;

    /** @var int
     * Geofence's minimum trigger speed.
     */
    public $geofence_minimum_trigger_speed;

    /** @var bool
     * True if the subscription is past due.
     */
    public $is_subscription_past_due;

    /** @var string
     * If true, triggering of the visited and departed activities is enabled.
     */
    public $visited_departed_enabled;

    /** @var string
     * If true, long press is enabled.
     */
    public $long_press_enabled;

    /** @var int
     * The account type ID.
     */
    public $account_type_id;

    /** @var string
     * Current price (e.g. '0.000').
     */
    public $current_price;

    /** @var int
     * Initially Requested account type ID.
     */
    public $initially_requested_account_type_id;

    /** @var string
     * Account type alias
     */
    public $account_type_alias;

    /** @var string
     * Member type. Available values:
     * PRIMARY_ACCOUNT, SUB_ACCOUNT_ADMIN, SUB_ACCOUNT_REGIONAL_MANAGER,
     * SUB_ACCOUNT_DISPATCHER, SUB_ACCOUNT_PLANNER, SUB_ACCOUNT_DRIVER,
     * SUB_ACCOUNT_ANALYSTSUB_ACCOUNT_VENDORSUB_ACCOUNT_CUSTOMER_SERVICE
     */
    public $member_type;

    /** @var string
     * Parent user ID.
     */
    public $OWNER_MEMBER_ID;

    /** @var string
     * Root owner member ID (e.g. '402088').
     */
    public $ROOT_OWNER_MEMBER_ID;

    /** @var string
     * Root owner member email.
     */
    public $ROOT_OWNER_MEMBER_EMAIL;

    /** @var string
     * Root owner member API key.
     */
    public $ROOT_OWNER_MEMBER_API_KEY;

    /** @var string
     * Geocoding method
     */
    public $geocodingMethod;

    /** @var string
     * Service type (e.g. 'pre5').
     */
    public $service_type;

    /** @var string
     * Validated by (e.g. 'ADMIN_PANEL').
     */
    public $validated_by;

    /** @var int
     * Maximum allowed number of the stops per route.
     */
    public $max_stops_per_route;

    /** @var int
     * Maximum allowed number of the generated routes.
     */
    public $max_routes;

    /** @var int
     * Maximum allowed number of the generated routes.
     */
    public $max_route;

    /** @var int
     * Planned route numbers
     */
    public $route_planned;

    /** @var int
     * Routes Planned
     */
    public $routes_planned;

    /** @var int
     * Total planned routes.
     */
    public $total_routes_planned;

    /** @var int
     * Authentication count.
     */
    public $authentication_count;

    /** @var string
     * Salesforce unique record ID.
     */
    public $salesforce_unique_record_id;

    /** @var string
     * Salesforce account ID
     */
    public $salesforce_account_id;

    /** @var string
     * Salesforce lead ID
     */
    public $salesforce_lead_id;

    /** @var int
     * The maximun number of addresses the authenticated user
     * can optimize in this billing cycle.
     */
    public $max_api_optimization_addresses;

    /** @var int
     * The maximun number of geocodings the authenticated user
     * can optimize in this billing cycle.
     */
    public $max_api_geocoding_addresses;

    /** @var int
     * The maximum number of driving route transactions the authenticated
     * user can execute in this billing cycle.
     */
    public $max_api_directions_addresses;

    /** @var int
     * The maximun number of address validation transactions the authenticated
     * user can execute in this billing cycle.
     */
    public $max_api_validation_addresses;

    /** @var int
     * The maximum number of stops the authenticated user
     * can put into a route with optimization disabled.
     */
    public $max_stops_per_unoptimized_route;

    /** @var int
     * The maximum number of distance transactions the authenticated
     * user can execute in this billing cycle.
     */
    public $max_api_distance_tx;

    /** @var bool
     * Display upgrade tracking HTML.
     */
    public $blDisplayUpgradeTrackingHTML;

    /** @var int
     * Tracking trigger (int).
     */
    public $intTrackingTrigger;

    /** @var int
     * The last unix timestamp when this user was successfully charged.
     */
    public $last_payment_ts;

    /** @var int
     * The last unix timestamp when this user was failed to pay.
     */
    public $last_failed_payment_ts;

    /** @var int
     * Account expire date
     */
    public $account_expires_timestamp;

    /** @var bool
     * Account past due
     */
    public $account_past_due;

    /** @var string
     * UI input method
     */
    public $ui_input_method;

    /** @var string
     * Registration application
     */
    public $registration_app;

    /** @var string
     * Registration device
     */
    public $registration_device;

    /** @var string
     * Preferred units (mi, km)
     */
    public $preferred_units;

    /** @var string
     * Preferred language (en, fr)
     */
    public $preferred_language;

    /** @var string
     * If true, routed addresses will be hidden.
     */
    public $hide_routed_addresses;

    /** @var string
     * Show superuser addresses ('0', '1').
     */
    public $show_superuser_addresses;

    /** @var string
     * Application direction URL
     */
    public $appdirect_url;

    /** @var int
     * Timestamp trial expiration
     */
    public $timestamp_trial_expiration;

    /** @var string
     * Update channel name
     */
    public $update_channel_name;

    /** @var int
     * Maximum subusers count
     */
    public $max_subusers_cnt;

    /** @var string
     * If true, visited addresses will be hidden.
     */
    public $hide_visited_addresses;

    /** @var string
     * If true, nonfuture routes will be hidden.
     */
    public $HIDE_NONFUTURE_ROUTES;

    /** @var string
     * Display maximum routes future days ('0', '1').
     */
    public $display_max_routes_future_days;

    /** @var string
     * Readonly uer ('0', '1').
     */
    public $READONLY_USER;

    /** @var int
     * Time in seconds. A user will be logged out after been inactive during specified by this parameter seconds.
     */
    public $auto_logout_ts;
}
