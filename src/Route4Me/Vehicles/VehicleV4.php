<?php

namespace Route4Me\Vehicles;

use Route4Me\Common;
use Route4Me\Enum\Endpoint;
use Route4Me\Route4Me;

/**
 * Class VehicleV4
 * @package Route4Me\Vehicles
 * Vehicle response from the endpoint https://wh.route4me.com/modules/api.v4/vehicle.php
 */
class VehicleV4 extends \Route4Me\Common
{
    /** @var string $vehicle_id
     * Vehicle unique 32-chars ID
     */
    public $vehicle_id;

    /** @var int $member_id
     * Member unique ID
     */
    public $member_id;

    /** @var boolean $is_deleted
     * True, if the vehicle was deleted.
     */
    public $is_deleted;

    /** @var string $vehicle_alias
     * Vehicle alias
     */
    public $vehicle_alias;

    /** @var string $vehicle_vin
     * Vehicle VIN (vehicle identification number)
     */
    public $vehicle_vin;

    /** @var int $vehicle_reg_state_id
     * The ID of a state the vehicle was registered.
     */
    public $vehicle_reg_state_id;

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

    /** @var string $timestamp_added
     * When the vehicle was added.
     */
    public $timestamp_added;

    /** @var string $vehicle_make
     * Vehicle maker brend.
     * Available values:
     * 'american coleman', 'bmw', 'chevrolet', 'ford', 'freightliner', 'gmc',
     * 'hino', 'honda', 'isuzu', 'kenworth', 'mack', 'mercedes-benz', 'mitsubishi',
     * 'navistar', 'nissan', 'peterbilt', 'renault', 'scania', 'sterling', 'toyota',
     * 'volvo', 'western star'
     */
    public $vehicle_make;

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

    /** @var string $vehicle_cost_new
     * A cost of the new vehicle.
     */
    public $vehicle_cost_new;

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

    /** @var boolean $is_operational
     * If true, the vehicle is operational.
     */
    public $is_operational;

    /** @var string $fuel_type
     * A type of the fuel.
     * Available values:
     * 'unleaded 87', 'unleaded 89', 'unleaded 91', 'unleaded 93', 'diesel', 'electric', 'hybrid'
     */
    public $fuel_type;

    /** @var string $external_telematics_vehicle_id
     * External telematics vehicle ID.
     */
    public $external_telematics_vehicle_id;

    /** @var string $timestamp_removed
     * When the vehicle was removed.
     */
    public $timestamp_removed;

    /** @var string $vehicle_profile_id
     * Vehicle profile ID
     */
    public $vehicle_profile_id;

    /** @var double $fuel_consumption_city
     * Fuel consumption in the city area.
     */
    public $fuel_consumption_city;

    /** @var double $fuel_consumption_highway
     * Fuel consumption in the highway area.
     */
    public $fuel_consumption_highway;

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

    public function __construct()
    {
        Route4Me::setBaseUrl(Endpoint::WH_BASE_URL);
    }

    public static function fromArray(array $params)
    {
        $vehicle = new self();

        foreach ($params as $key => $value) {
            if (is_null(Common::getValue($params, $key))) continue;
            if (property_exists($vehicle, $key)) {
                $vehicle->$key = $value;
            }
        }

        return $vehicle;
    }

    public static function getVehicles($params)
    {
        $allQueryFields = ['with_pagination', 'page', 'perPage'];

        $response = Route4Me::makeRequst([
            'url' => Endpoint::VEHICLE_V4,
            'method' => 'GET',
            'query' => Route4Me::generateRequestParameters($allQueryFields, $params),
        ]);

        return $response;
    }

    public function getVehicleByID($vehicleID)
    {
        $response = Route4Me::makeRequst([
            'url' => Endpoint::VEHICLE_V4.'/'.$vehicleID,
            'method' => 'GET',
        ]);

        return $response;
    }

    public function updateVehicle($params)
    {
        $vehicleID = isset($params->vehicle_id) ? $params->vehicle_id : null;

        $allBodyFields = Route4Me::getObjectProperties(new self(), ['vehicle_id']);

        $response = Route4Me::makeRequst([
            'url' => Endpoint::VEHICLE_V4.'/'.$vehicleID,
            'method' => 'PUT',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params),
            'HTTPHEADER' => 'Content-Type: application/json',
        ]);

        return $response;
    }

    public function createVehicle($params)
    {
        $excludeFields = ['vehicle_id','is_deleted','created_time','timestamp_added','timestamp_removed'];
        $allBodyFields = Route4Me::getObjectProperties(new self(), $excludeFields);

        //Route4Me::setBaseUrl(Endpoint::BASE_URL);

        $response = Route4Me::makeRequst([
            'url' => Endpoint::VEHICLE_V4,
            'method' => 'POST',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params),
            'HTTPHEADER' => 'Content-Type: application/json',
        ]);

        return $response;
    }

    public function removeVehicle($params)
    {
        $vehicleID = isset($params->vehicle_id) ? $params->vehicle_id : null;

        $response = Route4Me::makeRequst([
            'url' => Endpoint::VEHICLE_V4.'/'.$vehicleID,
            'method' => 'DELETE',
            'HTTPHEADER' => 'Content-Type: application/json',
        ]);

        return $response;
    }

}