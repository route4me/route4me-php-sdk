<?php

namespace Route4Me\V5\Vehicles\DataTypes;

use Route4Me\Common as Common;
use Route4Me\Route4Me as Route4Me;
use Route4Me\V5\Enum\Endpoint as Endpoint;

/**
 * Class VehicleProfile.
 */
class VehicleProfile extends Common
{
    /** Vehicle profile ID.
     * @var int
     */
    public $vehicle_profile_id;

    /** Root member ID.
     * @var int
     */
    public $root_member_id;

    /** Vehicle profile name.
     * @var string
     */
    public $name;

    /** Vehicle height.
     * @var float
     */
    public $height;

    /** Vehicle width.
     * @var float
     */
    public $width;

    /** Vehicle length.
     * @var float
     */
    public $length;

    /** Vehicle weight.
     * @var float
     */
    public $weight;

    /** Maximum weight per axle.
     * @var float
     */
    public $max_weight_per_axle;

    /** When the profile deleted.
     * @var string
     */
    public $deleted_at;

    /** When the profile created.
     * @var string
     */
    public $created_at;

    /** When the profile updated.
     * @var string
     */
    public $updated_at;

    /** A type of the fuel
     * enum: ['unleaded 87','unleaded 89','unleaded 91',
     * 'unleaded 93','diesel','electric','hybrid'].
     * @var string
     */
    public $fuel_type;

    /** Fuel consumption city.
     * @var float
     */
    public $fuel_consumption_city;

    /** Fuel consumption in the highway area.
     * @var float
     */
    public $fuel_consumption_highway;

    /** Type of a hazardous material.
     * enum: ['general', 'explosives', 'flammable', 'inhalants', 'caustic', 'radioactive'].
     * @var string
     */
    public $hazmat_type;

    /** If true, the profile is predefined.
     * @var bool
     */
    public $is_predefined;

    /** If true, the profile is default.
     * @var bool
     */
    public $is_default;

    /** Height units (e.g. 'ft', 'm').
     * @var string
     */
    public $height_units;

    /** Width units (e.g. 'ft', 'm').
     * @var string
     */
    public $width_units;

    /** Length units (e.g. 'ft', 'm').
     * @var string
     */
    public $length_units;

    /** Weight units (e.g. 'lb', 'kg').
     * @var string
     */
    public $weight_units;

    /** Maximum weight per axle units (e.g. 'lb', 'kg').
     * @var string
     */
    public $max_weight_per_axle_units;

    /** Fuel consumption units in the city area (e.g. mpg).
     * @var string
     */
    public $fuel_consumption_city_unit;

    /** Fuel consumption units in the highway area (e.g. mpg).
     * @var string
     */
    public $fuel_consumption_highway_unit;

    /** Height UF value (e.g. "7'").
     * @var string
     */
    public $height_uf_value;

    /** Width UF value (e.g. "8'").
     * @var string
     */
    public $width_uf_value;

    /** Length UF value (e.g. "20'").
     * @var string
     */
    public $length_uf_value;

    /** Weight UF value (e.g. "8,500lb").
     * @var string
     */
    public $weight_uf_value;

    /** Maximum weight per axle (UF value, e.g. "8,500lb").
     * @var string
     */
    public $max_weight_per_axle_uf_value;

    /** Fuel consumption city (UF value, e.g. "20.01 mi/l").
     * @var string
     */
    public $fuel_consumption_city_uf_value;

    /** Fuel consumption highway (UF value, e.g. "2,000.01 mpg").
     * @var string
     */
    public $fuel_consumption_highway_uf_value;

    public static function fromArray(array $params)
    {
        $vehicleProfile = new self();

        foreach ($params as $key => $value) {
            if (is_null(Common::getValue($params, $key))) {
                continue;
            }
            if (property_exists($vehicleProfile, $key)) {
                $vehicleProfile->$key = $value;
            }
        }

        return $vehicleProfile;
    }

    public function __construct()
    {
        Route4Me::setBaseUrl('');
    }

    public function removeVehicleProfile($vehicleProfileId)
    {
        //$vehicleProfileID = isset($params['vehicle_profile_id']) ? $params['vehicle_profile_id'] : null;

        $response = Route4Me::makeRequst([
            'url' => Endpoint::VehicleProfiles . '/' . $vehicleProfileId,
            'method' => 'DELETE',
            'HTTPHEADER' => 'Content-Type: application/json; Accept: application/json',
        ]);

        return $response;
    }

    /**
     * @param  $profileParams - an array from the VehicleParameters object.
     * @return array          - an array of parameters of the vehicle profiles.
     * @throws \Route4Me\Exception\ApiError
     */
    public function getVehicleProfiles($profileParams)
    {
        $allQueryFields = ['with_pagination', 'page', 'perPage'];

        $response = Route4Me::makeRequst([
            'url' => Endpoint::VehicleProfiles,
            'method' => 'GET',
            'query' => Route4Me::generateRequestParameters($allQueryFields, $profileParams),
        ]);

        return $response;
    }

    /**
     * @param $profileParams - Vehicle profile body parameters
     * @return array         - Created vehicle profile
     * @throws \Route4Me\Exception\ApiError
     */
    public function createVehicleProfile($profileParams)
    {
        $excludeFields = [];
        $allBodyFields = Route4Me::getObjectProperties(new VehicleProfile(), $excludeFields);

        $response = Route4Me::makeRequst([
            'url' => Endpoint::VehicleProfiles,
            'method' => 'POST',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $profileParams),
            'HTTPHEADERS' => ['Content-Type: application/json', 'Accept: application/json'],
        ]);

        return $response;
    }

    public function getVehicleProfileById($vehicleProfileId)
    {
        $response = Route4Me::makeRequst([
            'url' => Endpoint::VehicleProfiles . '/' . $vehicleProfileId,
            'method' => 'GET',
        ]);

        return $response;
    }

    public function updateVehicleProfile($vehicleProfile)
    {
        $excludeFields = ['vehicle_profile_id', 'deleted_at', 'created_at', 'updated_at'];
        $allBodyFields = Route4Me::getObjectProperties(new self(), $excludeFields);

        $response = Route4Me::makeRequst([
            'url' => Endpoint::VehicleProfiles . '/' . $vehicleProfile['vehicle_profile_id'],
            'method' => 'PATCH',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $vehicleProfile),
            'HTTPHEADER' => 'Content-Type: application/json',
        ]);

        return $response;
    }
}
