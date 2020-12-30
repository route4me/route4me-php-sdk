<?php

namespace Route4Me\Members;

/**
 * Class MemberResponseV4
 * @package Route4Me\Members
 * Response from the user endpoint (/api.v4/user.php) request.
 */
class MemberResponseV4 extends \Route4Me\Common
{
    /** @var string $HIDE_NONFUTURE_ROUTES
     * If true, the nonfuture routes will be hidden ('TRUE', 'FALSE').
     */
    public $HIDE_NONFUTURE_ROUTES;

    /** @var string $HIDE_ROUTED_ADDRESSES
     * If true, the routed addresses will be hidden ('TRUE', 'FALSE').
     */
    public $HIDE_ROUTED_ADDRESSES;

    /** @var string $HIDE_VISITED_ADDRESSES
     * If true, the visited addresses will be hidden ('TRUE', 'FALSE').
     */
    public $HIDE_VISITED_ADDRESSES;

    /** @var string $member_id
     * The member ID
     */
    public $member_id;

    /** @var string $OWNER_MEMBER_ID
     * The user's account owner ID.
     */
    public $OWNER_MEMBER_ID;

    /** @var string $READONLY_USER
     * If true, the user has read-only access type ('TRUE', 'FALSE').
     */
    public $READONLY_USER;

    /** @var string $SHOW_ALL_DRIVERS
     * If true, all drivers are visible to the user ('TRUE', 'FALSE').
     */
    public $SHOW_ALL_DRIVERS;

    /** @var string $SHOW_ALL_VEHICLES
     * If true, all vehicles are visible to the user ('1', '0').
     */
    public $SHOW_ALL_VEHICLES;

    /** @var string $date_of_birth
     * Birthdate of the user.
     */
    public $date_of_birth;

    /** @var string $member_email
     * User's email.
     */
    public $member_email;

    /** @var stringn $member_first_name
     * User's first name.
     */
    public $member_first_name;

    /** @var string $member_last_name
     * User's last name.
     */
    public $member_last_name;

    /** @var string $member_phone
     * User's phone number.
     */
    public $member_phone;

    /** @var string $member_picture
     * A link to the user's picture.
     */
    public $member_picture;

    /** @var string $member_type
     * Member type. Available values:
     * PRIMARY_ACCOUNT, SUB_ACCOUNT_ADMIN, SUB_ACCOUNT_REGIONAL_MANAGER,
     * SUB_ACCOUNT_DISPATCHER, SUB_ACCOUNT_PLANNER, SUB_ACCOUNT_DRIVER
     */
    public $member_type;

    /** @var string $member_zipcode
     * User zipcode.
     */
    public $member_zipcode;

    /** @var string $preferred_language
     * Preferred language (en, fr).
     */
    public $preferred_language;

    /** @var string $preferred_units
     * Preferred unit (mi, km).
     */
    public $preferred_units;

    /** @var string $timezone
     * Member's location timezone.
     */
    public $timezone;

    /** @var string $user_reg_country_id
     * Registration country ID of a user.
     */
    public $user_reg_country_id;

    /** @var string $user_reg_state_id
     * Registration state ID of a user.
     */
    public $user_reg_state_id;

    /** @var int $level
     * Subordination level. 0 is the highest level.
     */
    public $level;

    /** @var array $custom_data
     * The user's custom data.
     */
    public $custom_data;

    /** @var string  $api_key*/
    public $api_key;

    public static function fromArray(array $params)
    {
        $memberResponseV4 = new self();

        foreach ($params as $key => $value) {
            if (property_exists($memberResponseV4, $key)) {
                $memberResponseV4->{$key} = $value;
            }
        }

        return $memberResponseV4;
    }

}