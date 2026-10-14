<?php

namespace Route4Me\V5\Addresses;

/**
 * Class BundledItemResponse.
 */
class BundledItemResponse extends \Route4Me\Common
{
    /** Summary cube value of the bundled addresses.
     * @var float
     */
    public $cube;

    /** Summary revenue value of the bundled addresses.
     * @var float
     */
    public $revenue;

    /** Summary pieces value of the bundled addresses.
     * @var int
     */
    public $pieces;

    /** Summary weight value of the bundled addresses.
     * @var float
     */
    public $weight;

    /** Summary cost value of the bundled addresses.
     * @var float
     */
    public $cost;

    /** Service time of the bundled addresses.
     * @var int
     */
    public $service_time;

    /** Time window start of the bundled addresses.
     * @var int
     */
    public $time_window_start;

    /** Time window emd of the bundled addresses.
     * @var int
     */
    public $time_window_end;

    /** TO DO: Adjust description.
     * @var array
     */
    public $custom_data = [];

    /** Array of the IDs of the bundeld addresses.
     * @var int[]
     */
    public $addresses_id = [];
}
