<?php

namespace Route4Me;

use Route4Me\Vehicles\Vehicle;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Example refers to creating a super-heavy class truck.

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

$vehicle = new Vehicle();

$vehicleParameters = Vehicle::fromArray([
    'vehicle_name'                      => 'Liebherr T 282B mining truck',
    'vehicle_alias'                     => 'Liebherr T 282B mining truck',
    'vehicle_vin'                       => '1NP5DB9X93N507873',
    'vehicle_license_plate'             => 'LMT8765',
    'license_start_date'                => '2008-04-12',
    'license_end_date'                  => '2020-08-16',
    'vehicle_model'                     => 'Liebherr T 282B',
    'vehicle_model_year'                => 2004,
    'vehicle_year_acquired'             => 2008,
    'vehicle_reg_country_id'            => '223',
    'vehicle_type_id'                   => 'bigrig',
    'has_trailer'                       => false,
    'vehicle_axle_count'                => 2,
    'mpg_city'                          => 2,
    'mpg_highway'                       => 4,
    'fuel_type'                         => 'diesel',
    'height_inches'                     => 596,
    'height_metric'                     => 1490,
    'weight_lb'                         => 1316000,
    'maxWeightPerAxleGroupInPounds'     => 658000,
    'max_weight_per_axle_group_metric'  => 298450,
    'widthInInches'                     => 381,
    'width_metric'                      => 952,
    'lengthInInches'                    => 613,
    'length_metric'                     => 1532,
    'Use53FootTrailerRouting'           => 'YES',
    'UseTruckRestrictions'              => 'YES',
    'DividedHighwayAvoidPreference'     => 'STRONG_AVOID',
    'FreewayAvoidPreference'            => 'STRONG_AVOID',
    'truck_config'                      => '53_SEMI_TRAILER',
    'InternationalBordersOpen'          => 'YES',
    'purchased_new'                     => true,
]);

$result = $vehicle->createVehicle($vehicleParameters);

assert(!is_null($result), "Cannot update the vehicle");

Route4Me::simplePrint($result);
