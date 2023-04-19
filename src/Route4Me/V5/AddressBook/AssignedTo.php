<?php

namespace Route4Me\V5\AddressBook;

use Route4Me\Common;

/**
 * Address Book API AddressBook structure
 *
 * @since 1.2.8
 *
 * @package Route4Me
 */
class AssignedTo extends Common
{
    /**
     * A member the address assigned to.
     * @example 2
     */
    public ?int $member_id = null;

    /**
     * Member first name.
     * @example 'John'
     */
    public ?string $member_first_name = null;

    /**
     * Member last name.
     * @example 'Doe'
     */
    public ?string $member_last_name = null;

    /**
     * Member email.
     */
    public ?string $member_email = null;

    /**
     * The assignment is valid until to.
     * @example '2019-12-23T09:31:38+00:00'
     */
    public ?string $until = null;

    public function __construct(?array $params = null)
    {
        if ($params !== null) {
            $this->fillFromArray($params);
        }
    }
}
