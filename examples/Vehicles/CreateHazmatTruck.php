<?php
namespace Route4Me;

$root=realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Route4Me;
use Route4Me\Vehicle;

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Example refers to creating a hazmat class truck.

// Set the api key in the Route4me class
Route4Me::setApiKey('11111111111111111111111111111111');

$vehicle = new Vehicle();

$vehicleParameters = Vehicle::fromArray(array (
    'vehicle_alias'                    => 'ISUZU FTR',
    'vehicle_vin'                      => '1NP5DB9X93N507873',
    'vehicle_license_plate'            => 'IFT6253',
    'license_start_date'               => '2008-05-14',
    'license_end_date'                 => '2020-09-24',
    'vehicle_model'                    => 'FTR',
    'vehicle_model_year'               => 2008,
    'vehicle_year_acquired'            => 2008,
    'vehicle_reg_country_id'           => '223',
    'vehicle_type_id'                  => 'bigrig',
    'has_trailer'                      => false,
    'vehicle_axle_count'               => 2,
    'mpg_city'                         => 5,
    'mpg_highway'                      => 15,
    'fuel_type'                        => 'diesel',
    'height_inches'                    => 112,
    'height_metric'                    => 280,
    'weight_lb'                        => 25950,
    'maxWeightPerAxleGroupInPounds'    => 19000,
    'max_weight_per_axle_group_metric' => 8620,
    'widthInInches'                    => 94,
    'width_metric'                     => 235,
    'lengthInInches'                   => 384,
    'length_metric'                    => 960,
    'Use53FootTrailerRouting'          => 'NO',
    'UseTruckRestrictions'             => 'YES',
    'DividedHighwayAvoidPreference'    => 'NEUTRAL',
    'FreewayAvoidPreference'           => 'NEUTRAL',
    'TollRoadUsage'                    => 'ALWAYS_AVOID',
    'truck_config'                     => '26_STRAIGHT_TRUCK',
    'InternationalBordersOpen'         => 'YES',
    'purchased_new'                    => true,
    'HazmatType'                       => 'FLAMMABLE'
));

$result = $vehicle->createVehicle($vehicleParameters);

assert(!is_null($result), "Can't update the vehilce");

Route4Me::simplePrint($result);
