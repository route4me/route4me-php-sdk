<?php

//**********************************************************************
// Driver's Skills
//**********************************************************************

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Enum\OptimizationType;
use Route4Me\Enum\AlgorithmType;
use Route4Me\Enum\DistanceUnit;
use Route4Me\Enum\DeviceType;
use Route4Me\Enum\OptimizationStates;
use Route4Me\Enum\TravelMode;
use Route4Me\Members\Member;
use Route4Me\V5\Addresses\RouteAdvancedConstraints;

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

//**********************************************************************
// Get 3 members - drivers IDs
$member = new Member();
$response = $member->getUsers();

if ($response==NULL || !isset($response['results']) || sizeof($response['results'])<3) {
    echo "Cannot retrieve 3 members" . PHP_EOL;
    return;
}

$members = [
    $response['results'][0]['member_id'],
    $response['results'][1]['member_id'],
    $response['results'][2]['member_id']
];

//**********************************************************************
// General Route Parameters
$parameters = RouteParameters::fromArray([
    'rt' => true,
    'algorithm_type' => Algorithmtype::ADVANCED_CVRP_TW,
    'route_name' => 'Automatic Driver Skills Example - Single Depot, Multiple Driver '.date('Y-m-d H:i:s', time()),
    'route_time' => 0,
    'distance_unit' => DistanceUnit::MILES,
    'device_type' => DeviceType::WEB,
    'optimize' => OptimizationType::DISTANCE,
    'travel_mode' => TravelMode::DRIVING,
    'vehicle_capacity' => 100,
    'vehicle_max_distance_mi' => 10000,
    'route_max_duration' => 86400,
    'parts' => 20,
    'advanced_constraints'=> []
]);

//**********************************************************************
// Schedules
// Schedule 1
// Time Window Start:  2:00 am EST
// Time Window End:   16:00 am EST
$parameters->advanced_constraints[] = RouteAdvancedConstraints::fromArray([
    'max_cargo_volume' => 0.0,
    'max_capacity' => 200,
    'available_time_windows' => [[(2 + 5) * 3600 , (16 + 5) * 3600]],
    'route4me_members_id' => $members
]);

// Schedule 2
// Time Window Start:  8:00 am EST
// Time Window End:   19:00 am EST
$parameters->advanced_constraints[] = RouteAdvancedConstraints::fromArray([
    'max_cargo_volume' => 0.0,
    'max_capacity' => 500,
    'available_time_windows' => [[(8 + 5) * 3600 , (19 + 5) * 3600]],
    'route4me_members_id' => $members
]);

//**********************************************************************
// Addresses
$json = json_decode(file_get_contents(dirname(__FILE__).'/data/addresses_9.json'), true);

// Depot
$addresses[] = Address::fromArray([
    'address' => '1604 PARKRIDGE PKWY, Louisville, KY, 40214',
    'is_depot' => TRUE,
    'lat' => 38.141598,
    'lng' => -85.793846,
    'time' => 300
]);

// Stops
$n = 0;
foreach ($json as $address) {
    $addr_obj = Address::fromArray([
        'address' => $address['address'],
        'lat' => $address['lat'],
        'lng' => $address['lng'],
        'time' => $address['time'],
        'tags' => [($n < 4 ? 'Class A CDL' : 'Class B CDL')]
    ]);

    if($n >= 4)
    {
        $addr_obj->time_window_start = $address['time_window_start'];
        $addr_obj->time_window_end = $address['time_window_end'];
    }
    $addresses[] = $addr_obj;
    ++$n;
}

$optimizationParams = new OptimizationProblemParams();
$optimizationParams->setAddresses($addresses);
$optimizationParams->setParameters($parameters);

$problem = OptimizationProblem::optimize($optimizationParams);

echo "Optimization Problem ID: " . $problem->optimization_problem_id . PHP_EOL;
echo "State: " . OptimizationStates::getName($problem->state) . " (" . $problem->state . ")" . PHP_EOL;

echo "Routes:" . PHP_EOL;
foreach($problem->routes as $route)
{
    echo "\tID: " . $route->route_id . PHP_EOL;
    echo "\tDistance: " . $route->trip_distance . PHP_EOL;
    echo "\tAddresses:" . PHP_EOL;

    foreach($route->addresses as $address) echo "\t\t" . $address->address . PHP_EOL;
}
