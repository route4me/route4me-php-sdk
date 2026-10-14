<?php

namespace Route4Me\Members;

/**
 * Class MemberResponseV4.
 */
class MemberResponseV4 extends \Route4Me\Common
{
    /** @var string
     * If true, the nonfuture routes will be hidden ('TRUE', 'FALSE').
     */
    public $HIDE_NONFUTURE_ROUTES;

    /** @var string
     * If true, the routed addresses will be hidden ('TRUE', 'FALSE').
     */
    public $HIDE_ROUTED_ADDRESSES;

    /** @var string
     * If true, the visited addresses will be hidden ('TRUE', 'FALSE').
     */
    public $HIDE_VISITED_ADDRESSES;

    /** @var string
     * The member ID
     */
    public $member_id;

    /** @var string
     * The user's account owner ID.
     */
    public $OWNER_MEMBER_ID;

    /** @var string
     * If true, the user has read-only access type ('TRUE', 'FALSE').
     */
    public $READONLY_USER;

    /** @var string
     * If true, all drivers are visible to the user ('TRUE', 'FALSE').
     */
    public $SHOW_ALL_DRIVERS;

    /** @var string
     * If true, all vehicles are visible to the user ('1', '0').
     */
    public $SHOW_ALL_VEHICLES;

    /** @var string
     * Birthdate of the user.
     */
    public $date_of_birth;

    /** @var string
     * User's email.
     */
    public $member_email;

    /** @var stringn
     * User's first name.
     */
    public $member_first_name;

    /** @var string
     * User's last name.
     */
    public $member_last_name;

    /** @var string
     * User's phone number.
     */
    public $member_phone;

    /** @var string
     * A link to the user's picture.
     */
    public $member_picture;

    /** @var string
     * Member type. Available values:
     * PRIMARY_ACCOUNT, SUB_ACCOUNT_ADMIN, SUB_ACCOUNT_REGIONAL_MANAGER,
     * SUB_ACCOUNT_DISPATCHER, SUB_ACCOUNT_PLANNER, SUB_ACCOUNT_DRIVER
     */
    public $member_type;

    /** @var string
     * User zipcode.
     */
    public $member_zipcode;

    /** @var string
     * Preferred language (en, fr).
     */
    public $preferred_language;

    /** @var string
     * Preferred unit (mi, km).
     */
    public $preferred_units;

    /** @var string
     * Member's location timezone.
     */
    public $timezone;

    /** @var string
     * Registration country ID of a user.
     */
    public $user_reg_country_id;

    /** @var string
     * Registration state ID of a user.
     */
    public $user_reg_state_id;

    /** @var int
     * Subordination level. 0 is the highest level.
     */
    public $level;

    /** @var array
     * The user's custom data.
     */
    public $custom_data;

    /**
     * @var string
     */
    public $api_key;
}
