<?php

namespace Route4Me\Tracking;

class SetGpsResponse extends \Route4Me\Common
{
    /** @var boolean  $status
     * Status of the GPS setting request process.
     */
    public $status;

    /** @var string $tx_id
     * Unique ID of the GPS points group.
     */
    public $tx_id;
}
