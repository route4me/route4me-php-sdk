<?php


namespace Route4Me\V5\Routes\AddonRoutesApi;

/**
 * Class RouteFilterParameters
 * @package Route4Me\V5\Routes\AddonRoutesApi
 * Elastic search filter.
 */
class RouteFilterParameters extends \Route4Me\Common
{
    /**
     * @var string $query
     */
    public $query;

    /**
     * @var RouteFilterParametersFilters $filters
     */
    public $filters = [];

    /**
     * @var boolean $directions
     */
    public $directions;

    /**
     * @var boolean $notes
     */
    public $notes;

    /**
     * @var integer $page
     */
    public $page;

    /**
     * @var integer $per_page
     */
    public $per_page;

    /**
     * @var array $order_by
     */
    public $order_by = [];

    /**
     * @var string $timezone
     */
    public $timezone;
}