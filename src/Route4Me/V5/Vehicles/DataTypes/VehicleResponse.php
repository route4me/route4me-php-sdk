<?php

namespace Route4Me\V5\Vehicles\DataTypes;

use Route4Me\Common as Common;

/**
 * Class VehicleResponse.
 */
class VehicleResponse extends Common
{
    /** Vehicle data.
     * @var DataVehicle
     */
    public $data = [];

    public static function fromArray(array $params)
    {
        $vehResp = new self();

        foreach ($params as $key => $value) {
            if (is_null(Common::getValue($params, $key))) {
                continue;
            }
            if (property_exists($vehResp, $key)) {
                $vehResp->$key = $value;
            }
        }

        return $vehResp;
    }
}
