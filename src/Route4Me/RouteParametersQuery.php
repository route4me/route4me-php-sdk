<?php

namespace Route4Me;

/**
 * Class RouteParametersQuery
 * @package Route4Me
 * Route parameters accepted by endpoints.
 */
class RouteParametersQuery extends Common
{
    /**
     * Route unique identifier
     * @var string
     */
    public $route_id;

    /**
     * Pass True to return directions and the route path.
     * @var boolean
     */
    public $directions;

    /**
     * Available values:
     * - 'None' - no path output.
     * - 'Points' - points path output
     * @var string
     */
    public $route_path_output;

    /**
     * Output route tracking data in response.
     * @var boolean
     */
    public $device_tracking_history;

    /**
     * The number of existing routes that should be returned per response
     * when looking at a list of all the routes.
     * @var integer
     */
    public $limit;

    /**
     * The page number for route listing pagination.<br>
     * Increment the offset by the limit number to move to the next page.
     * @var integer
     */
    public $offset;

    /**
     * Start date to filter
     * @var string
     */
    public $start_date;

    /**
     * End date to filter
     * @var string
     */
    public $end_date;

    /**
     * Output addresses and directions in the original optimization request sequence.<br>
     * This is to allow us to compare routes before & after optimization.
     * @var boolean
     */
    public $original;

    /**
     * Output route and stop-specific notes. The notes will have timestamps,
     * note types, and geospatial information if available.
     * @var boolean
     */
    public $notes;

    /**
     * If true, the order inventory info included in the response.
     * @var boolean
     */
    public $order_inventory;

    /**
     * If true, not visited destinations of an active route re-optimized (re-sequenced).
     * @var boolean
     */
    public $remaining;

    /**
     * Search query
     * @var string
     */
    public $query;

    /**
     * Updating a route supports the reoptimize=1 parameter,
     * which reoptimizes only that route.<br>
     * Also supports the parameters from GET.
     * @var boolean
     */
    public $reoptimize;

    /**
     * Whether disable or not a route optimization.<br>
     * Available values:
     * - true - disable a route optimization;
     * - false - not disable a route optimization.
     * @var boolean
     */
    public $disable_optimization;

    /**
     * The driving directions will be generated biased for this selection.
     * This has no impact on route sequencing.<br>
     * Available values:
     * - 'Distance';
     * - 'Time';
     * - 'timeWithTraffic'.
     * @var boolean
     */
    public $optimize;

    /**
     * By sending recompute_directions=1 we request that the route directions
     * be recomputed (note that this does happen automatically if certain properties
     * of the route are updated, such as stop sequence_no changes or round-tripness)
     * @var boolean
     */
    public $recompute_directions;

    /**
     * Response format('json', 'csv', 'xml')
     * @var string
     */
    public $response_format;

    /**
     * Identifier of a route destination.
     * @var integer
     */
    public $route_destination_id;

    /**
     * If true, will be redirected
     * @var boolean
     */
    public $redirect;

    /**
     * If true, the address bundling info is included into route response.
     * @var boolean
     */
    public $bundling_items;

    public $device_type;
}
