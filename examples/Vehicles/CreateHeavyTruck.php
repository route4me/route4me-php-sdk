<?php

namespace Route4Me;

use Route4Me\Vehicles\Vehicle;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Example refers to creating a heavy class truck.

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

$vehicle = new Vehicle();

$vehicleParameters = Vehicle::fromArray([
    'vehicle_name' => 'Peterbilt 579',
    'vehicle_alias' => 'Peterbilt 579',
    'vehicle_vin' => '1NP5DB9X93N507873',
    'vehicle_license_plate' => 'PPV7516',
    'license_start_date' => '2017-06-05',
    'license_end_date' => '2021-08-14',
    'vehicle_model' => '579',
    'vehicle_model_year' => 2015,
    'vehicle_year_acquired' => 2018,
    'vehicle_reg_country_id' => '223',
    'vehicle_make' => 'Peterbilt',
    'vehicle_type_id' => 'tractor_trailer',
    'has_trailer' => true,
    'vehicle_axle_count' => 4,
    'mpg_city' => 6,
    'mpg_highway' => 12,
    'fuel_type' => 'diesel',
    'height_inches' => 114,
    'height_metric' => 290,
    'weight_lb' => 50350,
    'maxWeightPerAxleGroupInPounds' => 40000,
    'max_weight_per_axle_group_metric' => 18000,
    'widthInInches' => 102,
    'width_metric' => 258,
    'lengthInInches' => 640,
    'length_metric' => 1625,
    'Use53FootTrailerRouting' => 'YES',
    'UseTruckRestrictions' => 'YES',
    'DividedHighwayAvoidPreference' => 'STRONG_AVOID',
    'FreewayAvoidPreference' => 'STRONG_AVOID',
    'truck_config' => '53_SEMI_TRAILER',
    'InternationalBordersOpen' => 'YES',
    'purchased_new' => true,
]);

$result = $vehicle->createVehicle($vehicleParameters);

assert(!is_null($result), "Cannot update the vehicle");

Route4Me::simplePrint($result);
