<?php

namespace Route4Me\V5\Vehicles\DataTypes;

use Route4Me\Common as Common;

/**
 * Class VehicleProfilesResponse.
 */
class VehicleProfilesResponse extends Common
{
    /** Current page of the paginated vehicle profiles list.
     * @var int
     */
    public $current_page;

    /** An array of the vehicle profiles.
     * @var VehileProfile[]
     */
    public $data = [];

    /** URL to the first page of the paginated vehicle profiles list.
     * @var string
     */
    public $first_page_url;

    /** From which vehicle profile is starting the page.
     * @var int
     */
    public $from;

    /** Last page.
     * @var int
     */
    public $last_page;

    /** URL to the last page of the paginated vehicle profiles list.
     * @var string
     */
    public $last_page_url;

    /** URL to the next page of the paginated vehicle profiles list.
     * @var string
     */
    public $next_page_url;

    /** Path to the API endpoint.
     * @var string
     */
    public $path;

    /** Vehicles number per page.
     * @var int
     */
    public $per_page;

    /** URL to the previous page.
     * @var string
     */
    public $prev_page_url;

    /** To which vehicle profile is ending the page.
     * @var int
     */
    public $to;

    /** Total number of the vehicles.
     * @var int
     */
    public $total;

    public static function fromArray(array $params)
    {
        $profResp = new self();

        foreach ($params as $key => $value) {
            if (is_null(Common::getValue($params, $key))) {
                continue;
            }
            if (property_exists($profResp, $key)) {
                $profResp->$key = $value;
            }
        }

        return $profResp;
    }
}
