<?php

namespace Route4Me\Enum\AddressBundlingModes;

/*
 * Enumeration of the destinations merge mode:
 * KEEP_AS_SEPARATE_DESTINATIONS = 1, keep separate destinations in output (default);
 * MERGE_INTO_SINGLE_DESTINATION = 2, merge the bundled destinations in one destination in output.
 */
class MergeMode
{
    const  KEEP_AS_SEPARATE_DESTINATIONS = 1;
    const  MERGE_INTO_SINGLE_DESTINATION = 2;
}
