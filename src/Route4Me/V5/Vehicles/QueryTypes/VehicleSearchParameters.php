<?php

namespace Route4Me\V5\Vehicles\QueryTypes;

use Route4Me\Common as Common;

/**
 * Class VehicleSearchParameters.
 */
class VehicleSearchParameters extends Common
{
    /** An array of the vehicle IDs.
     * @var string[]
     */
    public $vehicle_ids = [];

    /** Latitude of a vehicle position.
     * @var float
     */
    public $lat;

    /** Longitude of a vehicle position.
     * @var float
     */
    public $lng;
}
