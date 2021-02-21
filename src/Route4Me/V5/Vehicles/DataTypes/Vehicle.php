<?php


namespace Route4Me\V5\Vehicles\DataTypes;

use Route4Me\Common as Common;
use Route4Me\Route4Me as Route4Me;
use Route4Me\V5\Enum\Endpoint as Endpoint;
use Route4Me\V5\Vehicles\QueryTypes\VehicleParameters as VehicleParameters;
use Route4Me\V5\Vehicles\QueryTypes\VehicleOrderParameters as VehicleOrderParameters;
use Route4Me\Constants as Constants;
use Route4Me\V5\Vehicles\QueryTypes\VehicleSearchParameters;

/**
 * Class Vehicle
 * @package Route4Me\V5\Vehicles
 * Response from the vehicle request
 */
class Vehicle extends Common
{
    /** The vehicle ID
     * @var string $vehicle_id
     */
    public $vehicle_id;

    /** Member ID assigned to the vehicle.
     * @var integer $member_id
     */
    public $member_id;

    /** If true, the vehicle is marked as deleted.
     * @var boolean $is_deleted
     */
    public $is_deleted;

    /** Vehicle alias
     * @var string $vehicle_alias
     */
    public $vehicle_alias;

    /** Vehicle VIN
     * @var string $vehicle_vin
     */
    public $vehicle_vin;

    /** Vehicle registration state ID.
     * @var integer $vehicle_reg_state_id
     */
    public $vehicle_reg_state_id;

    /** Vehicle registration country ID.
     * @var integer $vehicle_reg_country_id
     */
    public $vehicle_reg_country_id;

    /** A license plate of the vehicle.
     * @var string $vehicle_license_plate
     */
    public $vehicle_license_plate;

    /** Vehicle type.
     * <para>Availbale values:</para>
     * sedan', 'suv', 'pickup_truck', 'van', '18wheeler', 'cabin', 'hatchback',
     * '<para>motorcyle', 'waste_disposal', 'tree_cutting', 'bigrig', 'cement_mixer', </para>
     * 'livestock_carrier', 'dairy','tractor_trailer'.
     * @var string $vehicle_type_id
     */
    public $vehicle_type_id;

    /** When the vehicle was added.
     * @var string $timestamp_added
     */
    public $timestamp_added;

    /** Vehicle maker brend.
     * <para>Available values:</para>
     * "american coleman", "bmw", "chevrolet", "ford", "freightliner", "gmc",
     * <para>"hino", "honda", "isuzu", "kenworth", "mack", "mercedes-benz", "mitsubishi", </para>
     * "navistar", "nissan", "peterbilt", "renault", "scania", "sterling", "toyota",
     * <para>"volvo", "western star" </para>
     * </value>"
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

    /** A type of the fuel
     * @var string $fuel_type
     * enum: ['unleaded 87','unleaded 89','unleaded 91','unleaded 93','diesel','electric','hybrid']
     */
    public $fuel_type;

    /** External telematics vehicle IDs
     * @var integer $external_telematics_vehicle_ids
     */
    public $external_telematics_vehicle_id;

    /** When the vehcile was marked as deleted.
     * @var integer $timestamp_removed
     */
    public $timestamp_removed;

    /** Vehicle profile ID
     * @var integer $vehicle_profile_id
     */
    public $vehicle_profile_id;

    /** Fuel consumption city
     * @var float $fuel_consumption_city
     */
    public $fuel_consumption_city;

    /** Fuel consumption in the highway area
     * @var float $fuel_consumption_highway
     */
    public $fuel_consumption_highway;

    /** Fuel consumption units in the city area (e.g. mi/l)
     * @var string $fuel_consumption_city_unit
     */
    public $fuel_consumption_city_unit;

    /** Fuel consumption units in the highway area (e.g. mi/l)
     * @var string $fuel_consumption_highway_unit
     */
    public $fuel_consumption_highway_unit;

    /** Miles per gallon in the city area
     * @var float $mpg_city
     */
    public $mpg_city;

    /** Miles per gallon in the highway area
     * @var float $mpg_highway
     */
    public $mpg_highway;

    /** Fuel consumption UF value in the city area (e.g. '20.01 mi/l')
     * @var string $fuel_consumption_city_uf_value
     */
    public $fuel_consumption_city_uf_value;

    /** Fuel consumption UF value in the highway area (e.g. '2,000.01 mpg')
     * @var string $fuel_consumption_highway_uf_value
     */
    public $fuel_consumption_highway_uf_value;

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

    public function __construct()
    {
        Route4Me::setBaseUrl("");
    }

    /** Creates a vehicle
     * @param $vehicleParams
     * Returns a vehicle object or failure info.
     */
    public function createVehicle($vehicleParams)
    {
        $excludeFields = ['vehicle_id', 'is_deleted', 'created_time', 'timestamp_added', 'timestamp_removed'];
        $allBodyFields = Route4Me::getObjectProperties(new self(), $excludeFields);

        $response = Route4Me::makeRequst([
            'url' => Endpoint::Vehicles,
            'method' => 'POST',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $vehicleParams),
            'HTTPHEADER' => Constants::DEFAULT_HTTP_HEADER,
        ]);

