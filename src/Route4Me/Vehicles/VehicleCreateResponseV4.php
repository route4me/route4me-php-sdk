<?php

namespace Route4Me\Vehicles;

use Route4Me\Common;

/**
 * Class VehicleCreateResponseV4.
 */
class VehicleCreateResponseV4 extends Common
{
    /** @var string
     * Vehicle alias
     */
    public $vehicle_alias;

    /** @var string
     * Vehicle VIN (vehicle identification number)
     */
    public $vehicle_vin;

    /** @var int
     * The ID of a country the vehicle was registered.
     */
    public $vehicle_reg_country_id;

    /** @var string
     * A license plate of the vehicle.
     */
    public $vehicle_license_plate;

    /** @var string
     * Vehicle type ID.
     * Available values:
     * 'sedan', 'suv', 'pickup_truck', 'van', '18wheeler', 'cabin', 'hatchback',
     * 'motorcyle', 'waste_disposal', 'tree_cutting', 'bigrig', 'cement_mixer',
     * 'livestock_carrier', 'dairy','tractor_trailer'
     */
    public $vehicle_type_id;

    /** @var int
     * A year of the vehicle model.
     */
    public $vehicle_model_year;

    /** @var string
     * A model of the vehicle.
     */
    public $vehicle_model;

    /** @var int
     * A year, the vehicle was acquired.
     */
    public $vehicle_year_acquired;

    /** @var string
     * If true, the vehicle was purchased new.
     */
    public $purchased_new;

    /** @var string
     * Start date of the license (e.g. '2020-12-20').
     */
    public $license_start_date;

    /** @var string
     * End date of the license (e.g. '2020-12-20').
     */
    public $license_end_date;

    /** @var string
     * A type of the fuel.
     * Available values:
     * 'unleaded 87', 'unleaded 89', 'unleaded 91', 'unleaded 93', 'diesel', 'electric', 'hybrid'
     */
    public $fuel_type;

    /** @var float
     * Fuel consumption in the city area.
     */
    public $fuel_consumption_city;

    /** @var float
     * Fuel consumption in the highway area.
     */
    public $fuel_consumption_highway;

    /** @var int
     * Member unique ID
     */
    public $member_id;

    /** @var string
     * Vehicle unique 32-chars ID
     */
    public $vehicle_id;

    /** @var string
     * When the vehicle was added.
     */
    public $timestamp_added;

    /** @var string
     * Fuel consumption unit in the city area (e.g. 'mi/l').
     */
    public $fuel_consumption_city_unit;

    /** @var string
     * Fuel consumption unit in the highway area (e.g. 'mi/l').
     */
    public $fuel_consumption_highway_unit;

    /** @var float
     * Miles per gallon in the city area.
     */
    public $mpg_city;

    /** @var float
     * Miles per gallon in the highway area.
     */
    public $mpg_highway;

    /** @var string
     * Fuel consumption UF (utility factor) value in the city area.
     */
    public $fuel_consumption_city_uf_value;

    /** @var string
     * Fuel consumption UF (utility factor) value in the highway area.
     */
    public $fuel_consumption_highway_uf_value;

    public static function fromArray(array $params)
    {
        $vehicleCreateResponse = new self();

        foreach ($params as $key => $value) {
            if (is_null(Common::getValue($params, $key))) continue;
            if (property_exists($vehicleCreateResponse, $key)) {
                $vehicleCreateResponse->$key = $value;
            }
        }

        return $vehicleCreateResponse;
    }
}
