<?php

namespace Route4Me\V5\Vehicles\DataTypes;

use Route4Me\Common as Common;

/**
 * Class VehicleTemporary.
 */
class VehicleTemporary extends Common
{
    /** The vehicle ID.
     * @var int
     */
    public $vehicle_id;

    /** A license plate of the vehicle.
     * @var string
     */
    public $vehicle_license_plate;

    /** Member ID assigned to the temporary vehicle.
     * @var string
     */
    public $assigned_member_id;

    /** An expiration date of the temporary vehicle.
     * @var string
     */
    public $expires_at;

    /** If true, an assignment forced.
     * @var bool
     */
    public $force_assignment;

    public static function fromArray(array $params)
    {
        $vehicleTemp = new self();

        foreach ($params as $key => $value) {
            if (is_null(Common::getValue($params, $key))) {
                continue;
            }
            if (property_exists($vehicleTemp, $key)) {
                $vehicleTemp->$key = $value;
            }
        }

        return $vehicleTemp;
    }
}
