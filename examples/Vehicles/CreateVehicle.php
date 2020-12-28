<?php

namespace Route4Me;

use Route4Me\Vehicles\Vehicle;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Example refers to creating a vehicle.

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

$vehicle = new Vehicle();

$vehicleParameters = Vehicle::fromArray([
    'vehicle_name'              => 'Ford Transit Test 4',
    'vehicle_alias'             => 'Ford Transit Test 4',
    'vehicle_vin'               => 'JS3TD62V1Y4107898',
    'vehicle_reg_country_id'    => '223',
    'vehicle_make'              => 'Ford',
    'vehicle_model_year'        => 2013,
    'vehicle_axle_count'        => 2,
    'mpg_city'                  => 8,
    'mpg_highway'               => 14,
    'fuel_type'                 => 'unleaded 93',
    'height_inches'             => 72,
    'weight_lb'                 => 2000,
]);

$result = $vehicle->createVehicle($vehicleParameters);

assert(!is_null($result), "Cannot update the vehicle");

Route4Me::simplePrint($result);
