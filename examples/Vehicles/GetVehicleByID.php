<?php

namespace Route4Me;

use Route4Me\Vehicles\Vehicle;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Example refers to getting a vehicle.

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

$vehicle = new Vehicle();

// Get a random vehicle ID
$randomVehicleID = $vehicle->getRandomVehicleId(1, 20);
assert(!is_null($randomVehicleID), "Cannot retrieve a random vehicle ID");

// Get a vehicle by ID
$vehicle = $vehicle->getVehicleByID($randomVehicleID);

Route4Me::simplePrint($vehicle);
