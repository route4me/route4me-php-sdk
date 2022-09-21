<?php


namespace Route4Me\V5\Vehicles\DataTypes;

use Route4Me\Common as Common;

/**
 * Class VehicleProfilesResponse
 * @package Route4Me\V5\Vehicles
 * Response from the process of retrieving the vehicle profiles.
 */
class VehicleProfilesResponse extends Common
{
    /** Current page of the paginated vehicle profiles list.
     * @var integer $current_page
     */
    public $current_page;

    /** An array of the vehicle profiles
     * @var array of VehileProfile
     */
    public $data = [];

    /** URL to the first page of the paginated vehicle profiles list.
     * @var string $first_page_url
     */
    public $first_page_url;

    /** From which vehicle profile is starting the page
     * @var integer $from
     */
    public $from;

    /** Last page
     * @var integer $last_page
     */
    public $last_page;

    /** URL to the last page of the paginated vehicle profiles list.
     * @var string $last_page_url
     */
    public $last_page_url;

    /** URL to the next page of the paginated vehicle profiles list.
     * @var string $next_page_url
     */
    public $next_page_url;

    /** Path to the API endpoint
     * @var string $path
     */
    public $path;

    /** Vehicles number per page
     * @var integer $per_page
     */
    public $per_page;

    /** URL to the previous page
     * @var string $prev_page_url
     */
    public $prev_page_url;

    /** To which vehicle profile is ending the page
     * @var integer $to
     */
    public $to;

    /** Total number of the vehicles.
     * @var integer $total
     */
    public $total;

    public static function fromArray(array $params)
    {
        $profResp = new self();

        foreach ($params as $key => $value) {
            if (is_null(Common::getValue($params, $key))) continue;
            if (property_exists($profResp, $key)) {
                $profResp->$key = $value;
            }
        }

        return $profResp;
    }
}