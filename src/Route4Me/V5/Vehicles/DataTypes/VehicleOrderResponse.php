<?php

namespace Route4Me\V5\Vehicles\DataTypes;

use Route4Me\Common as Common;

/**
 * Class VehicleOrderResponse.
 */
class VehicleOrderResponse extends Common
{
    /** Vehicle ID.
     * @var string
     */
    public $vehicle_id;

    /** Order ID.
     * @var int
     */
    public $order_id;

    public static function fromArray(array $params)
    {
        $ordParams = new self();

        foreach ($params as $key => $value) {
            if (is_null(Common::getValue($params, $key))) {
                continue;
            }
            if (property_exists($ordParams, $key)) {
                $ordParams->$key = $value;
            }
        }

        return $ordParams;
    }
}
