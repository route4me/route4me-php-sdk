<?php

namespace Route4Me;

use Route4Me\Route4Me;

/*
 * The data structure of the geocoding process response.
 */
class GeocodingResponse extends Common
{
    /*
     * A geocoded address
     */
    public $address;

    /*
     * Latitude
     */
    public $lat;

    /*
     * Longitude
     */
    public $lng;

    /*
     * Geocoded area level type
     */
    public $type;

    /*
     * Confidence ("high", "medium", "low")
     */
    public $confidence;

    /*
     * Content of the original string (an address or geopoint) sent by HTTP
     */
    public $original;

    public static function fromArray(array $params)
    {
        $geocodingResponse = new self();

        foreach ($params as $key => $value) {
            if (property_exists($geocodingResponse, $key)) {
                $geocodingResponse->{$key} = $value;
            }
        }

        return $geocodingResponse;
    }
}