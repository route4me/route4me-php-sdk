<?php


namespace Route4Me\V5\Routes\AddonRoutesApi;

use Route4Me\Common as Common;

/**
 * Class RouteParametersQuery
 * @package Route4Me\V5\Routes\AddonRoutesApi
 * Route query parameters
 */
class RouteParametersQuery extends Common
{
    /** Route IDs concatenated with a comma
     * @var string $route_id
     */
    public $route_id;

    /** Require Route directions in the results.
     * @var boolean $directions
     */
    public $directions;

    /** Path output style.
     * Available values:
     * - Points;
     * - Encoded;
     * - None.
     * @var string $route_path_output
     */
    public $route_path_output;

    /** Output route tracking data in response
     * @var boolean $device_tracking_history
     */
    public $device_tracking_history;

    /** Limit of the queried records number.
     * @var integer $limit
     */
    public $limit;

    /** Offset from the beginning of the queried records.
     * @var integer $offset
     */
    public $offset;

    /** Start timestamp of the date range
     * @var integer $start_date
     */
    public $start_date;

    /** End timestamp of the date range.
     * @var integer $end_date
     */
    public $end_date;

    /** Output addresses and directions in the original optimization request sequence.
     * This is to allow us to compare routes before & after optimization.
     * @var boolean $original
     */
    public $original;

    /** Require Route notes in the results.
     * @var boolean $notes
     */
    public $notes;

    /** Require Order Inventories in the results.
     * @var boolean $order_inventory
     */
    public $order_inventory;

    /** If true, not visited destinations of an active route re-optimized (re-sequenced).
     * @var boolean $remaining
     */
    public $remaining;

    /** Search the query for a Route
     * @var string $query
     */
    public $query;

    /** Updating a route supports the reoptimize=1 parameter,
     * which reoptimizes only that route.
     * Also supports the parameters from GET.
     * @var boolean $reoptimize
     */
    public $reoptimize;

    /** Whether disable or not a route optimization.
     * @var boolean $disable_optimization
     */
    public $disable_optimization;

    /** The driving directions will be generated biased for this selection. This has no impact on route sequencing.
     * <para>Available values: </para>
     * <value>'Distance', 'Time', 'timeWithTraffic'.</value>
     * <remarks><para>Query parameter.</para></remarks>
     * @var string $optimize
     */
    public $optimize;

    /** By sending recompute_directions=1 we request that the route directions
     * be recomputed (note that this does happen automatically if certain properties
     * of the route are updated, such as stop sequence_no changes or round-tripness)
     * @var boolean $recompute_directions
     */
    public $recompute_directions;

    /** Response format('json', 'csv', 'xml')
     * @var string $response_format
     */
    public $response_format;

    /** Route destination ID
     * @var integer $route_destination_id
     */
    public $route_destination_id;

    /**
     * @var boolean $redirect
     */
    public $redirect;

    /** Require bundled Items in the results.
     * @var boolean $bundling_items
     */
    public $bundling_items;

    /** Requested page.
     * @var integer $page
     */
    public $page;

    /** Number of Routes per page.
     * @var integer $per_page
     */
    public $per_page;

    public static function getAllProperties()
    {
        $routeQueryParams = new self();

        $fields = array_keys(get_object_vars($routeQueryParams));

        return $fields;
    }
}
