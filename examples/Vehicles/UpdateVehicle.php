<?php
namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Route4Me;
use Route4Me\Vehicle;

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Example refers to updating a vehicle.

// Set the api key in the Route4me class
Route4Me::setApiKey('11111111111111111111111111111111');

$vehicle = new Vehicle();

// Get a random vehicle ID
$randomVehicleID = $vehicle->getRandomVehicleId(1, 20);
assert(!is_null($randomVehicleID), "Can't retrieve a random vehilce ID");

// Update the vehicle
$vehicleParameters = Vehicle::fromArray(array (
    'vehicle_id'             => $randomVehicleID,
    'vehicle_model_year'     => 2013,
    'vehicle_year_acquired'  => 2016,
    'vehicle_reg_country_id' => '223',
    'vehicle_make'           => 'Ford',
    'vehicle_axle_count'     => 3,
    'mpg_city'               => 11,
    'mpg_highway'            => 17,
    'fuel_type'              => 'unleaded 93',
    'height_inches'          => 74,
    'weight_lb'              => 2098
));

$result = $vehicle->updateVehicle($vehicleParameters);

assert(!is_null($result), "Can't update the vehilce");

Route4Me::simplePrint($result);
