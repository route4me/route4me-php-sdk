<?php


namespace Route4Me\V5\Addresses;

use Route4Me\Common as Common;

/**
 * Class for the address bundling service time rules
 * @package Route4Me\V5\Addresses
 */
class ServiceTimeRulesClass extends Common
{
    /**
     * Mode of a first item of the bundled addresses.
     * @see Enum\AddressBundlingModes\FirstItemMode
     * @var integer
     */
    public $first_item_mode;

    /**
     * First item mode parameters.<br>
     * If FirstItemMode=CustomTime, contains custom service time in seconds.
     * @var integer[]
     */
    public $first_item_mode_params;

    /**
     * Mode of the non-first items of the bundled addresses.
     * @see Enum\AddressBundlingModes\AddtionalItemsMode
     * @var integer
     */
    public $additional_items_mode;

    /**
     * Additional items mode parameters:<br>
     * if AdditionalItemsMode=CustomTime, contains an array of the custom service times
     * @var integer[]
     */
    public $additional_items_mode_params;
}