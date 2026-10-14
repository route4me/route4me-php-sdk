<?php

namespace Route4Me\V5\Addresses;

/**
 * Class AddressManifest.
 */
class AddressManifest extends \Route4Me\Common
{
    /** How much time is to be spent on service from the start in seconds.
     * @var int
     */
    public $running_service_time;

    /** How much time is spent driving from the start in seconds.
     * @var int
     */
    public $running_travel_time;

    /** Running wait time.
     * @var int
     */
    public $running_wait_time;

    /** Distance traversed before reaching this address.
     * @var float
     */
    public $running_distance;

    /** Expected fuel consumption from the start.
     * @var float
     */
    public $fuel_from_start;

    /** Expected fuel cost from start.
     * @var float
     */
    public $fuel_cost_from_start;

    /** Projected arrival time UTC unixtime.
     * @var int
     */
    public $projected_arrival_time_ts;

    /** Estimated departure time UTC unixtime.
     * @var int
     */
    public $projected_departure_time_ts;

    /** Time when the address was marked as visited UTC unixtime.
     * This is actually equal to timestamp_last_visited most of the time.
     * @var int
     */
    public $actual_arrival_time_ts;

    /** Time when the address was marked as departed UTC.
     * This is actually equal to timestamp_last_departed most of the time.
     * @var int
     */
    public $actual_departure_time_ts;

    /** Estimated arrival time based on the current route progress,
     * i.e. based on the last known actual_arrival_time.
     * @var int
     */
    public $estimated_arrival_time_ts;

    /** Estimated departure time based on the current route progress.
     * @var int
     */
    public $estimated_departure_time_ts;

    /** Scheduled arrival time.
     * @var int
     */
    public $scheduled_arrival_time_ts;

    /** Scheduled departure time.
     * @var int
     */
    public $scheduled_departure_time_ts;

    /** This is the difference between the originally projected arrival time and Actual Arrival Time.
     * @var int
     */
    public $time_impact;

    /** Distance traversed before reaching this address.
     * @var float
     */
    public $udu_running_distance;

}
