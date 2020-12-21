<?php

namespace Route4Me;

use Route4Me\Vehicles\Vehicle;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Example refers to removing a vehicle.

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

$vehicle = new Vehicle();

// Get a random vehicle ID
$randomVehicleID = $vehicle->getRandomVehicleId(1, 20);
assert(!is_null($randomVehicleID), "Cannot retrieve a random vehicle ID");

// Remove the vehicle
$vehicleParameters = Vehicle::fromArray([
    'vehicle_id' => $randomVehicleID,
]);

$result = $vehicle->removeVehicle($vehicleParameters);

assert(!is_null($result), "Cannot update the vehicle");

Route4Me::simplePrint($result);
