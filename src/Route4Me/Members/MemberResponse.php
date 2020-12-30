<?php

namespace Route4Me\Members;

/**
 * Class MemberResponse
 * @package Route4Me\Members
 * Response for the user's authentication, registration, session validation process.
 */
class MemberResponse extends \Route4Me\Common
{
    /** @var boolean $authenticated
     * A boolean flag indicating if the session is valid.
     */
    public $authenticated;

    /** @var boolean $status
     * Process status
     */
    public $status;

    /** @var string $geocoding_service
     * Geocoding service
     */
    public $geocoding_service;

    /** @var string $session_id
     * The integer session id of the current session.
     */
    public $session_id;

    /** @var string $session_guid
     * An MD5 hash string of the currently authenticated sesssion,
     * important to use this with future requests.
     */
    public $session_guid;

    /** @var string $member_first_name
     * The first name of the user.
     */
    public $member_first_name;

    /** @var string $member_last_name
     * The last name of the user.
     */
    public $member_last_name;

    /** @var int $member_timestamp_added
     * The unix timestamp when the user joined the service.
     */
    public $member_timestamp_added;

    /** @var string $industry
     * The industry the authenticated user specified.
     */
    public $industry;

    /** @var int $member_id
     * Member ID
     */
    public $member_id;

    /** @var string $member_email
     * Member email
     */
    public $member_email;

    /** @var boolean $is_trial
     * If the user is currently a trial customer.
     */
    public $is_trial;

    /** @var boolean $is_active
     * If the user is currently an active customer.
     */
    public $is_active;

    /** @var string $api_key
     * User's API key
     */
    public $api_key;

    /** @var int $tracking_ttl
     * Tracking TTL
     */
    public $tracking_ttl;

    /** @var boolean $hide_billing_section
     * Hide billing section.
     */
    public $hide_billing_section;

    /** @var string $last_known_member_payment_device
     * Last known member payment device (e.g. 'web').
     */
    public $last_known_member_payment_device;

    /** @var array $licensed_modules
     * Licensed module. e.g.:
     * 'MODULE__ROUTE_EDITOR_CUSTOM_DATA_EDITING',
     * 'MODULE__VOICE_NAVIGATION:TRUE',
     * 'MODULE__VOICE_NAVIGATION'
     */
    public $licensed_modules;

    /** @var boolean $member_business_type
     * Member business type (e.g. 'BUSINESS_EMPLOYEE').
     */
    public $member_business_type;

    /** @var string $geofence_polygon_shape
     * Geofence polygon shape. Available values:
     * 'circle', 'poly', 'rect'.
     */
    public $geofence_polygon_shape;

    /** @var int $geofence_polygon_size
     * Geofence polygon size
     */
    public $geofence_polygon_size;

    /** @var int $geofence_time_onsite_trigger_secs
     * Geofence onsite trigger time (seconds).
     */
    public $geofence_time_onsite_trigger_secs;

    /** @var int $geofence_minimum_trigger_speed
     * Geofence's minimum trigger speed.
     */
    public $geofence_minimum_trigger_speed;

    /** @var bool $is_subscription_past_due
     * True if the subscription is past due.
     */
    public $is_subscription_past_due;

    /** @var string $visited_departed_enabled
     * If true, triggering of the visited and departed activities is enabled.
     */
    public $visited_departed_enabled;

    /** @var string $long_press_enabled
     * If true, long press is enabled.
     */
    public $long_press_enabled;

    /** @var int $account_type_id
     * The account type ID.
     */
    public $account_type_id;

    /** @var string $current_price
     * Current price (e.g. '0.000').
     */
    public $current_price;

    /** @var int $initially_requested_account_type_id
     * Initially Requested account type ID.
     */
    public $initially_requested_account_type_id;

    /** @var string $account_type_alias
     * Account type alias
     */
    public $account_type_alias;

    /** @var string $member_type
     * Member type. Available values:
     * PRIMARY_ACCOUNT, SUB_ACCOUNT_ADMIN, SUB_ACCOUNT_REGIONAL_MANAGER,
     * SUB_ACCOUNT_DISPATCHER, SUB_ACCOUNT_PLANNER, SUB_ACCOUNT_DRIVER,
     * SUB_ACCOUNT_ANALYSTSUB_ACCOUNT_VENDORSUB_ACCOUNT_CUSTOMER_SERVICE
     */
    public $member_type;

    /** @var string $OWNER_MEMBER_ID
     * Parent user ID.
     */
    public $OWNER_MEMBER_ID;

    /** @var string $ROOT_OWNER_MEMBER_ID
     * Root owner member ID (e.g. '402088').
     */
    public $ROOT_OWNER_MEMBER_ID;

    /** @var string $ROOT_OWNER_MEMBER_EMAIL
     * Root owner member email.
     */
    public $ROOT_OWNER_MEMBER_EMAIL;

    /** @var string $ROOT_OWNER_MEMBER_API_KEY
     * Root owner member API key.
     */
    public $ROOT_OWNER_MEMBER_API_KEY;

    /** @var string $geocodingMethod
     * Geocoding method
     */
    public $geocodingMethod;