        return $response;
    }

    /** Removes a vehicle by specified vehicle ID.
     * @param string $vehicleID - Vehicle ID
     * @return Vehicle object - removed vehicle object.
     * @throws \Route4Me\Exception\ApiError
     */
    public function removeVehicle($vehicleParams)
    {
        $vehicleId = $vehicleParams['vehicle_id'];

        $response = Route4Me::makeRequst([
            'url' => Endpoint::Vehicles . '/' . $vehicleId,
            'method' => 'DELETE',
            'HTTPHEADER' => Constants::DEFAULT_HTTP_HEADER,
        ]);

        return $response;
    }

    /** Returns the VehiclesPaginated type object containing an array of the vehicles.
     * @param array $params - an array from the VehicleParameters object.
     * @return an array of the Vehicle objects.
     * @throws \Route4Me\Exception\ApiError
     */
    public function getVehiclesPaginatedList($params)
    {
        $allQueryFields = ['with_pagination', 'page', 'perPage'];

        $response = Route4Me::makeRequst([
            'url' => Endpoint::Vehicles,
            'method' => 'GET',
            'query' => Route4Me::generateRequestParameters($allQueryFields, $params),
        ]);

        return $response;
    }

    /** Creates temporary vehicle in the database.
     * @param $vehicleParams - an array from the VehicleTemporary object.
     * @return an object of the type VehicleTemporary.
     * @throws \Route4Me\Exception\ApiError
     */
    public function createTemporaryVehicle($vehicleParams)
    {
        $excludeFields = [];
        $allBodyFields = Route4Me::getObjectProperties(new VehicleTemporary(), $excludeFields);

        $response = Route4Me::makeRequst([
            'url' => Endpoint::VehicleTemporary,
            'method' => 'POST',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $vehicleParams),
            'HTTPHEADER' => Constants::DEFAULT_HTTP_HEADER,
        ]);

        return $response;
    }

    /** Execute a vehicle order.
     * @param $vehicleParams - Vehicle order parameters.
     * @return an object of the type VehicleOrderResponse
     * @throws \Route4Me\Exception\ApiError
     */
    public function executeVehicleOrder($vehicleParams)
    {
        $excludeFields = [];
        $allBodyFields = Route4Me::getObjectProperties(new VehicleOrderParameters(), $excludeFields);

        $response = Route4Me::makeRequst([
            'url' => Endpoint::VehicleExecuteOrder,
            'method' => 'POST',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $vehicleParams),
            'HTTPHEADER' => Constants::DEFAULT_HTTP_HEADER,
        ]);

        return $response;
    }

    /** Get latest vehicle locations by specified vehicle IDs.
     * @param $vehicleParams - Vehicle query parameters containing vehicle IDs
     * @return Data with vehicles
     * @throws \Route4Me\Exception\ApiError
     */
    public function getVehicleLocations($vehicleParams)
    {
        $allQueryFields = ['ids'];

        $response = Route4Me::makeRequst([
            'url' => Endpoint::VehicleLocation,
            'method' => 'GET',
            'query' => Route4Me::generateRequestParameters($allQueryFields, $vehicleParams),
        ]);

        return $response;
    }

    /** Get the Vehicle by specifying vehicle ID.
     * @param $vehicleParams - Vehicle query parameters containing vehicle ID.
     * @return an object of the type Vehicle
     * @throws \Route4Me\Exception\ApiError
     */
    public function getVehicleById($vehicleParams)
    {
        $allQueryFields = ['vehicle_id'];

        $response = Route4Me::makeRequst([
            'url' => Endpoint::Vehicles.'/'.$vehicleParams['vehicle_id'],
            'method' => 'GET',
            'query' => null,
        ]);

        return $response;
    }

    /** Get the Vehicle track by specifying vehicle ID.
     * @param $vehicleParams - Vehicle query parameters containing vehicle ID.
     * @return Vehicle track object
     * @throws \Route4Me\Exception\ApiError
     */
    public function getVehicleTrack($vehicleParams)
    {
        $response = Route4Me::makeRequst([
            'url' => Endpoint::Vehicles.'/'.$vehicleParams['vehicle_id'].'/track',
            'method' => 'GET',
            'query' => null,
        ]);

        return $response;
    }

    public function getVehicleByLicensePlate($vehicleParams)
    {
        $allQueryFields = ['vehicle_license_plate'];

        $response = Route4Me::makeRequst([
            'url' => Endpoint::VehicleLicense,
            'method' => 'GET',
            'query' => Route4Me::generateRequestParameters($allQueryFields, $vehicleParams),
        ]);

        return $response;
    }

    public function searchVehicles($searchParams)
    {
        $excludeFields = [];
        $allBodyFields = Route4Me::getObjectProperties(new VehicleSearchParameters(), $excludeFields);

        $response = Route4Me::makeRequst([
            'url' => Endpoint::VehicleSearch,
            'method' => 'POST',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $searchParams),
            'HTTPHEADER' => Constants::DEFAULT_HTTP_HEADER,
        ]);

        return $response;
    }

    public function updateVehicle($vehicleParams)
    {
        $excludeFields = ['vehicle_id', 'is_deleted', 'created_time', 'timestamp_added', 'timestamp_removed'];
        $allBodyFields = Route4Me::getObjectProperties(new self(), $excludeFields);

        $response = Route4Me::makeRequst([
            'url' => Endpoint::Vehicles.'/'.$vehicleParams['vehicle_id'],
            'method' => 'PATCH',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $vehicleParams),
            'HTTPHEADER' => Constants::DEFAULT_HTTP_HEADER,
        ]);

        return $response;
    }
}