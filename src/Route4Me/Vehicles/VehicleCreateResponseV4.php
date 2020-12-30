<?php

namespace Route4Me\Vehicles;

use Route4Me\Common;

/**
 * Class VehicleCreateResponseV4
 * @package Route4Me\Vehicles
 * Response from the create vehicle request.
 */
class VehicleCreateResponseV4 extends \Route4Me\Common
{
    /** @var string $vehicle_alias
     * Vehicle alias
     */
    public $vehicle_alias;

    /** @var string $vehicle_vin
     * Vehicle VIN (vehicle identification number)
     */
    public $vehicle_vin;

    /** @var int $vehicle_reg_country_id
     * The ID of a country the vehicle was registered.
     */
    public $vehicle_reg_country_id;

    /** @var string $vehicle_license_plate
     * A license plate of the vehicle.
     */
    public $vehicle_license_plate;

    /** @var string $vehicle_type_id
     * Vehicle type ID.
     * Available values:
     * 'sedan', 'suv', 'pickup_truck', 'van', '18wheeler', 'cabin', 'hatchback',
     * 'motorcyle', 'waste_disposal', 'tree_cutting', 'bigrig', 'cement_mixer',
     * 'livestock_carrier', 'dairy','tractor_trailer'
     */
    public $vehicle_type_id;

    /** @var int $vehicle_model_year
     * A year of the vehicle model.
     */
    public $vehicle_model_year;

    /** @var string $vehicle_model
     * A model of the vehicle.
     */
    public $vehicle_model;

    /** @var int $vehicle_year_acquired
     * A year, the vehicle was acquired.
     */
    public $vehicle_year_acquired;

    /** @var string $purchased_new
     * If true, the vehicle was purchased new.
     */
    public $purchased_new;

    /** @var string $license_start_date
     * Start date of the license (e.g. '2020-12-20').
     */
    public $license_start_date;

    /** @var string $license_end_date
     * End date of the license (e.g. '2020-12-20').
     */
    public $license_end_date;

    /** @var string $fuel_type
     * A type of the fuel.
     * Available values:
     * 'unleaded 87', 'unleaded 89', 'unleaded 91', 'unleaded 93', 'diesel', 'electric', 'hybrid'
     */
    public $fuel_type;

    /** @var double $fuel_consumption_city
     * Fuel consumption in the city area.
     */
    public $fuel_consumption_city;

    /** @var double $fuel_consumption_highway
     * Fuel consumption in the highway area.
     */
    public $fuel_consumption_highway;

    /** @var int $member_id
     * Member unique ID
     */
    public $member_id;

    /** @var string $vehicle_id
     * Vehicle unique 32-chars ID
     */
    public $vehicle_id;

    /** @var string $timestamp_added
     * When the vehicle was added.
     */
    public $timestamp_added;

    /** @var string $fuel_consumption_city_unit
     * Fuel consumption unit in the city area (e.g. 'mi/l').
     */
    public $fuel_consumption_city_unit;

    /** @var string $fuel_consumption_highway_unit
     * Fuel consumption unit in the highway area (e.g. 'mi/l').
     */
    public $fuel_consumption_highway_unit;

    /** @var double $mpg_city
     * Miles per gallon in the city area.
     */
    public $mpg_city;

    /** @var double $mpg_highway
     * Miles per gallon in the highway area.
     */
    public $mpg_highway;

    /** @var string $fuel_consumption_city_uf_value
     * Fuel consumption UF (utility factor) value in the city area.
     */
    public $fuel_consumption_city_uf_value;

    /** @var string $fuel_consumption_highway_uf_value
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