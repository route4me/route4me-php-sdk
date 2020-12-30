<?php


namespace Route4Me\Tracking;


class MemberData extends \Route4Me\Common
{
    /** @var int $account_type_id */
    public $account_type_id;

    /** @var string $member_email */
    public $member_email;

    /** @var string $member_first_name */
    public $member_first_name;

    /** @var int $member_id */
    public $member_id;

    /** @var string $member_last_name */
    public $member_last_name;

    /** @var string $member_type */
    public $member_type;

    /** @var string $phone_number */
    public $phone_number;

    /** @var boolean $readonly_user */
    public $readonly_user;

    /** @var boolean $show_superuser_addresses */
    public $show_superuser_addresses;

    public static function fromArray(array $params)
    {
        $memberData = new self();

        foreach ($params as $key => $value) {
            if (property_exists($memberData, $key)) {
                $memberData->{$key} = $value;
            }
        }

        return $memberData;
    }
}