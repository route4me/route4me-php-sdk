<?php

namespace Route4Me\V5\Routes\AddonRoutesApi;

/**
 * Class RoutesDeleteResponse.
 */
class RoutesDeleteResponse extends \Route4Me\Common
{
    /** If true, the route duplicated successfully.
     * @var bool
     */
    public $deleted;

    /** If true, the route duplication process was asynchronous.
     * @var bool
     */
    public $async;

    /** Route ID.
     * @var string
     */
    public $route_id;

    /** An array of the duplicated route IDs.
     * @var string[]
     */
    public $route_ids;
}
