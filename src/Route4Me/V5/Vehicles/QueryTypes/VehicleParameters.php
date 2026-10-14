<?php

namespace Route4Me\V5\Vehicles\QueryTypes;

use Route4Me\Common as Common;

class VehicleParameters extends Common
{
    /** If true, returned vehicles array will be paginated.
     * @var bool
     */
    public $with_pagination;

    /** Current page number in the vehicles collection.
     * @var int
     */
    public $page;

    /** Returned vehicles number per page.
     * @var int
     */
    public $perPage;

    /** An array of the Vehicle IDs.
     * @var string[] = []
     */
    public $ids;

    /** Vehicle ID.
     * @var string
     */
    public $vehicle_id;

    /** Vehicle license plate.
     * @var string
     */
    public $vehicle_license_plate;

    public static function fromArray(array $params)
    {
        $vehParams = new self();

        foreach ($params as $key => $value) {
            if (is_null(Common::getValue($params, $key))) {
                continue;
            }
            if (property_exists($vehParams, $key)) {
                $vehParams->$key = $value;
            }
        }

        return $vehParams;
    }
}
