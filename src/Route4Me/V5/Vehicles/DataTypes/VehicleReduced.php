<?php

namespace Route4Me\V5\Vehicles\DataTypes;

/**
 * Class VehicleReduced.
 */
class VehicleReduced extends \Route4Me\Common
{
    /** The vehicle ID.
     * @var string
     */
    public $vehicle_id;

    /** Vehicle alias.
     * @var string
     */
    public $vehicle_alias;

    /** Vehicle VIN.
     * @var string
     */
    public $vehicle_vin;

    /** A license plate of the vehicle.
     * @var string
     */
    public $vehicle_license_plate;

    /** Vehicle maker brend.
     * <para>Available values:</para>
     * "american coleman", "bmw", "chevrolet", "ford", "freightliner", "gmc",
     * <para>"hino", "honda", "isuzu", "kenworth", "mack", "mercedes-benz", "mitsubishi", </para>
     * "navistar", "nissan", "peterbilt", "renault", "scania", "sterling", "toyota",
     * <para>"volvo", "western star" </para>.
     * @var string
     */
    public $vehicle_make;

    /** Vehicle model year.
     * @var int
     */
    public $vehicle_model_year;

    /** Vehicle model.
     * @var string
     */
    public $vehicle_model;

    /** The year, vehicle was acquired.
     * @var int
     */
    public $vehicle_year_acquired;

    /** A cost of the new vehicle.
     * @var float
     */
    public $vehicle_cost_new;

    /** If true, the vehicle was purchased new.
     * @var bool
     */
    public $purchased_new;

    /** Start date of the license.
     * @var string
     */
    public $license_start_date;

    /** End date of the license.
     * @var string
     */
    public $license_end_date;

    /** If equal to '1', the vehicle is operational.
     * @var bool
     */
    public $is_operational;
}
