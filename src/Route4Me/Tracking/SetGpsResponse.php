<?php

namespace Route4Me\Tracking;

class SetGpsResponse extends \Route4Me\Common
{
    /** @var bool
     * Status of the GPS setting request process.
     */
    public $status;

    /** @var string
     * Unique ID of the GPS points group.
     */
    public $tx_id;
}
