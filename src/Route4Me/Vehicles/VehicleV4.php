<?php

namespace Route4Me\Vehicles;

use Route4Me\Common;
use Route4Me\Enum\Endpoint;
use Route4Me\Route4Me;

/**
 * Class VehicleV4
 * (Vehicle response from the endpoint https://wh.route4me.com/modules/api.v4/vehicle.php).
 *
 * @deprecated 1.2.6
 * @see \Route4Me\V5\Vehicles\DataTypes\Vehicle
 */
class VehicleV4 extends Common
{
    /** @var string
     * Vehicle unique 32-chars ID
     */
    public $vehicle_id;

    /** @var int
     * Member unique ID
     */
    public $member_id;

    /** @var bool
     * True, if the vehicle was deleted.
     */
    public $is_deleted;

    /** @var string
     * Vehicle alias
     */
    public $vehicle_alias;

    /** @var string
     * Vehicle VIN (vehicle identification number)
     */
    public $vehicle_vin;

    /** @var int
     * The ID of a state the vehicle was registered.
     */
    public $vehicle_reg_state_id;

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

    /** @var string
     * When the vehicle was added.
     */
    public $timestamp_added;

    /** @var string
     * Vehicle maker brend.
     * Available values:
     * 'american coleman', 'bmw', 'chevrolet', 'ford', 'freightliner', 'gmc',
     * 'hino', 'honda', 'isuzu', 'kenworth', 'mack', 'mercedes-benz', 'mitsubishi',
     * 'navistar', 'nissan', 'peterbilt', 'renault', 'scania', 'sterling', 'toyota',
     * 'volvo', 'western star'
     */
    public $vehicle_make;

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
     * A cost of the new vehicle.
     */
    public $vehicle_cost_new;

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

    /** @var bool
     * If true, the vehicle is operational.
     */
    public $is_operational;

    /** @var string
     * A type of the fuel.
     * Available values:
     * 'unleaded 87', 'unleaded 89', 'unleaded 91', 'unleaded 93', 'diesel', 'electric', 'hybrid'
     */
    public $fuel_type;

    /** @var string
     * External telematics vehicle ID.
     */
    public $external_telematics_vehicle_id;

    /** @var string
     * When the vehicle was removed.
     */
    public $timestamp_removed;

    /** @var string
     * Vehicle profile ID
     */
    public $vehicle_profile_id;

    /** @var float
     * Fuel consumption in the city area.
     */
    public $fuel_consumption_city;

    /** @var float
     * Fuel consumption in the highway area.
     */
    public $fuel_consumption_highway;

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

    public function __construct()
    {
    }

    public static function fromArray(array $params)
    {
        $vehicle = new self();

        foreach ($params as $key => $value) {
            if (is_null(Common::getValue($params, $key))) {
                continue;
            }
            if (property_exists($vehicle, $key)) {
                $vehicle->$key = $value;
            }
        }

        return $vehicle;
    }

    /**
     * @deprecated 1.2.6
     * @see \Route4Me\V5\Vehicles\DataTypes\Vehicle::getVehiclesPaginatedList()
     */
    public static function getVehicles($params)
    {
        $allQueryFields = ['with_pagination', 'page', 'perPage'];

        $response = Route4Me::makeRequst([
            'baseUrl' => Endpoint::WH_BASE_URL,
            'url' => Endpoint::VEHICLE_V4,
            'method' => 'GET',
            'query' => Route4Me::generateRequestParameters($allQueryFields, $params),
        ]);

        return $response;
    }

    /**
     * @deprecated 1.2.6
     * @see \Route4Me\V5\Vehicles\DataTypes\Vehicle::getVehicleById()
     */
    public function getVehicleByID($vehicleID)
    {
        $response = Route4Me::makeRequst([
            'baseUrl' => Endpoint::WH_BASE_URL,
            'url' => Endpoint::VEHICLE_V4 . '/' . $vehicleID,
            'method' => 'GET',
        ]);

        return $response;
    }

    /**
     * @deprecated 1.2.6
     * @see \Route4Me\V5\Vehicles\DataTypes\Vehicle::updateVehicle()
     */
    public function updateVehicle($params)
    {
        $vehicleID = $params->vehicle_id ?? null;

        $allBodyFields = Route4Me::getObjectProperties(new self(), ['vehicle_id']);

        $response = Route4Me::makeRequst([
            'baseUrl' => Endpoint::WH_BASE_URL,
            'url' => Endpoint::VEHICLE_V4 . '/' . $vehicleID,
            'method' => 'PUT',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params),
            'HTTPHEADER' => 'Content-Type: application/json',
        ]);

        return $response;
    }

    /**
     * @deprecated 1.2.6
     * @see \Route4Me\V5\Vehicles\DataTypes\Vehicle::createVehicle()
     */
    public function createVehicle($params)
    {
        $excludeFields = ['vehicle_id', 'is_deleted', 'created_time', 'timestamp_added', 'timestamp_removed'];
        $allBodyFields = Route4Me::getObjectProperties(new self(), $excludeFields);

        $response = Route4Me::makeRequst([
            'baseUrl' => Endpoint::WH_BASE_URL,
            'url' => Endpoint::VEHICLE_V4,
            'method' => 'POST',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params),
            'HTTPHEADER' => 'Content-Type: application/json',
        ]);

        return $response;
    }

    /**
     * @deprecated 1.2.6
     * @see \Route4Me\V5\Vehicles\DataTypes\Vehicle::removeVehicle()
     */
    public function removeVehicle($params)
    {
        $vehicleID = $params->vehicle_id ?? null;

        $response = Route4Me::makeRequst([
            'baseUrl' => Endpoint::WH_BASE_URL,
            'url' => Endpoint::VEHICLE_V4 . '/' . $vehicleID,
            'method' => 'DELETE',
            'HTTPHEADER' => 'Content-Type: application/json',
        ]);

        return $response;
    }
}
