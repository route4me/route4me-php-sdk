<?php

namespace Route4Me\Vehicles;

use Route4Me\Common;
use Route4Me\Enum\Endpoint;
use Route4Me\Route4Me;

/**
 * Class VehiclesResponseV4
 * @package Route4Me\Vehicles
 * Paginated response from the vehicle request.
 */
class VehiclesResponseV4 extends \Route4Me\Common
{
    /** @var int $current_page
     * Current page number in the driver reviews collection.
     */
    public $current_page;

    /** @var VehicleV4[] $data
     * An array of the vehicles data.
     */
    public $data = [];

    /** @var string $first_page_url
     * URL to the first page.
     */
    public $first_page_url;

    /** @var int $from
     * From which vehicle is starting the page.
     */
    public $from;

    /** @var int $last_page
     * Last page number in the vehicles collection.
     */
    public $last_page;

    /** @var string $last_page_url
     * URL to the last page.
     */
    public $last_page_url;

    /** @var string $next_page_url
     * URL to the next page.
     */
    public $next_page_url;

    /** @var string $path
     * Path to the API endpoint.
     */
    public $path;

    /** @var int $per_page
     * Vehicles number per page.
     */
    public $per_page;

    /** @var string $prev_page_url
     * URL to the previous page.
     */
    public $prev_page_url;

    /** @var int $to
     * To which vehicle is ending the page.
     */
    public $to;

    /** @var int $total
     * Total number of the vehicles.
     */
    public $total;

    public function __construct()
    {
        Route4Me::setBaseUrl(Endpoint::WH_BASE_URL);
    }

    public static function fromArray(array $params)
    {
        $vehiclesResponse = new self();

        foreach ($params as $key => $value) {
            if (is_null(Common::getValue($params, $key))) continue;
            if (property_exists($vehiclesResponse, $key)) {
                $vehiclesResponse->$key = $value;
            }
        }

        return $vehiclesResponse;
    }
}