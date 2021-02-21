<?php


namespace Route4Me\V5\Vehicles\DataTypes;

use Route4Me\Common as Common;

/**
 * Class VehicleLocationResponse
 * @package Route4Me\V5\Vehicles
 * Response from the endpoint /vehicles/location
 */
class VehicleLocationResponse extends \Route4Me\Common
{
    /** An array of the vehicle locations
     * @var VehicleLocationItem $data
     */
    public $data = [];

    public static function fromArray(array $params)
    {
        $locParams = new self();

        foreach ($params as $key => $value) {
            if (is_null(Common::getValue($params, $key))) continue;
            if (property_exists($locParams, $key)) {
                $locParams->$key = $value;
            }
        }

        return $locParams;
    }
}
