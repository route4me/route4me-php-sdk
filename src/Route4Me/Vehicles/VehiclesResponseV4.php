<?php

namespace Route4Me\Vehicles;

use Route4Me\Common;
use Route4Me\Enum\Endpoint;

/**
 * Class VehiclesResponseV4.
 */
class VehiclesResponseV4 extends Common
{
    /** @var int
     * Current page number in the driver reviews collection.
     */
    public $current_page;

    /** @var VehicleV4[]
     * An array of the vehicles data.
     */
    public $data = [];

    /** @var string
     * URL to the first page.
     */
    public $first_page_url;

    /** @var int
     * From which vehicle is starting the page.
     */
    public $from;

    /** @var int
     * Last page number in the vehicles collection.
     */
    public $last_page;

    /** @var string
     * URL to the last page.
     */
    public $last_page_url;

    /** @var string
     * URL to the next page.
     */
    public $next_page_url;

    /** @var string
     * Path to the API endpoint.
     */
    public $path;

    /** @var int
     * Vehicles number per page.
     */
    public $per_page;

    /** @var string
     * URL to the previous page.
     */
    public $prev_page_url;

    /** @var int
     * To which vehicle is ending the page.
     */
    public $to;

    /** @var int
     * Total number of the vehicles.
     */
    public $total;

    public function __construct()
    {
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
