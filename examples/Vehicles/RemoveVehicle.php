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

// Remove the vehicle
$vehicleParameters = Vehicle::fromArray(array (
    'vehicle_id'  => $randomVehicleID
));

$result = $vehicle->removeVehicle($vehicleParameters);

assert(!is_null($result), "Can't update the vehilce");

Route4Me::simplePrint($result);
