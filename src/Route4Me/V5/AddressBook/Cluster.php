<?php

namespace Route4Me\V5\AddressBook;

use Route4Me\Common;

/**
 * Address Book API Cluster structure
 *
 * @since 1.2.8
 *
 * @package Route4Me
 */
class Cluster extends Common
{
    /**
     * Geohash
     * @example 1mr8h4r9
     */
    public ?string $geohash = null;

    /**
     * Latitude
     * @example -60.456132888793945
     */
    public ?float $lat = null;

    /**
     * Longitude
     * @example -60.456132888793945
     */
    public ?float $lng = null;

    /**
     * Boundary box, array of pairs of floats.
     * @var float[][]
     * @example [[52.294921875, 5.2294921875], [52.3388671875, 5.2734375]]
     */
    public ?array $bbox = null;

    public function __construct(?array $params = null)
    {
        if ($params !== null) {
            $this->fillFromArray($params);
        }
    }
}
