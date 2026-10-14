<?php

namespace Route4Me\V5\Vehicles\DataTypes;

class VehicleTrackItem extends \Route4Me\Common
{
    /** The vehicle ID.
     * @var string
     */
    public $vehicle_id;

    /** The member ID.
     * @var int
     */
    public $member_id;

    /** Latitude of a vehicle position.
     * @var float
     */
    public $lat;

    /** Longitude of a vehicle position.
     * @var float
     */
    public $lng;

    /** The geographic altitude.
     * @var int
     */
    public $altitude;

    /** Vehicle speed.
     * @var int
     */
    public $speed;

    /** When a vehicle activity was detected.
     * @var int
     */
    public $timestamp;
}
