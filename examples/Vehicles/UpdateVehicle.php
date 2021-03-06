<?php

namespace Route4Me;

use Route4Me\Vehicles\Vehicle;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Example refers to updating a vehicle.

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

$vehicle = new VehicleV4();

// Get a random vehicle ID
$randomVehicleID = $vehicle->getRandomVehicleId(1, 20);
assert(!is_null($randomVehicleID), "Cannot retrieve a random vehicle ID");

// Update the vehicle
$vehicleParameters = Vehicle::fromArray([
    'vehicle_id'                => $randomVehicleID,
    'vehicle_model_year'        => 2013,
    'vehicle_year_acquired'     => 2016,
    'vehicle_reg_country_id'    => '223',
    'vehicle_make'              => 'Ford',
    'vehicle_axle_count'        => 3,
    'fuel_type'                 => 'unleaded 93',
    'height_inches'             => 74,
    'weight_lb'                 => 2098,
]);

$result = $vehicle->updateVehicle($vehicleParameters);

assert(!is_null($result), "Cannot update the vehicle");

Route4Me::simplePrint($result);
