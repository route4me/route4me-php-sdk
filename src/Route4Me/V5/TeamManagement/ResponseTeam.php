<?php

namespace Route4Me\V5\TeamManagement;

use Route4Me\Common as Common;
use Route4Me\V5\TeamManagement\Permission;

/**
 * Team Management API ResponseTeam structure
 *
 * @since 1.2.7
 *
 * @package Route4Me
 */
class ResponseTeam extends Common
{
    /**
     * The member ID
     */
    public ?int $member_id = null;

    /**
     * The user's account owner ID
     */
    public ?int $OWNER_MEMBER_ID = null;

    /**
     * User's first name
     */
    public ?string $member_first_name = null;

    /**
     * User's last name
     */
    public ?string $member_last_name = null;

    /**
     * User's email
     */
    public ?string $member_email = null;

    /**
     * User's image
     * @example '/uploads/cc6aba1a0e68ea429c51e3f9cb12e1ac/profile_c96135b77f6fc42be64cd98e0c21d341.jpg'
     */
    public ?string $member_picture = null;

    /**
     * Member type.
     * Available values: 'PRIMARY_ACCOUNT', 'SUB_ACCOUNT_ADMIN', 'SUB_ACCOUNT_REGIONAL_MANAGER',
     *   'SUB_ACCOUNT_DISPATCHER', 'SUB_ACCOUNT_PLANNER', "SUB_ACCOUNT_DRIVER'
     * @example 'SUB_ACCOUNT_DISPATCHER'
     */
    public ?string $member_type = null;

    /**
     * If true, the routed addresses will be hidden.
     */
    public ?bool $HIDE_ROUTED_ADDRESSES = null;

    /**
     * If true, the visited addresses will be hidden.
     */
    public ?bool $HIDE_VISITED_ADDRESSES = null;

    /**
     * If true, the nonfuture routes will be hidden.
     */
    public ?bool $HIDE_NONFUTURE_ROUTES = null;

    /**
     * If true, the user has read-only access type.
     */
    public ?bool $READONLY_USER = null;

    /**
     * If true, the global address book contacts are visible in a user account.
     */
    public ?bool $SHOW_SUSR_ADDR = null;

    /**
     * If true, the global orders are visible in a user account.
     */
    public ?bool $SHOW_SUSR_ORDERS = null;

    /**
     * If true, all drivers are visible to the user.
     */
    public ?bool $SHOW_ALL_DRIVERS = null;

    /**
     * If true, all vehicles are visible to the user.
     */
    public ?bool $SHOW_ALL_VEHICLES = null;

    /**
     * Allowed sub-member types in the user's account.
     * String array, available types: 'SUB_ACCOUNT_DRIVER', 'SUB_ACCOUNT_DISPATCHER',
     *   'SUB_ACCOUNT_PLANNER', 'SUB_ACCOUNT_ANALYST', 'SUB_ACCOUNT_ADMIN', 'SUB_ACCOUNT_REGIONAL_MANAGER'
     */
    public ?array $allowed_submember_types = null;

    /**
     * If true, the user can edit the account data.
     */
    public ?bool $can_edit = null;

    /**
     * If true, the user can delete the account data.
     */
    public ?bool $can_delete = null;

    /**
     * The user's custom data.
     * @example ['custom_data_key' => 'custom_data_value']
     */
    public ?array $custom_data = null;

    /**
     * Optimization profile ID
     * @example '18a6e1c5-0a02-4c58-a2d3-5c842ab550be'
     */
    public ?string $optimization_profile_id = null;

    /**
     * Member type title
     */
    public ?string $member_type_title = null;

    /**
     * User's permissions
     */
    public ?array $permissions = null;

    public function __construct(?array $params = null)
    {
        if ($params !== null) {
            foreach ($this as $key => $value) {
                if (isset($params[$key])) {
                    if ($key === 'permissions') {
                        $this->{$key} = array();
                        foreach ($params[$key] as $perm_key => $perm_value) {
                            array_push($this->{$key}, new Permission($perm_value));
                        }
                    } else {
                        $this->{$key} = $params[$key];
                    }
                }
            }
        }
    }
}
