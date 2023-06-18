<?php


namespace Route4Me\V5\Addresses;

use Route4Me\Exception\BadParam;

/**
 * Class BundledItemResponse
 * @package Route4Me\V5\Addresses
 * Bundled item data structure
 */
class BundledItemResponse extends \Route4Me\Common
{
    /** Summary cube value of the bundled addresses
     * @var double $cube
     */
    public $cube;

    /** Summary revenue value of the bundled addresses
     * @var double $revenue
     */
    public $revenue;

    /** Summary pieces value of the bundled addresses
     * @var integer $pieces
     */
    public $pieces;

    /** Summary weight value of the bundled addresses
     * @var double $weight
     */
    public $weight;

    /** Summary cost value of the bundled addresses
     * @var double $cost
     */
    public $cost;

    /** Service time of the bundled addresses
     * @var integer $service_time
     */
    public $service_time;

    /** Time window start of the bundled addresses
     * @var integer $time_window_start
     */
    public $time_window_start;

    /** Time window emd of the bundled addresses
     * @var integer $time_window_end
     */
    public $time_window_end;

    /** TO DO: Adjust description
     * @var array $custom_data
     */
    public $custom_data = [];

    /** Array of the IDs of the bundeld addresses.
     * @var integer[] $addresses_id
     */
    public $addresses_id = [];
}
