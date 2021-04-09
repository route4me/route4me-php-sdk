<?php


namespace Route4Me\V5\Addresses;

use Route4Me\Common as Common;

/**
 * Class for the address bundling query
 * @package Route4Me\V5\Addresses
 */
class AddressBundling extends Common
{
    /**
     * Address bundling mode
     * @see Enum\AddressBundlingModes\Mode
     * @var integer
     */
    public $mode;

    /**
     * Address bundling mode parameters:
     * - If Mode=3, contains an array of the field names of the Address object;
     * - If Mode=4, contains an array of the custom fields of the Address object.
     * @var string[]
     */
    public $mode_params;

    /**
     * Address bundling merge mode
     * @see Enum\AddressBundlingModes\MergeMode
     * @var integer
     */
    public $merge_mode;

    /**
     * Service time rules of the address bundling
     * @var ServiceTimeRulesClass
     */
    public $service_time_rules;
}