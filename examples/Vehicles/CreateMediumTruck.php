<?php
namespace Route4Me;

$root=realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Route4Me;
use Route4Me\Vehicle;

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Example refers to creating a medium class truck.

// Set the api key in the Route4me class
Route4Me::setApiKey('11111111111111111111111111111111');

$vehicle = new Vehicle();

$vehicleParameters = Vehicle::fromArray(array (
    'vehicle_alias'                    => 'GMC TopKick C5500 Medium',
    'vehicle_vin'                      => 'SAJXA01A06FN08012',
    'vehicle_license_plate'            => 'CVH4561',
    'vehicle_model'                    => 'TopKick C5500',
    'vehicle_model_year'               => 1995,
    'vehicle_year_acquired'            => 2008,
    'vehicle_reg_country_id'           => '223',
    'vehicle_make'                     => 'GMC',
    'vehicle_type_id'                  => 'pickup_truck',
    'vehicle_axle_count'               => 2,
    'mpg_city'                         => 7,
    'mpg_highway'                      => 14,
    'fuel_type'                        => 'diesel',
    'height_inches'                    => 97,
    'height_metric'                    => 243,
    'weight_lb'                        => 19000,
    'maxWeightPerAxleGroupInPounds'    => 9500,
    'max_weight_per_axle_group_metric' => 4300,
    'widthInInches'                    => 96,
    'width_metric'                     => 240,
    'lengthInInches'                   => 244,
    'length_metric'                    => 610,
    'Use53FootTrailerRouting'          => 'YES',
    'UseTruckRestrictions'             => 'YES',
    'DividedHighwayAvoidPreference'    => 'NEUTRAL',
    'FreewayAvoidPreference'           => 'NEUTRAL',
    'truck_config'                     => 'FULLSIZEVAN',
));

$result = $vehicle->createVehicle($vehicleParameters);

assert(!is_null($result), "Can't update the vehilce");

Route4Me::simplePrint($result);
