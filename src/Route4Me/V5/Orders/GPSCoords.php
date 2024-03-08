<?php

namespace Route4Me\V5\Orders;

use Route4Me\Common;

/**
 * The GPS coords structure
 *
 * @since 1.3.0
 *
 * @package Route4Me
 */
class GPSCoords extends Common
{
    /**
     * Latitude.
     */
    public ?float $lat = null;

    /**
     * Longitude.
     */
    public ?float $lng = null;

    public function __construct($params_or_lat = null, float $lng = null)
    {
        if (is_array($params_or_lat)) {
            $this->fillFromArray($params_or_lat);
        } elseif (is_float($params_or_lat)) {
            $this->lat = $params_or_lat;
            $this->lng = $lng;
        }
    }
}
