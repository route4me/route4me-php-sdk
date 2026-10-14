<?php

namespace Route4Me;

/**
 * The data structure of the geocoding process response.
 */
class GeocodingResponse extends Common
{
    /**
     * A geocoded address.
     * @var string
     */
    public $address;

    /**
     * Latitude.
     * @var float
     */
    public $lat;

    /**
     * Longitude.
     * @var float
     */
    public $lng;

    /**
     * Geocoded area level type.
     * @var string
     */
    public $type;

    /**
     * Confidence ("high", "medium", "low").
     * @var string
     */
    public $confidence;

    /**
     * Content of the original string (an address or geopoint) sent by HTTP.
     * @var Route
     */
    public $original;
}
