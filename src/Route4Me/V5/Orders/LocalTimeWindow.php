<?php

namespace Route4Me\V5\Orders;

use Route4Me\Common;

/**
 * The Local time window structure
 *
 * @since 1.3.0
 *
 * @package Route4Me
 */
class LocalTimeWindow extends Common
{
    /**
     * Start time, unix timestamp.
     */
    public ?int $start = null;

    /**
     * End time, unix timestamp.
     */
    public ?int $end = null;

    public function __construct($params_or_start = null, int $end = null)
    {
        if (is_array($params_or_start)) {
            $this->fillFromArray($params_or_start);
        } elseif (is_int($params_or_start)) {
            $this->start = $params_or_start;
            $this->end = $end;
        }
    }
}
