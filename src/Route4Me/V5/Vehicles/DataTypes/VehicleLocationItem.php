<?php


namespace Route4Me\V5\Vehicles\DataTypes;

/**
 * Class VehicleLocationItem
 * @package Route4Me\V5\Vehicles
 * Vehicle location data structure.
 */
class VehicleLocationItem extends \Route4Me\Common
{
    /** The vehicle ID
     * @var string $vehicle_id
     */
    public $vehicle_id;

    /** When a vehicle activity was detected.
     * @var integer $activity_timestamp
     */
    public $activity_timestamp;

    /** Latitude of a vehicle position.
     * @var float $lat
     */
    public $lat;

    /** Longitude of a vehicle position
     * @var float $lng
     */
    public $lng;

}