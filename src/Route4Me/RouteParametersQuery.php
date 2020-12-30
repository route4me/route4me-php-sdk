<?php

namespace Route4Me;

/**
 * Class RouteParametersQuery
 * @package Route4Me
 * Route parameters accepted by endpoints.
 */
class RouteParametersQuery extends Common
{
    /** @var string $route_id
     * Route Identifier
     */
    public $route_id;

    /** @var boolean $directions
     * Pass True to return directions and the route path.
     */
    public $directions;

    /** @var string $route_path_output
     * 'None' - no path output. 'Points' - points path output
     */
    public $route_path_output;

    /** @var boolean $device_tracking_history
     * Output route tracking data in response
     */
    public $device_tracking_history;

    /** @var integer $limit
     * The number of existing routes that should be returned per response
     * when looking at a list of all the routes.
     */
    public $limit;

    /** @var integer $offset
     * The page number for route listing pagination.
     * Increment the offset by the limit number to move to the next page.
     */
    public $offset;

    /** @var string $start_date
     * Start date to filter
     */
    public $start_date;

    /** @var string $end_date
     * End date to filter
     */
    public $end_date;

    /** @var boolean $original
     * Output addresses and directions in the original optimization request sequence.
     * This is to allow us to compare routes before & after optimization.
     */
    public $original;

    /** @var boolean $notes
     * Output route and stop-specific notes. The notes will have timestamps,
     * note types, and geospatial information if available.
     */
    public $notes;

    /** @var boolean $order_inventory
     * If true, the order inventory info included in the response.
     */
    public $order_inventory;

    /** @var boolean $remaining
     * If true, not visited destinations of an active route re-optimized (re-sequenced).
     */
    public $remaining;

    /** @var string $query
     * Search query
     */
    public $query;

    /** @var boolean $reoptimize
     * Updating a route supports the reoptimize=1 parameter,
     * which reoptimizes only that route.
     * Also supports the parameters from GET.
     */
    public $reoptimize;

    /** @var boolean $disable_optimization
     * Whether disable or not a route optimization.
     * Available values:
     * true - disable a route optimization. false - not disable a route optimization.
     */
    public $disable_optimization;

    /** @var boolean $optimize
     * The driving directions will be generated biased for this selection. This has no impact on route sequencing.
     * Available values:
     * 'Distance', 'Time', 'timeWithTraffic'.
     */
    public $optimize;

    /** @var boolean $recompute_directions
     * By sending recompute_directions=1 we request that the route directions
     * be recomputed (note that this does happen automatically if certain properties
     * of the route are updated, such as stop sequence_no changes or round-tripness)
     */
    public $recompute_directions;

    /** @var string $format
     * Response format('json', 'csv', 'xml')
     */
    public $response_format;

    /** @var integer $route_destination_id
     * Identifier of a route destination.
     */
    public $route_destination_id;

    /** @var boolean $redirect
     * If true, will be redirected
     */
    public $redirect;

    /** @var boolean $bundling_items
     * If true, the address bundling info is included into route response.
     */
    public $bundling_items;

    public static function fromArray(array $params)
    {
        $routeQueryParams = new self();
        foreach ($params as $key => $value) {
            if (property_exists($routeQueryParams, $key)) {
                $routeQueryParams->{$key} = $value;
            }
        }

        return $routeQueryParams;
    }

}