<?php


namespace Route4Me\V5\Vehicles\QueryTypes;

use Route4Me\Common as Common;

/**
 * Class VehicleSearchParameters
 * @package Route4Me\V5\Vehicles\QueryTypes
 * Vehicle search parameters.
 */
class VehicleSearchParameters extends \Route4Me\Common
{
    /** An array of the vehicle IDs.
     * @var string[] $vehicle_ids
     */
    public $vehicle_ids = [];

    /** Latitude of a vehicle position.
     * @var float $lat
     */
    public $lat;

    /** Longitude of a vehicle position.
     * @var float $lng
     */
    public $lng;
}