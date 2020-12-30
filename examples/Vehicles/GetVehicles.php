<?php

namespace Route4Me;

use Route4Me\Vehicles\Vehicle;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// Example refers to getting all vehicles.

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

$vehicle = new Vehicle();

$vehicleParameters = [
        'with_pagination'   => true,
        'page'              => 2,
        'perPage'           => 10,
    ];

$response = $vehicle->getVehicles($vehicleParameters);

foreach ($response['data'] as $key => $vehicle) {
    Route4Me::simplePrint($vehicle);
    echo '<br>';
}
