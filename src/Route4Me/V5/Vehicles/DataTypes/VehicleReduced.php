<?php


namespace Route4Me\V5\Vehicles\DataTypes;

/**
 * Class VehicleReduced
 * @package Route4Me\V5\Vehicles
 * Reduced vehicle structure
 */
class VehicleReduced extends \Route4Me\Common
{
    /** The vehicle ID
     * @var string $vehicle_id
     */
    public $vehicle_id;

    /** Vehicle alias
     * @var string $vehicle_alias
     */
    public $vehicle_alias;

    /** Vehicle VIN
     * @var string $vehicle_vin
     */
    public $vehicle_vin;

    /** A license plate of the vehicle.
     * @var string $vehicle_license_plate
     */
    public $vehicle_license_plate;

    /** Vehicle maker brend.
     * <para>Available values:</para>
     * "american coleman", "bmw", "chevrolet", "ford", "freightliner", "gmc",
     * <para>"hino", "honda", "isuzu", "kenworth", "mack", "mercedes-benz", "mitsubishi", </para>
     * "navistar", "nissan", "peterbilt", "renault", "scania", "sterling", "toyota",
     * <para>"volvo", "western star" </para>
     * @var string $vehicle_make
     */
    public $vehicle_make;

    /** Vehicle model year
     * @var integer $vehicle_model_year
     */
    public $vehicle_model_year;

    /** Vehicle model
     * @var string $vehicle_model
     */
    public $vehicle_model;

    /** The year, vehicle was acquired
     * @var integer $vehicle_year_acquired
     */
    public $vehicle_year_acquired;

    /** A cost of the new vehicle
     * @var float $vehicle_cost_new
     */
    public $vehicle_cost_new;

    /** If true, the vehicle was purchased new.
     * @var boolean $purchased_new
     */
    public $purchased_new;

    /** Start date of the license
     * @var string $license_start_date
     */
    public $license_start_date;

    /** End date of the license
     * @var string $license_end_date
     */
    public $license_end_date;

    /** If equal to '1', the vehicle is operational.
     * @var boolean $is_operational
     */
    public $is_operational;
}