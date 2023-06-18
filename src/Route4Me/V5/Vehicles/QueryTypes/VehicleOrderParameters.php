<?php

namespace Route4Me\V5\Vehicles\QueryTypes;

use Route4Me\Common as Common;

/**
 * Class VehicleOrderParameters
 * @package Route4Me\V5\Vehicles\QueryTypes
 * Parameters for execution of a vehicle order.
 */
class VehicleOrderParameters extends Common
{
    /** The vehicle ID
     * @var string $vehicle_id
     */
    public $vehicle_id;

    /** Latitude of a vehicle position.
     * @var float $lat
     */
    public $lat;

    /** Longitude of a vehicle position.
     * @var float $lng
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
