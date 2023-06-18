<?php

namespace Route4Me\V5\Vehicles\DataTypes;

class VehicleTrackItem extends \Route4Me\Common
{
    /** The vehicle ID
     * @var string $vehicle_id
     */
    public $vehicle_id;

    /** The member ID
     * @var integer $member_id
     */
    public $member_id;

    /** Latitude of a vehicle position.
     * @var float $lat
     */
    public $lat;

    /** Longitude of a vehicle position.
     * @var float $lng
     */
    public $lng;

    /** The geographic altitude
     * @var integer $altitude
     */
    public $altitude;

    /** Vehicle speed
     * @var integer $speed
     */
    public $speed;

    /** When a vehicle activity was detected.
     * @var integer $timestamp
     */
    public $timestamp;
}
