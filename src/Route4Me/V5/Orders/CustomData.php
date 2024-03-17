<?php

namespace Route4Me\V5\Orders;

use Route4Me\Common;

/**
 * The Order custom data structure
 *
 * @since 1.3.0
 *
 * @package Route4Me
 */
class CustomData extends Common
{
    /**
     * Tracking number for order.
     */
    public ?string $barcode = null;

    /**
     * Additional tracking number for order.
     */
    public ?string $airbillno = null;

    /**
     * Datetime String with "T" delimiter, ISO 8601.
     */
    public ?string $sorted_on_date = null;

    /**
     * Timestamp only; replaced data in`sorted_on_date` property.
     */
    public ?int $sorted_on_utc = null;

    public function __construct(array $params = null)
    {
        if ($params != null) {
            $this->fillFromArray($params);
        }
    }
}
