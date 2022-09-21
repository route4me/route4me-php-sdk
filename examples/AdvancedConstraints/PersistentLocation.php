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
use Route4Me\Members\Member;

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

$parameters = RouteParameters::fromArray([
    'rt'                => false,
    'algorithm_type'    => Algorithmtype::ADVANCED_CVRP_TW,
    'route_name'        => 'Persistent Location - Single Depot - Multiple Driver '.date('Y-m-d H:i:s', time()),
    'route_time'        => 25200,
    'distance_unit'     => DistanceUnit::MILES,
    'device_type'       => DeviceType::WEB,
    'optimize'          => OptimizationType::DISTANCE,
    'travel_mode'       => TravelMode::DRIVING,
    'advanced_constraints'=> [
        [
            'max_cargo_volume' =>  0.0,
            'max_capacity' =>  200,
            'members_count' =>  10,
            'available_time_windows' =>  [
                [
                    25200,
                    75000
                ]
            ],
            'location_sequence_pattern' =>  [
                '',
                [
                    'alias' =>  'DEPOT END LOCATION',
                    'address' =>  '4738 BELLEVUE AVE, Louisville, KY, 40215',
                    'lat' =>  38.179806,
                    'lng' =>  -85.775558,
                    'time' =>  300
                ]
            ]
        ],
        [
            'max_cargo_volume' =>  0.0,
            'max_capacity' =>  200,
            'members_count' =>  10,
            'available_time_windows' =>  [
                [
                    45200,
                    95000
                ]
            ],
            'location_sequence_pattern' =>  [
                '',
                [
                    'alias' =>  'DEPOT END LOCATION',
                    'address' =>  '4738 BELLEVUE AVE, Louisville, KY, 40215',
                    'lat' =>  38.179806,
                    'lng' =>  -85.775558,
                    'time' =>  300
                ]
            ]
        ]
    ] 
   
]);

$addresses = [
    Address::fromArray([
        'address' =>  '1604 PARKRIDGE PKWY, Louisville, KY, 40214',
        'is_depot' =>  true,
        'lat' =>  38.141598,
        'lng' =>  -85.793846,
        'time' =>  300
    ]),
    Address::fromArray([
        'address' =>  '1407 MCCOY, Louisville, KY, 40215',
        'lat' =>  38.202496,
        'lng' =>  -85.786514,
        'time' =>  300
    ]),
    Address::fromArray([
        'address' =>  '4805 BELLEVUE AVE, Louisville, KY, 40215',
        'lat' =>  38.178844,
        'lng' =>  -85.774864,
        'time' =>  300
    ]),
    Address::fromArray([
        'address' =>  '730 CECIL AVENUE, Louisville, KY, 40211',
        'lat' =>  38.248684,
        'lng' =>  -85.821121,
        'time' =>  300
    ]),
    Address::fromArray([
        'address' =>  '650 SOUTH 29TH ST UNIT 315, Louisville, KY, 40211',
        'lat' =>  38.251923,
        'lng' =>  -85.800034,
        'time' =>  300
    ]),
    Address::fromArray([
        'address' =>  '4629 HILLSIDE DRIVE, Louisville, KY, 40216',
        'lat' =>  38.176067,
        'lng' =>  -85.824638,
        'time' =>  300
    ]),
    Address::fromArray([
        'address' =>  '318 SO. 39TH STREET, Louisville, KY, 40212',
        'lat' =>  38.259335,
        'lng' =>  -85.815094,
        'time' =>  300
    ]),
    Address::fromArray([
        'address' =>  '1324 BLUEGRASS AVE, Louisville, KY, 40215',
        'lat' =>  38.179253,
        'lng' =>  -85.785118,
        'time' =>  300
    ]),
    Address::fromArray([
        'address' =>  '7305 ROYAL WOODS DR, Louisville, KY, 40214',
        'lat' =>  38.162472,
        'lng' =>  -85.792854,
        'time' =>  300
    ])
];

$optimizationParams = new OptimizationProblemParams();
$optimizationParams->setAddresses($addresses);
$optimizationParams->setParameters($parameters);

$problem = OptimizationProblem::optimize($optimizationParams);

echo Route4Me::object2json($problem);
