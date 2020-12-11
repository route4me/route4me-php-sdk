<?php

namespace Route4Me\Enum\AddressBundlingModes;

/*
 * Enumeration of the address bundling mode:
 * ADDRESS = 1, group locations by address (default);
 * COORDINATES = 2, group locations by coordinates;
 * ADDRESS_ID = 3, group locations by list of the address IDs;
 * ADDRESS_CUSTOM_FIELD = 4, group locations by address custom fields.
 */
class Mode
{
    const ADDRESS = 1;
    const COORDINATES = 2;
    const ADDRESS_ID = 3;
    const ADDRESS_CUSTOM_FIELD = 4;
}
