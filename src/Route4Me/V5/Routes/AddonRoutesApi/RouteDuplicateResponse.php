<?php

namespace Route4Me\V5\Routes\AddonRoutesApi;

/**
 * Class RouteDuplicateResponse.
 */
class RouteDuplicateResponse extends \Route4Me\Common
{
    /** If true, the route duplicated successfully.
     * @var bool
     */
    public $status;

    /** If true, the route duplication process was asynchronous.
     * @var bool
     */
    public $async;

    /** An array of the duplicated route IDs.
     * @var string[]
     */
    public $route_ids = [];
}
