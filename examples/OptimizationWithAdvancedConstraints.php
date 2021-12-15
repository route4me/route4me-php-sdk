<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../');
require $root.'/vendor/autoload.php';

use Route4Me\Enum\OptimizationType;
use Route4Me\Enum\AlgorithmType;
use Route4Me\Enum\DistanceUnit;
use Route4Me\Enum\DeviceType;
use Route4Me\Enum\Metric;

// The example requires an API key with the enterprise subscription.

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

// Huge list of addresses
$json = json_decode(file_get_contents('./addresses_adv_constr.json'), true);

$addresses = [];
foreach ($json as $address) {
    $addresses[] = Address::fromArray($address);
}

$depots = [
    Address::fromArray([
        'alias'     => 'Start Depot',
        'address'   => '1 MIAD Terminal J 2nd Floor, Miami,FL, (305) 876-0980',
        'lat'       => 25.774254,
        'lng'       => -80.190211
    ])
];

$parameters = RouteParameters::fromArray([
    'algorithm_type'    => Algorithmtype::ADVANCED_CVRP_TW,
    'route_name'        => 'Optimization With Same Last Location '.date('Y-m-d H:i:s', time()),
    'route_date'        => time() + 24 * 60 * 60,
    'route_time'        => 6 * 3600,
    'distance_unit'     => DistanceUnit::MILES,
    'device_type'       => DeviceType::WEB,
    'optimize'          => OptimizationType::DISTANCE,
    'advanced_constraints'  => [
        [
            'location_sequence_pattern' => [
                '',
                [
                    'alias'     => 'End Depot',
                    'address'   => '9681 SW 72nd St, Miami,FL, (305) 598-4933',
                    'lng'       => -80.34972,
                    'lat'       => 25.70185
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
