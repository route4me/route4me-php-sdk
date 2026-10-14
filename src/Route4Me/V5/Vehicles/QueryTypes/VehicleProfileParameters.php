<?php

namespace Route4Me\V5\Vehicles\QueryTypes;

use Route4Me\Common as Common;

/**
 * Class VehicleProfileParameters.
 */
class VehicleProfileParameters extends Common
{
    /** If true, returned vehicle profile is paginated.
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

    /** Vehicle profile ID.
     * @var int
     */
    public $id;
}
