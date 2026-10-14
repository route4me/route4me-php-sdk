<?php

namespace Route4Me\V5\Addresses;

/**
 * Class Geocoding.
 */
class Geocoding extends \Route4Me\Common
{
    /** A unique identifier for the geocoding.
     * @var string
     */
    public $key;

    /** Specific description of the geocoding result.
     * @var string
     */
    public $name;

    /** Boundary box.
     * @var float[]
     */
    public $bbox = [];

    /** The latitude of the geocoded address.
     * @var float
     */
    public $lat;

    /** The longitude of the geocoded address.
     * @var float
     */
    public $lng;

    /** Confidance level in the address geocoding:
     * <para>high, medium, low</para>.
     * @var string
     */
    public $confidence;

    /** The postal code of the geocoded address.
     * @var string
     */
    public $postalCode;

    /** Country region.
     * @var string
     */
    public $countryRegion;

    /** The address curbside coordinates.
     * @var GeoPoint
     */
    public $curbside_coordinates = [];

    /** The address without number.
     * @var string
     */
    public $address_without_number;

    /** The place ID.
     * @var string
     */
    public $place_id;

}
