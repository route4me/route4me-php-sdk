<?php

namespace Route4Me\V5\Vehicles\DataTypes;

use Route4Me\Common as Common;

/**
 * Class VehicleTrackResponse.
 */
class VehicleTrackResponse extends Common
{
    /** An array of the vehicle locations.
     * @var VehicleTrackItem[]
     */
    public $data = [];

    public static function fromArray(array $params)
    {
        $vehicleTrack = new self();

        foreach ($params as $key => $value) {
            if (is_null(Common::getValue($params, $key))) {
                continue;
            }
            if (property_exists($vehicleTrack, $key)) {
                $vehicleTrack->$key = $value;
            }
        }

        return $vehicleTrack;
    }
}
