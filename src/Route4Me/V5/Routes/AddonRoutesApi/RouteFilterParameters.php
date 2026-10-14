<?php

namespace Route4Me\V5\Routes\AddonRoutesApi;

/**
 * Class RouteFilterParameters.
 */
class RouteFilterParameters extends \Route4Me\Common
{
    /**
     * @var string
     */
    public $query;

    /**
     * @var RouteFilterParametersFilters
     */
    public $filters = [];

    /**
     * @var bool
     */
    public $directions;

    /**
     * @var bool
     */
    public $notes;

    /**
     * @var int
     */
    public $page;

    /**
     * @var int
     */
    public $per_page;

    /**
     * @var array
     */
    public $order_by = [];

    /**
     * @var string
     */
    public $timezone;
}
