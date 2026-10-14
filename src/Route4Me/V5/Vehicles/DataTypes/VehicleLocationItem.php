<?php

namespace Route4Me\V5\Vehicles\DataTypes;

/**
 * Class VehicleLocationItem.
 */
class VehicleLocationItem extends \Route4Me\Common
{
    /** The vehicle ID.
     * @var string
     */
    public $vehicle_id;

    /** When a vehicle activity was detected.
     * @var int
     */
    public $activity_timestamp;

    /** Latitude of a vehicle position.
     * @var float
     */
    public $lat;

    /** Longitude of a vehicle position.
     * @var float
     */
    public $lng;
}
