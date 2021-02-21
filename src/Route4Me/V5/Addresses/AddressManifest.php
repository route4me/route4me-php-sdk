<?php


namespace Route4Me\V5\Addresses;

/**
 * Class AddressManifest
 * @package Route4Me\V5\Addresses
 * Manifest of a route address. Subclass of the class Address.
 */
class AddressManifest extends \Route4Me\Common
{
    /** How much time is to be spent on service from the start in seconds.
     * @var integer $running_service_time
     */
    public $running_service_time;

    /** How much time is spent driving from the start in seconds.
     * @var integer $running_travel_time
     */
    public $running_travel_time;

    /** Running wait time.
     * @var integer $running_wait_time
     */
    public $running_wait_time;

    /** Distance traversed before reaching this address.
     * @var double $running_distance
     */
    public $running_distance;

    /** Expected fuel consumption from the start.
     * @var double $fuel_from_start
     */
    public $fuel_from_start;

    /** Expected fuel cost from start.
     * @var double $fuel_cost_from_start
     */
    public $fuel_cost_from_start;

    /** Projected arrival time UTC unixtime.
     * @var integer $projected_arrival_time_ts
     */
    public $projected_arrival_time_ts;

    /** Estimated departure time UTC unixtime.
     * @var integer $projected_departure_time_ts
     */
    public $projected_departure_time_ts;

    /** Time when the address was marked as visited UTC unixtime.
     * This is actually equal to timestamp_last_visited most of the time.
     * @var integer $actual_arrival_time_ts
     */
    public $actual_arrival_time_ts;

    /** Time when the address was marked as departed UTC.
     * This is actually equal to timestamp_last_departed most of the time.
     * @var integer $actual_departure_time_ts
     */
    public $actual_departure_time_ts;

    /** Estimated arrival time based on the current route progress,
     * i.e. based on the last known actual_arrival_time.
     * @var integer $estimated_arrival_time_ts
     */
    public $estimated_arrival_time_ts;

    /** Estimated departure time based on the current route progress.
     * @var integer $estimated_departure_time_ts
     */
    public $estimated_departure_time_ts;

    /** Scheduled arrival time.
     * @var integer $scheduled_arrival_time_ts
     */
    public $scheduled_arrival_time_ts;

    /** Scheduled departure time.
     * @var integer $scheduled_departure_time_ts
     */
    public $scheduled_departure_time_ts;

    /** This is the difference between the originally projected arrival time and Actual Arrival Time.
     * @var integer $time_impact
     */
    public $time_impact;

    /** Distance traversed before reaching this address.
     * @var double $udu_running_distance
     */
    public $udu_running_distance;

}