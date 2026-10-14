<?php

namespace Route4Me\V5\Routes\AddonRoutesApi;

use Route4Me\Common as Common;

/**
 * Class RouteParametersQuery.
 */
class RouteParametersQuery extends Common
{
    /** Route IDs concatenated with a comma.
     * @var string
     */
    public $route_id;

    /** Require Route directions in the results.
     * @var bool
     */
    public $directions;

    /** Path output style.
     * Available values:
     * - Points;
     * - Encoded;
     * - None.
     * @var string
     */
    public $route_path_output;

    /** Output route tracking data in response.
     * @var bool
     */
    public $device_tracking_history;

    /** Limit of the queried records number.
     * @var int
     */
    public $limit;

    /** Offset from the beginning of the queried records.
     * @var int
     */
    public $offset;

    /** Start timestamp of the date range.
     * @var int
     */
    public $start_date;

    /** End timestamp of the date range.
     * @var int
     */
    public $end_date;

    /** Output addresses and directions in the original optimization request sequence.
     * This is to allow us to compare routes before & after optimization.
     * @var bool
     */
    public $original;

    /** Require Route notes in the results.
     * @var bool
     */
    public $notes;

    /** Require Order Inventories in the results.
     * @var bool
     */
    public $order_inventory;

    /** If true, not visited destinations of an active route re-optimized (re-sequenced).
     * @var bool
     */
    public $remaining;

    /** Search the query for a Route.
     * @var string
     */
    public $query;

    /** Updating a route supports the reoptimize=1 parameter,
     * which reoptimizes only that route.
     * Also supports the parameters from GET.
     * @var bool
     */
    public $reoptimize;

    /** Whether disable or not a route optimization.
     * @var bool
     */
    public $disable_optimization;

    /** The driving directions will be generated biased for this selection. This has no impact on route sequencing.
     * <para>Available values: </para>
     * <value>'Distance', 'Time', 'timeWithTraffic'.</value>
     * <remarks><para>Query parameter.</para></remarks>.
     * @var string
     */
    public $optimize;

    /** By sending recompute_directions=1 we request that the route directions
     * be recomputed (note that this does happen automatically if certain properties
     * of the route are updated, such as stop sequence_no changes or round-tripness).
     * @var bool
     */
    public $recompute_directions;

    /** Response format('json', 'csv', 'xml').
     * @var string
     */
    public $response_format;

    /** Route destination ID.
     * @var int
     */
    public $route_destination_id;

    /**
     * @var bool
     */
    public $redirect;

    /** Require bundled Items in the results.
     * @var bool
     */
    public $bundling_items;

    /** Requested page.
     * @var int
     */
    public $page;

    /** Number of Routes per page.
     * @var int
     */
    public $per_page;

    public static function getAllProperties()
    {
        $routeQueryParams = new self();

        $fields = array_keys(get_object_vars($routeQueryParams));

        return $fields;
    }
}
