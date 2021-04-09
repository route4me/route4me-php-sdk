<?php

namespace Route4Me;

use Route4Me\Enum\AddressBundlingModes;

/**
 * Class for the address bundling query.
 */
class AddressBundling extends Common
{
    /**
     * Address bundling mode
     */
    public $mode = AddressBundlingModes\Mode::ADDRESS;

    /**
     * Address bundling mode parameters:
     * - If Mode=3, contains an array of the field names of the Address object;
     * - If Mode=4, contains an array of the custom fields of the Address object.
     */
    public $mode_params= [];

    /**
     * Address bundling merge mode
     */
    public $merge_mode = AddressBundlingModes\MergeMode::KEEP_AS_SEPARATE_DESTINATIONS;

    /**
     * Service time rules of the address bundling
     */
    public $service_time_rules;

    public function __construct()
    {
        $this->service_time_rules = new ServiceTimeRulesClass();
    }

}
