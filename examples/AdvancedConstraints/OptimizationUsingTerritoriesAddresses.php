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
    'rt'                => true,
    'algorithm_type'    => Algorithmtype::ADVANCED_CVRP_TW,
    'route_name'        => 'Single Depot, Multiple Driver - 3 Territories IDs '.date('Y-m-d H:i:s', time()),
    'route_time'        => 46800,
    'distance_unit'     => DistanceUnit::MILES,
    'device_type'       => DeviceType::WEB,
    'optimize'          => OptimizationType::DISTANCE,
    'travel_mode'       => TravelMode::DRIVING,
    'advanced_constraints'=> [
        [
            'max_cargo_volume' =>  0.0,
            'members_count' =>  3,
            'available_time_windows' =>  [
                [
                    46800,
                    57600
                ]
            ],
            'tags' =>  [
                'A34BA30C717D1194FC0230252DF0C45C'
            ]
        ],
        [
            'max_cargo_volume' =>  0.0,
            'members_count' =>  4,
            'available_time_windows' =>  [
                [
                    46800,
                    61200
                ]
            ],
            'tags' =>  [
                'DA6A8F10313CCFEC843978FC065F235B'
            ]
        ],
        [
            'max_cargo_volume' =>  0.0,
            'members_count' =>  3,
            'available_time_windows' =>  [
                [
                    46800,
                    64800
                ]
            ],
            'tags' =>  [
                '8142ABF2D693336987726ECDB5ED2D6D'
            ]
        ]
    ] 
   
]);

