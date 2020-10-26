<?php

namespace Route4Me;

use Route4Me\Enum\AddressBundlingModes;

class ServiceTimeRulesClass
{
    public $first_item_mode = AddressBundlingModes\FirstItemMode::KEEP_ORIGINAL;
    public $first_item_mode_params = [];
    public $additional_items_mode = AddressBundlingModes\AdditionalItemsMode::KEEP_ORIGINAL;
    public $additional_items_mode_params = [];
}
