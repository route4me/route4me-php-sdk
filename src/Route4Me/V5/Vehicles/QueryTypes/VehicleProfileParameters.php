<?php


namespace Route4Me\V5\Vehicles\QueryTypes;

use Route4Me\Common as Common;

/**
 * Class VehicleProfileParameters
 * @package Route4Me\V5\Vehicles\QueryTypes
 * Request parameters for the vehicle profiles.
 */
class VehicleProfileParameters extends Common
{
    /** If true, returned vehicle profile is paginated.
     * @var boolean $with_pagination
     */
    public $with_pagination;

    /** Current page number in the vehicles collection
     * @var integer $page
     */
    public $page;

    /** Returned vehicles number per page
     * @var integer $perPage
     */
    public $perPage;

    /** Vehicle profile ID
     * @var integer $id
     */
    public $id;
}