$addresses = [
    Address::fromArray([
        'contact_id' =>  39572676,
        'tags' =>  [
            'A34BA30C717D1194FC0230252DF0C45C'
        ]
    ]),
    Address::fromArray([
        'contact_id' =>  39581376,
        'tags' =>  [
            'A34BA30C717D1194FC0230252DF0C45C'
        ]
    ]),
    Address::fromArray([
        'contact_id' =>  39581377,
        'tags' =>  [
            'A34BA30C717D1194FC0230252DF0C45C'
        ]
    ]),
    Address::fromArray([
        'contact_id' =>  78214429,
        'tags' =>  [
            'A34BA30C717D1194FC0230252DF0C45C'
        ]
    ]),
    Address::fromArray([
        'contact_id' =>  78214430,
        'tags' =>  [
            'A34BA30C717D1194FC0230252DF0C45C'
        ]
    ]),
    Address::fromArray([
        'contact_id' =>  79640463,
        'tags' =>  [
            'A34BA30C717D1194FC0230252DF0C45C'
        ]
    ]),
    Address::fromArray([
        'contact_id' =>  79640464,
        'tags' =>  [
            'A34BA30C717D1194FC0230252DF0C45C'
        ]
    ]),
    Address::fromArray([
        'contact_id' =>  79686339,
        'tags' =>  [
            'A34BA30C717D1194FC0230252DF0C45C'
        ]
    ]),
    Address::fromArray([
        'contact_id' =>  79686340,
        'tags' =>  [
            'A34BA30C717D1194FC0230252DF0C45C'
        ]
    ]),
    Address::fromArray([
        'contact_id' =>  79686342,
        'tags' =>  [
            'A34BA30C717D1194FC0230252DF0C45C'
        ]
    ]),
    Address::fromArray([
        'contact_id' =>  79686343,
        'tags' =>  [
            'A34BA30C717D1194FC0230252DF0C45C'
        ]
    ]),
    Address::fromArray([
        'contact_id' =>  79686344,
        'tags' =>  [
            'A34BA30C717D1194FC0230252DF0C45C'
        ]
    ]),
    Address::fromArray([
        'contact_id' =>  79686345,
        'tags' =>  [
            'A34BA30C717D1194FC0230252DF0C45C'
        ]
    ]),
    Address::fromArray([
        'contact_id' =>  79686346,
        'tags' =>  [
            'A34BA30C717D1194FC0230252DF0C45C'
        ]
    ]),
    Address::fromArray([
        'contact_id' =>  79799829,
        'tags' =>  [
            'A34BA30C717D1194FC0230252DF0C45C'
        ]
    ]),
    Address::fromArray([
        'contact_id' =>  80186392,
        'tags' =>  [
            'A34BA30C717D1194FC0230252DF0C45C'
        ]
    ]),
    Address::fromArray([
        'contact_id' =>  80186404,
        'tags' =>  [
            'A34BA30C717D1194FC0230252DF0C45C'
        ]
    ]),
    Address::fromArray([
        'contact_id' =>  80189905,
        'tags' =>  [
            'A34BA30C717D1194FC0230252DF0C45C'
        ]
    ]),
    Address::fromArray([
        'contact_id' =>  80189907,
        'tags' =>  [
            'A34BA30C717D1194FC0230252DF0C45C'
        ]
    ]),
    Address::fromArray([
        'contact_id' =>  80281002,
        'tags' =>  [
            'A34BA30C717D1194FC0230252DF0C45C'
        ]
    ]),
    Address::fromArray([
        'contact_id' =>  81764287,
        'tags' =>  [
            'A34BA30C717D1194FC0230252DF0C45C'
        ]
    ]),
    Address::fromArray([
        'contact_id' =>  81764288,
        'tags' =>  [
            'A34BA30C717D1194FC0230252DF0C45C'
        ]
    ]),
    Address::fromArray([
        'contact_id' =>  81827204,
        'tags' =>  [
            'A34BA30C717D1194FC0230252DF0C45C'
        ]
    ]),
    Address::fromArray([
        'contact_id' =>  82206385,
        'tags' =>  [
            'A34BA30C717D1194FC0230252DF0C45C'
        ]
    ]),
    Address::fromArray([
        'contact_id' =>  82207302,
        'tags' =>  [
            'A34BA30C717D1194FC0230252DF0C45C'
        ]
    ]),
    Address::fromArray([
        'contact_id' =>  53080734,
        'tags' =>  [
            'A34BA30C717D1194FC0230252DF0C45C'
        ]
    ]),
    Address::fromArray([
        'contact_id' =>  53080735,
        'tags' =>  [
            'A34BA30C717D1194FC0230252DF0C45C'
        ]
    ]),
    Address::fromArray([
        'contact_id' =>  53080736,
        'tags' =>  [
            'A34BA30C717D1194FC0230252DF0C45C'
        ]
    ]),
    Address::fromArray([
        'contact_id' =>  53080738,
        'tags' =>  [
            'A34BA30C717D1194FC0230252DF0C45C'
        ]
    ]),
    Address::fromArray([
        'contact_id' =>  53080740,
        'tags' =>  [
            'A34BA30C717D1194FC0230252DF0C45C'
        ]
    ]),
    Address::fromArray([
        'contact_id' =>  53080742,
        'tags' =>  [
            'A34BA30C717D1194FC0230252DF0C45C'
        ]
    ]),
    Address::fromArray([
        'contact_id' =>  79686342,
        'tags' =>  [
            'DA6A8F10313CCFEC843978FC065F235B'
        ]
    ]),
    Address::fromArray([
        'contact_id' =>  79686343,
        'tags' =>  [
            'DA6A8F10313CCFEC843978FC065F235B'
        ]
    ]),
    Address::fromArray([
        'contact_id' =>  79686344,
        'tags' =>  [
            'DA6A8F10313CCFEC843978FC065F235B'
        ]
    ]),
    Address::fromArray([
        'contact_id' =>  79686345,
        'tags' =>  [
            'DA6A8F10313CCFEC843978FC065F235B'
        ]
    ]),
    Address::fromArray([
        'contact_id' =>  79686346,
        'tags' =>  [
            'DA6A8F10313CCFEC843978FC065F235B'
        ]
    ]),
    Address::fromArray([
        'contact_id' =>  79686342,
        'tags' =>  [
            '8142ABF2D693336987726ECDB5ED2D6D'
        ]
    ]),
    Address::fromArray([
        'contact_id' =>  79686343,
        'tags' =>  [
            '8142ABF2D693336987726ECDB5ED2D6D'
        ]
    ]),
    Address::fromArray([
        'contact_id' =>  79686344,
        'tags' =>  [
            '8142ABF2D693336987726ECDB5ED2D6D'
        ]
    ]),
    Address::fromArray([
        'contact_id' =>  79686345,
        'tags' =>  [
            '8142ABF2D693336987726ECDB5ED2D6D'
        ]
    ]),
    Address::fromArray([
        'contact_id' =>  79686346,
        'tags' =>  [
            '8142ABF2D693336987726ECDB5ED2D6D'
        ]
    ])
];

$optimizationParams = new OptimizationProblemParams();
$optimizationParams->setAddresses($addresses);
$optimizationParams->setParameters($parameters);

$problem = OptimizationProblem::optimize($optimizationParams);

echo Route4Me::object2json($problem);
