<?php

namespace Route4Me\V5\Addresses;

/**
 * Class Geocoding
 * @package Route4Me\V5\Address
 * Subcalss of the Address class. See <see cref="Address.Geocodings"/>
 */
class Geocoding extends \Route4Me\Common
{
    /** A unique identifier for the geocoding
     * @var string $key
     */
    public $key;

    /** Specific description of the geocoding result
     * @var string $name
     */
    public $name;

    /** Boundary box
     * @var double[] $bbox
     */
    public $bbox = [];

    /** The latitude of the geocoded address
     * @var double $lat
     */
    public $lat;

    /** The longitude of the geocoded address
     * @var double $lng
     */
    public $lng;

    /** Confidance level in the address geocoding:
     * <para>high, medium, low</para>
     * @var string $confidence
     */
    public $confidence;

    /** The postal code of the geocoded address
     * @var string $postalCode
     */
    public $postalCode;

    /** Country region
     * @var string $countryRegion
     */
    public $countryRegion;

    /** The address curbside coordinates
     * @var GeoPoint $curbside_coordinates
     */
    public $curbside_coordinates = [];

    /** The address without number
     * @var string $address_without_number
     */
    public $address_without_number;

    /** The place ID
     * @var string $place_id
     */
    public $place_id;

}