    /** @var string $service_type
     * Service type (e.g. 'pre5').
     */
    public $service_type;

    /** @var string $validated_by
     * Validated by (e.g. 'ADMIN_PANEL').
     */
    public $validated_by;

    /** @var int $max_stops_per_route
     * Maximum allowed number of the stops per route.
     */
    public $max_stops_per_route;

    /** @var int $max_routes
     * Maximum allowed number of the generated routes.
     */
    public $max_routes;

    /** @var int $max_route
     * Maximum allowed number of the generated routes.
     */
    public $max_route;

    /** @var int $route_planned
     * Planned route numbers
     */
    public $route_planned;

    /** @var int $routes_planned
     * Routes Planned
     */
    public $routes_planned;

    /** @var int $total_routes_planned
     * Total planned routes.
     */
    public $total_routes_planned;

    /** @var int $authentication_count
     * Authentication count.
     */
    public $authentication_count;

    /** @var string $salesforce_unique_record_id
     * Salesforce unique record ID.
     */
    public $salesforce_unique_record_id;

    /** @var string $salesforce_account_id
     * Salesforce account ID
     */
    public $salesforce_account_id;

    /** @var string $salesforce_lead_id
     * Salesforce lead ID
     */
    public $salesforce_lead_id;

    /** @var int $max_api_optimization_addresses
     * The maximun number of addresses the authenticated user
     * can optimize in this billing cycle.
     */
    public $max_api_optimization_addresses;

    /** @var int $max_api_geocoding_addresses
     * The maximun number of geocodings the authenticated user
     * can optimize in this billing cycle.
     */
    public $max_api_geocoding_addresses;

    /** @var int $max_api_directions_addresses
     * The maximum number of driving route transactions the authenticated
     * user can execute in this billing cycle.
     */
    public $max_api_directions_addresses;

    /** @var int $max_api_validation_addresses
     * The maximun number of address validation transactions the authenticated
     * user can execute in this billing cycle.
     */
    public $max_api_validation_addresses;

    /** @var int $max_stops_per_unoptimized_route
     * The maximum number of stops the authenticated user
     * can put into a route with optimization disabled.
     */
    public $max_stops_per_unoptimized_route;

    /** @var int $max_api_distance_tx
     * The maximum number of distance transactions the authenticated
     * user can execute in this billing cycle.
     */
    public $max_api_distance_tx;

    /** @var boolean $blDisplayUpgradeTrackingHTML
     * Display upgrade tracking HTML.
     */
    public $blDisplayUpgradeTrackingHTML;

    /** @var int $intTrackingTrigger
     * Tracking trigger (int).
     */
    public $intTrackingTrigger;

    /** @var int $last_payment_ts
     * The last unix timestamp when this user was successfully charged.
     */
    public $last_payment_ts;

    /** @var int $last_failed_payment_ts
     * The last unix timestamp when this user was failed to pay.
     */
    public $last_failed_payment_ts;

    /** @var int $account_expires_timestamp
     * Account expire date
     */
    public $account_expires_timestamp;

    /** @var boolean $account_past_due
     * Account past due
     */
    public $account_past_due;

    /** @var string $ui_input_method
     * UI input method
     */
    public $ui_input_method;

    /** @var string $registration_app
     * Registration application
     */
    public $registration_app;

    /** @var string $registration_device
     * Registration device
     */
    public $registration_device;

    /** @var string $preferred_units
     * Preferred units (mi, km)
     */
    public $preferred_units;

    /** @var string $preferred_language
     * Preferred language (en, fr)
     */
    public $preferred_language;

    /** @var string $hide_routed_addresses
     * If true, routed addresses will be hidden.
     */
    public $hide_routed_addresses;

    /** @var string $show_superuser_addresses
     * Show superuser addresses ('0', '1').
     */
    public $show_superuser_addresses;

    /** @var string $appdirect_url
     * Application direction URL
     */
    public $appdirect_url;

    /** @var int $timestamp_trial_expiration
     * Timestamp trial expiration
     */
    public $timestamp_trial_expiration;

    /** @var string $update_channel_name
     * Update channel name
     */
    public $update_channel_name;

    /** @var int $max_subusers_cnt
     * Maximum subusers count
     */
    public $max_subusers_cnt;

    /** @var string $hide_visited_addresses
     * If true, visited addresses will be hidden.
     */
    public $hide_visited_addresses;

    /** @var string $HIDE_NONFUTURE_ROUTES
     * If true, nonfuture routes will be hidden.
     */
    public $HIDE_NONFUTURE_ROUTES;

    /** @var string $display_max_routes_future_days
     * Display maximum routes future days ('0', '1').
     */
    public $display_max_routes_future_days;

    /** @var string $READONLY_USER
     * Readonly uer ('0', '1').
     */
    public $READONLY_USER;

    /** @var int $auto_logout_ts
     * Time in seconds. A user will be logged out after been inactive during specified by this parameter seconds.
     */
    public $auto_logout_ts;

    public static function fromArray(array $params)
    {
        $memberResponse = new self();

        foreach ($params as $key => $value) {
            if (property_exists($memberResponse, $key)) {
                $memberResponse->{$key} = $value;
            }
        }

        return $memberResponse;
    }

}