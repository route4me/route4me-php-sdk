<?php

namespace Route4Me\V5\Vehicles\QueryTypes;

use Route4Me\Common as Common;

/**
 * Class VehicleOrderParameters.
 */
class VehicleOrderParameters extends Common
{
    /** The vehicle ID.
     * @var string
     */
    public $vehicle_id;

    /** Latitude of a vehicle position.
     * @var float
     */
    public $lat;

    /** Longitude of a vehicle position.
     * @var float
     */
    public $lng;

    public static function fromArray(array $params)
    {
        $orderParams = new self();

        foreach ($params as $key => $value) {
            if (is_null(Common::getValue($params, $key))) {
                continue;
            }
            if (property_exists($orderParams, $key)) {
                $orderParams->$key = $value;
            }
        }

        return $orderParams;
    }
}
