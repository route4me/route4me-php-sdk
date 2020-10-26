<?php

namespace Route4Me;

use Route4Me\Enum\AddressBundlingModes;

class AddressBundling extends Common
{
    public $mode = AddressBundlingModes\Mode::ADDRESS;
    public $mode_params= [];
    public $merge_mode = AddressBundlingModes\MergeMode::KEEP_AS_SEPARATE_DESTINATIONS;
    public $service_time_rules;

    public function __construct()
    {
        $this->service_time_rules = new ServiceTimeRulesClass();
    }

}
