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
class ScheduleItem extends Common
{
    /**
     * If true, the schedule is enabled.
     */
    public ?bool $enable = null;

    /**
     * Schedule mode.
     * @example 'monthly'
     */
    public ?string $mode = null;

    /**
     * Monthly properties.
     * @example ['every' => 1]
     */
    public ?array $monthly = null;

    public function __construct(?array $params = null)
    {
        if ($params !== null) {
            $this->fillFromArray($params);
        }
    }
}
