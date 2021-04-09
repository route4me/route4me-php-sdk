<?php


namespace Route4Me;

use Route4Me\Common as Common;

/**
 * Class GeoPoint (geographic point).
 * @package Route4Me
 */
class GeoPoint extends Common
{
    /**
     * Latitude
     * @var double
     */
    public $lat;

    /**
     * Longitude
     * @var double
     */
    public $lng;

    public static function fromArray(array $params)
    {
        $thisParams = new self();

        foreach ($params as $key => $value) {
            if (property_exists($thisParams, $key)) {
                $thisParams->{$key} = $value;
            }
        }

        return $thisParams;
    }
}