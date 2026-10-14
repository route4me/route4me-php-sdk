<?php

namespace Route4Me;

use Route4Me\Enum\AddressBundlingModes;

/**
 * Class for the address bundling service time rules.
 */
class ServiceTimeRulesClass
{
    /**
     * Mode of a first item of the bundled addresses.
     * @var int
     * @see AddressBundlingModes\FirstItemMode
     */
    public $first_item_mode = AddressBundlingModes\FirstItemMode::KEEP_ORIGINAL;

    /**
     * First item mode parameters.<br>
     * If FirstItemMode=CustomTime, contains custom service time in seconds.
     * @var int[]
     */
    public $first_item_mode_params = [];

    /**
     * Mode of the non-first items of the bundled addresses.
     * @var int
     * @see AddressBundlingModes\AdditionalItemsMode
     */
    public $additional_items_mode = AddressBundlingModes\AdditionalItemsMode::KEEP_ORIGINAL;

    /**
     * Additional items mode parameters:<br>
     * if AdditionalItemsMode=AddressBundlingAdditionalItemsMode.CustomTime,
     * contains an array of the custom service times.
     * @var int[]
     */
    public $additional_items_mode_params = [];
}
