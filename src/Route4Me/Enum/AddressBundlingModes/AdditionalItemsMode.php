<?php

namespace Route4Me\Enum\AddressBundlingModes;

class AdditionalItemsMode
{
    /*
     * Enumeration of the service time additional items mode:
     * KEEP_ORIGINAL = 1, preserve original address service time (default);
     * CUSTOM_TIME = 2, set custom times;
     * INHERIT_FROM_PRIMARY = 3, don't add service times.
     */
    const KEEP_ORIGINAL = 1;
    const CUSTOM_TIME = 2;
    const INHERIT_FROM_PRIMARY = 3;
}