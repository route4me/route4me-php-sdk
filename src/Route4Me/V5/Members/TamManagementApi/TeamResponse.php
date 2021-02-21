<?php


namespace Route4Me\V5\Members\TamManagementApi;

/**
 * Class TeamResponse
 * @package Route4Me\V5\Members\TamManagementApi
 * Response from the user endpoint (/api/v5.0/team/users) request
 */
class TeamResponse extends \Route4Me\Common
{
    /** The member ID
     * @var integer $member_id
     */
    public $member_id;

    /** The user's account owner ID
     * @var integer $OWNER_MEMBER_ID
     */
    public $OWNER_MEMBER_ID;

    /** User's first name
     * @var string $member_first_name
     */
    public $member_first_name;

    /** User's last name
     * @var string $member_last_name
     */
    public $member_last_name;

    /** User's email
     * @var string $member_email
     */
    public $member_email;

    /** User's phone number
     * @var string $member_phone
     */
    public $member_phone;

    /** Member's company name
     * @var string $member_company
     */
    public $member_company;

    /** Birthdate of the user.
     * @var string $date_of_birth
     */
    public $date_of_birth;

    /** Registration state ID of a user
     * @var string $user_reg_state_id
     */
    public $user_reg_state_id;

    /** Registration country ID of a user
     * @var string $user_reg_country_id
     */
    public $user_reg_country_id;

    /** A link to the user's picture
     * @var string $member_picture
     */
    public $member_picture;

    /** Member type. Available values:
     * <para>PRIMARY_ACCOUNT, SUB_ACCOUNT_ADMIN, SUB_ACCOUNT_REGIONAL_MANAGER,</para>
     * <para>SUB_ACCOUNT_DISPATCHER, SUB_ACCOUNT_PLANNER, SUB_ACCOUNT_DRIVER</para>
     * @var string $member_type
     */
    public $member_type;

    /** If true, the routed addresses will be hidden.
     * @var boolean $HIDE_ROUTED_ADDRESSES
     */
    public $HIDE_ROUTED_ADDRESSES;

    /** If true, the visited addresses will be hidden.
     * @var boolean $HIDE_VISITED_ADDRESSES
     */
    public $HIDE_VISITED_ADDRESSES;

    /** If true, the nonfuture routes will be hidden.
     * @var boolean $HIDE_NONFUTURE_ROUTES
     */
    public $HIDE_NONFUTURE_ROUTES;

    /** If true, the user has read-only access type.
     * @var boolean $READONLY_USER
     */
    public $READONLY_USER;

    /** If true, the global address book contacts
     * are visible in a user account.
     * @var boolean $SHOW_SUSR_ADDR
     */
    public $SHOW_SUSR_ADDR;

    /** If true, the global orders are visible in a user account.
     * @var boolean $SHOW_SUSR_ORDERS
     */
    public $SHOW_SUSR_ORDERS;

    /** If true, all drivers are visible to the user.
     * @var boolean $SHOW_ALL_DRIVERS
     */
    public $SHOW_ALL_DRIVERS;

    /** If true, all vehicles are visible to the user.
     * @var boolean $SHOW_ALL_VEHICLES
     */
    public $SHOW_ALL_VEHICLES;

    /** Allowed sub-member types in the user's account.
     * Available array item values:
     * "SUB_ACCOUNT_DRIVER", "SUB_ACCOUNT_DISPATCHER", "SUB_ACCOUNT_PLANNER",
     * "SUB_ACCOUNT_ANALYST", "SUB_ACCOUNT_ADMIN", "SUB_ACCOUNT_REGIONAL_MANAGER"
     * @var string[] $allowed_submember_types
     */
    public $allowed_submember_types;

    /** If true, the user can edit the account data.
     * @var boolean $can_edit
     */
    public $can_edit;

    /** If true, the user can delete the account data.
     * @var boolean $can_delete
     */
    public $can_delete;

    /** The user's custom data
     * @var Array $custom_data
     */
    public $custom_data;

    /** Hourly rate of a user
     * @var double $DriverHourlyRate
     */
    public $DriverHourlyRate;

    /** Vendor ID
     * @var string $vendor_id
     */
    public $vendor_id;

    /** Driving rate of a user.
     * @var double $driving_rate
     */
    public $driving_rate;

    /** Working rate of a user.
     * @var double $working_rate
     */
    public $working_rate;

    /** Mile rate of a user.
     * @var double $mile_rate
     */
    public $mile_rate;

    /** Mile rate of a user.
     * @var double $idling_rate
     */
    public $idling_rate;

    /** Display maximum_routes number of future days.
     * @var integer $display_max_routes_future_days
     */
    public $display_max_routes_future_days;

    /** Member's location timezone
     * @var string $timezone
     */
    public $timezone;

    public static function fromArray(array $params)
    {
        $teamtResponse = new self();

        foreach ($params as $key => $value) {
            if (property_exists($teamtResponse, $key)) {
                $teamtResponse->{$key} = $value;
            }
        }

        return $teamtResponse;
    }

}