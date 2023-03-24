<?php

namespace Route4Me\Vehicles;

use Route4Me\Common;
use Route4Me\Route4Me;
use Route4Me\Enum\Endpoint;

/**
 * Class Vehicle
 * (Vehicle response from the endpoint https://wh.route4me.com/modules/api.v4/vehicle.php)
 *
 * @deprecated 1.2.6
 * @see \Route4Me\V5\Vehicles\DataTypes\Vehicle
 * @package Route4Me\Vehicles
 */
class Vehicle extends \Route4Me\Common
{
    public $vehicle_id;
    public $member_id;
    public $is_deleted;
    public $vehicle_name;
    public $vehicle_alias;
    public $vehicle_vin;
    //public $created_time;
    public $vehicle_reg_state_id;
    public $vehicle_reg_country_id;
    public $vehicle_license_plate;
    public $vehicle_type_id;
    public $timestamp_added;
    public $vehicle_make;
    public $vehicle_model_year;
    public $vehicle_model;
    public $vehicle_year_acquired;
    public $vehicle_cost_new;
    public $purchased_new;
    public $license_start_date;
    public $license_end_date;
    public $vehicle_axle_count;
    public $mpg_city;
    public $mpg_highway;
    public $fuel_type;
    public $height_inches;
    public $weight_lb;
    public $route4me_telematics_internal_api_key;
    public $is_operational;
    public $external_telematics_vehicle_id;
    public $r4m_telematics_gateway_connection_id;
    public $r4m_telematics_gateway_vehicle_id;
    public $has_trailer;
    public $heightInInches;
    public $lengthInInches;
    public $widthInInches;
    public $maxWeightPerAxleGroupInPounds;
    public $numAxles;
    public $weightInPounds;
    public $HazmatType;
    public $LowEmissionZonePref;
    public $Use53FootTrailerRouting;
    public $UseNationalNetwork;
    public $UseTruckRestrictions;
    public $AvoidFerries;
    public $DividedHighwayAvoidPreference;
    public $FreewayAvoidPreference;
    public $InternationalBordersOpen;
    public $TollRoadUsage;
    public $hwy_only;
    public $long_combination_vehicle;
    public $avoid_highways;
    public $side_street_adherence;
    public $truck_config;
    public $height_metric;
    public $length_metric;
    public $width_metric;
    public $weight_metric;
    public $max_weight_per_axle_group_metric;
    public $timestamp_removed;

    public function __construct()
    {
        Route4Me::setBaseUrl(Endpoint::WH_BASE_URL);
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
            'url' => Endpoint::VEHICLE_V4,
            'method' => 'GET',
            'query' => Route4Me::generateRequestParameters($allQueryFields, $params),
        ]);

        return $response;
    }

    public function getRandomVehicleId($page, $perPage)
    {
        $params = [
            'page' => isset($page) ? $page : 1,
            'perPage' => isset($perPage) ? $perPage : 10,
            'with_pagination' => true,
        ];

        $vehicles = $this->getVehicles($params);

        if (is_null($vehicles) || !isset($vehicles['data']) || sizeof($vehicles['data']) < 1) {
            return null;
        }

        $randomIndex = rand(0, sizeof($vehicles['data']) - 1);

        return $vehicles['data'][$randomIndex]['vehicle_id'];
    }

    /**
     * @deprecated 1.2.6
     * @see \Route4Me\V5\Vehicles\DataTypes\Vehicle::getVehicleById()
     */
    public function getVehicleByID($vehicleID)
    {
        $response = Route4Me::makeRequst([
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
        $vehicleID = isset($params->vehicle_id) ? $params->vehicle_id : null;

        $allBodyFields = Route4Me::getObjectProperties(new self(), ['vehicle_id']);

        $response = Route4Me::makeRequst([
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

        Route4Me::setBaseUrl(Endpoint::BASE_URL);

        $response = Route4Me::makeRequst([
            'url' => Endpoint::VEHICLE_V4_API,
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
        $vehicleID = isset($params->vehicle_id) ? $params->vehicle_id : null;

        $response = Route4Me::makeRequst([
            'url' => Endpoint::VEHICLE_V4 . '/' . $vehicleID,
            'method' => 'DELETE',
            'HTTPHEADER' => 'Content-Type: application/json',
        ]);

        return $response;
    }
}
