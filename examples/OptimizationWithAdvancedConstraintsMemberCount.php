<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../');
require $root.'/vendor/autoload.php';

use Route4Me\Enum\OptimizationType;
use Route4Me\Enum\AlgorithmType;
use Route4Me\Enum\DistanceUnit;
use Route4Me\Enum\DeviceType;
use Route4Me\Enum\Metric;
use Route4Me\Enum\TravelMode;

// The example requires an API key with the enterprise subscription.

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

// Huge list of addresses
$json = json_decode(file_get_contents('./addresses_adv_constr2.json'), true);

$addresses = [];
foreach ($json as $address) {
    $addresses[] = Address::fromArray($address);
}

$depots = [
    Address::fromArray([
        'alias'     => 'Start Depot',
        'is_depot'  => true,
        'address'   => '1 Fritz Sonnenberg Rd, Green Point, Cape Town, 8051, South Africa',
        'lat'       => -33.90410680000001,
        'lng'       => 18.4010964
    ])
];

$parameters = RouteParameters::fromArray([
    'rt'                => 0,
    'algorithm_type'    => Algorithmtype::ADVANCED_CVRP_TW,
    'route_name'        => 'Optimization With Same Last Location and Member Count '.date('Y-m-d H:i:s', time()),
    'route_date'        => time() + 24 * 60 * 60,
    'route_time'        => 6 * 3600,
    'distance_unit'     => DistanceUnit::MILES,
    'device_type'       => DeviceType::WEB,
    'optimize'          => OptimizationType::DISTANCE,
    'travel_mode'       => TravelMode::DRIVING,
    'route_max_duration' => 7200,
    'store_route'       => true,
    'parts'             => 2,
    'parts_min'         => 2,
    'advanced_constraints'  => [
        [
            'members_count' => 2,
            'location_sequence_pattern' => [
                '',
                [
                    'lat'       => -33.92136,
                    'lng'       => 18.4181938,
                    'is_depot'  => false,
                    'address'   => '105 Bree St, Cape Town City Centre, Cape Town, 8001, South Africa',
                    'order_id'  => 50,
                    'route_destination_id' => 736611941,
                ]
            ]
        ]
    ],
    
]);

$optimizationParams = new OptimizationProblemParams();
$optimizationParams->setAddresses($addresses);
$optimizationParams->setDepots($depots);
$optimizationParams->setParameters($parameters);

$problem = OptimizationProblem::optimize($optimizationParams);
echo "<pre>";
foreach ((array) $problem as $key => $value) {
    if (is_string($value)) {
        echo $key.' --> '.$value.'<br>';
    } else {
        echo "************ $key ************* <br>";
        Route4Me::simplePrint((array) $value, true);
        echo '******************************* <br>';
    }
}
echo "</pre>";
