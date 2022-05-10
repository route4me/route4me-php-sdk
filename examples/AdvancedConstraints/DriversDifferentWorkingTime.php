<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\Enum\OptimizationType;
use Route4Me\Enum\AlgorithmType;
use Route4Me\Enum\DistanceUnit;
use Route4Me\Enum\DeviceType;
use Route4Me\Enum\TravelMode;
use Route4Me\Enum\Metric;

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

$depots = [
    Address::fromArray([
        'alias'     => 'Start Depot',
        'address'   => '1604 PARKRIDGE PKWY, Louisville, KY, 40214',
        'lat'       => 38.141598,
        'lng'       => -80.190211
    ])
];

$parameters = RouteParameters::fromArray([
    'algorithm_type'    => Algorithmtype::ADVANCED_CVRP_TW,
    'route_name'        => 'Drivers Different Working Time Example - Single Depot, Multiple Driver '.date('Y-m-d H:i:s', time()),
    'route_date'        => time() + 24 * 60 * 60,
    'route_time'        => 6 * 3600,
    'distance_unit'     => DistanceUnit::MILES,
    'device_type'       => DeviceType::WEB,
    'optimize'          => OptimizationType::DISTANCE,
    'travel_mode'       => TravelMode::DRIVING,
    'route_max_duration' => 8 * 60 * 60,
    'parts'             => 8,
    'advanced_constraints'=> [
        [
            'max_cargo_volume'      => 0.0,
            'members_count'         => 4,
            'available_time_windows'=> [
                [
                    43200,
                    72000
                ]
            ]
        ],
        [
            'max_cargo_volume'      => 0.0,
            'members_count'         => 2,
            'available_time_windows'=> [
                [
                    43200,
                    57600
                ]
            ]
        ]
    ] 
   
]);

$addresses = [
    Address::fromArray([
        'address'   =>  '1407 MCCOY, Louisville, KY, 40215',
        'lat'       =>  38.202496,
        'lng'       =>  -85.786514,
        'time'      =>  3600
    ]),
    Address::fromArray([
        'address'   =>  '730 CECIL AVENUE, Louisville, KY, 40211',
        'lat'       =>  38.248684,
        'lng'       =>  -85.821121,
        'time'      =>  3600
    ]),
    Address::fromArray([
        'address'   =>  '4629 HILLSIDE DRIVE, Louisville, KY, 40216',
        'lat'       =>  38.176067,
        'lng'       =>  -85.824638,
        'time'      =>  3600
    ]),
    Address::fromArray([
        'address'   =>  '318 SO. 39TH STREET, Louisville, KY, 40212',
        'lat'       =>  38.259335,
        'lng'       =>  -85.815094,
        'time'      =>  3600
    ]),
    Address::fromArray([
        'address'   =>  '1324 BLUEGRASS AVE, Louisville, KY, 40215',
        'lat'       =>  38.179253,
        'lng'       =>  -85.785118,
        'time'      =>  3600
    ]),
    Address::fromArray([
        'address'   =>  '7305 ROYAL WOODS DR, Louisville, KY, 40214',
        'lat'       =>  38.162472,
        'lng'       =>  -85.792854,
        'time'      =>  3600
    ]),
    Address::fromArray([
        'address'   =>  '4738 BELLEVUE AVE, Louisville, KY, 40215',
        'lat'       =>  38.179806,
        'lng'       =>  -85.775558,
        'time'      =>  3600
    ]),
    Address::fromArray([
        'address'   =>  '4805 BELLEVUE AVE, Louisville, KY, 40215',
        'lat'       =>  38.178844,
        'lng'       =>  -85.774864,
        'time'      =>  3600
    ]),
    Address::fromArray([
        'address'   =>  '650 SOUTH 29TH ST UNIT 315, Louisville, KY, 40211',
        'lat'       =>  38.251923,
        'lng'       =>  -85.800034,
        'time'      =>  3600
    ])
];

$optimizationParams = new OptimizationProblemParams();
$optimizationParams->setAddresses($addresses);
$optimizationParams->setDepots($depots);
$optimizationParams->setParameters($parameters);

$problem = OptimizationProblem::optimize($optimizationParams);

echo Route4Me::object2json($problem);

