<?php


namespace Route4Me\V5\Vehicles\DataTypes;

use Route4Me\Common as Common;

/**
 * Class VehicleOrderResponse
 * @package Route4Me\V5\Vehicles\DataTypes
 * Response from execution of a vehicle order.
 */
class VehicleOrderResponse extends Common
{
    /** Vehicle ID
     * @var string $vehicle_id
     */
    public $vehicle_id;

    /** Order ID
     * @var integer $order_id
     */
    public $order_id;

    public static function fromArray(array $params)
    {
        $ordParams = new self();

        foreach ($params as $key => $value) {
            if (is_null(Common::getValue($params, $key))) continue;
            if (property_exists($ordParams, $key)) {
                $ordParams->$key = $value;
            }
        }

        return $ordParams;
    }
}