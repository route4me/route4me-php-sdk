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

$parameters = RouteParameters::fromArray([
    'rt'                => true,
    'algorithm_type'    => Algorithmtype::ADVANCED_CVRP_TW,
    'route_name'        => '12 Drivers Schedules '.date('Y-m-d H:i:s', time()),
    'distance_unit'     => DistanceUnit::MILES,
    'device_type'       => DeviceType::WEB,
    'optimize'          => OptimizationType::DISTANCE,
    'travel_mode'       => TravelMode::DRIVING,
    'parts'             => 12,
    'advanced_constraints'=> [
        [
            'max_cargo_volume'       => 0.0,
            'members_count'          => 1,
            'available_time_windows' => [
                [
                    50400,
                    64800
                ]
            ],
            'tags' => [
                'ZONE 03'
            ]
        ],
        [
            'max_cargo_volume'       => 0.0,
            'members_count'          => 1,
            'available_time_windows' => [
                [
                    54000,
                    75600
                ]
            ],
            'tags' =>  [
                'ZONE 04'
            ]
        ],
        [
            'max_cargo_volume'       =>  0.0,
            'members_count'          =>  1,
            'available_time_windows' =>  [
                [
                    57600,
                    72000
                ]
            ],
            'tags' =>  [
                'ZONE 03'
            ]
        ],
        [
            'max_cargo_volume'       =>  0.0,
            'members_count'          =>  1,
            'available_time_windows' =>  [
                [
                    57600,
                    75600
                ]
            ],
            'tags' =>  [
                'ZONE 03'
            ]
        ],
        [
            'max_cargo_volume'       =>  0.0,
            'members_count'          =>  1,
            'available_time_windows' =>  [
                [
                    54000,
                    68400
                ]
            ],
            'tags' =>  [
                'ZONE 03'
            ]
        ],
        [
            'max_cargo_volume'       =>  0.0,
            'members_count'          =>  1,
            'available_time_windows' =>  [
                [
                    54000,
                    75600
                ]
            ],
            'tags' =>  [
                'ZONE 02'
            ]
        ],
        [
            'max_cargo_volume'       =>  0.0,
            'members_count'          =>  1,
            'available_time_windows' =>  [
                [
                    54000,
                    68400
                ]
            ],
            'tags' =>  [
                'ZONE 05'
            ]
        ],
        [
            'max_cargo_volume'       =>  0.0,
            'members_count'          =>  1,
            'available_time_windows' =>  [
                [
                    57600,
                    79200
                ]
            ],
            'tags' =>  [
                'ZONE 03'
            ]
        ],
        [
            'max_cargo_volume'       =>  0.0,
            'members_count'          =>  1,
            'available_time_windows' =>  [
                [
                    43200,
                    57600
                ]
            ],
            'tags' =>  [
                'ZONE 03'
            ]
        ],
        [
            'max_cargo_volume'       =>  0.0,
            'members_count'          =>  1,
            'available_time_windows' =>  [
                [
                    57600,
                    79200
                ]
            ],
            'tags' =>  [
                'ZONE 05'
            ]
        ],
        [
            'max_cargo_volume'       =>  0.0,
            'members_count'          =>  1,
            'available_time_windows' =>  [
                [
                    50400,
                    64800
                ]
            ],
            'tags' =>  [
                'ZONE 04'
            ]
        ],
        [
            'max_cargo_volume'       =>  0.0,
            'members_count'          =>  1,
            'available_time_windows' =>  [
                [
                    43200,
                    61200
                ]
            ],
            'tags' =>  [
                'ZONE 04'
            ]
        ]
    ] 
   
]);

$addresses = [
    Address::fromArray([
        'alias'     => 'DEPOT',
        'address'   => 'DEPOT',
        'is_depot'  => true,
        'lat'       => 25.694341,
        'lng'       => -80.166036,
        'time'      => 0
    ]),
    Address::fromArray([
        'alias'     => '2505',
        'address'   => '2505',
        'lat'       => 25.767596,
        'lng'       => -80.226998,
        'tags' 		=> [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'alias'     => '2687',
        'address'   => '2687',
        'lat'       => 25.786497,
        'lng'       => -80.207408,
        'tags' 		=> [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'alias'     => '472',
        'address'   => '472',
        'lat'       => 25.66043,
        'lng'       => -80.417161,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1235',
        'address'   => '1235',
        'lat'       => 25.688111,
        'lng'       => -80.456527,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '2849',
        'address'   => '2849',
        'lat'       => 25.839934,
        'lng'       => -80.189969,
        'tags' 		=> [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'alias'     => '887',
        'address'   => '887',
        'lat'       => 25.755872,
        'lng'       => -80.419184,
        'tags' 		=> [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'alias'     => '2584',
        'address'   => '2584',
        'lat'       => 25.720941,
        'lng'       => -80.289537,
        'tags' 		=> [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'alias'     => '2750',
        'address'   => '2750',
        'lat'       => 25.837605,
        'lng'       => -80.294638,
        'tags' 		=> [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1018',
        'address'   => '1018',
        'lat'       => 25.693624,
        'lng'       => -80.26164,
        'tags' 		=> [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'alias'     => '714',
        'address'   => '714',
        'lat'       => 25.853241,
        'lng'       => -80.205793,
        'tags' 		=> [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1220',
        'address'   => '1220',
        'lat'       => 25.463502,
        'lng'       => -80.456949,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1360',
        'address'   => '1360',
        'lat'       => 25.712858,
        'lng'       => -80.271239,
        'tags' 		=> [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'alias'     => '3818',
        'address'   => '3818',
        'lat'       => 25.900222,
        'lng'       => -80.22482,
        'tags' 		=> [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'alias'     => '2717',
        'address'   => '2717',
        'lat'       => 25.894207,
        'lng'       => -80.345417,
        'tags' 		=> [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'alias'     => '591',
        'address'   => '591',
        'lat'       => 25.706562,
        'lng'       => -80.412644,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '2156',
        'address'   => '2156',
        'lat'       => 25.525801,
        'lng'       => -80.401086,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1339',
        'address'   => '1339',
        'lat'       => 25.630437,
        'lng'       => -80.43103,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '797',
        'address'   => '797',
        'lat'       => 25.868294,
        'lng'       => -80.302895,
        'tags' 		=> [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'alias'     => '2634',
        'address'   => '2634',
        'lat'       => 25.935107,
        'lng'       => -80.260117,
        'tags' 		=> [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'alias'     => '2731',
        'address'   => '2731',
        'lat'       => 25.920058,
        'lng'       => -80.229779,
        'tags' 		=> [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1787',
        'address'   => '1787',
        'lat'       => 25.825283,
        'lng'       => -80.189021,
        'tags' 		=> [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1280',
        'address'   => '1280',
        'lat'       => 25.730165,
        'lng'       => -80.441235,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1807',
        'address'   => '1807',
        'lat'       => 25.748351,
        'lng'       => -80.250563,
        'tags' 		=> [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1554',
        'address'   => '1554',
        'lat'       => 25.478459,
        'lng'       => -80.470336,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1453',
        'address'   => '1453',
        'lat'       => 25.812783,
        'lng'       => -80.351845,
        'tags' 		=> [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'alias'     => '3608',
        'address'   => '3608',
        'lat'       => 25.786452,
        'lng'       => -80.323251,
        'tags' 		=> [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'alias'     => '3407',
        'address'   => '3407',
        'lat'       => 25.659019,
        'lng'       => -80.415279,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1886',
        'address'   => '1886',
        'lat'       => 25.919989,
        'lng'       => -80.356243,
        'tags' 		=> [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1695',
        'address'   => '1695',
        'lat'       => 25.718286,
        'lng'       => -80.460965,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '3363',
        'address'   => '3363',
        'lat'       => 25.850832,
        'lng'       => -80.318992,
        'tags' 		=> [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1174',
        'address'   => '1174',
        'lat'       => 25.685317,
        'lng'       => -80.383784,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1991',
        'address'   => '1991',
        'lat'       => 25.933406,
        'lng'       => -80.169637,
        'tags' 		=> [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'alias'     => '3444',
        'address'   => '3444',
        'lat'       => 25.883938,
        'lng'       => -80.193806,
        'tags' 		=> [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'alias'     => '2057',
        'address'   => '2057',
        'lat'       => 25.85603,
        'lng'       => -80.187272,
        'tags' 		=> [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1025',
        'address'   => '1025',
        'lat'       => 25.466222,
        'lng'       => -80.420452,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1947',
        'address'   => '1947',
        'lat'       => 25.774612,
        'lng'       => -80.382098,
        'tags' 		=> [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'alias'     => '3745',
        'address'   => '3745',
        'lat'       => 25.944004,
        'lng'       => -80.150793,
        'tags' 		=> [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'alias'     => '3633',
        'address'   => '3633',
        'lat'       => 25.949261,
        'lng'       => -80.279658,
        'tags' 		=> [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'alias'     => '3591',
        'address'   => '3591',
        'lat'       => 25.928255,
        'lng'       => -80.30407,
        'tags' 		=> [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'alias'     => '3491',
        'address'   => '3491',
        'lat'       => 25.468136,
        'lng'       => -80.427913,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '566',
        'address'   => '566',
        'lat'       => 25.70715,
        'lng'       => -80.370123,
        'tags' 		=> [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'alias'     => '2254',
        'address'   => '2254',
        'lat'       => 25.781458,
        'lng'       => -80.393427,
        'tags' 		=> [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'alias'     => '2201',
        'address'   => '2201',
        'lat'       => 25.82146,
        'lng'       => -80.186447,
        'tags' 		=> [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1343',
        'address'   => '1343',
        'lat'       => 25.753276,
        'lng'       => -80.274449,
        'tags' 		=> [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'alias'     => '3763',
        'address'   => '3763',
        'lat'       => 25.666494,
        'lng'       => -80.491322,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '2145',
        'address'   => '2145',
        'lat'       => 25.945329,
        'lng'       => -80.255392,
        'tags' 		=> [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1062',
        'address'   => '1062',
        'lat'       => 25.662835,
        'lng'       => -80.397886,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '2670',
        'address'   => '2670',
        'lat'       => 25.578398,
        'lng'       => -80.339737,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '3362',
        'address'   => '3362',
        'lat'       => 25.960922,
        'lng'       => -80.155681,
        'tags' 		=> [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'alias'     => '2265',
        'address'   => '2265',
        'lat'       => 25.753368,
        'lng'       => -80.291559,
        'tags' 		=> [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1397',
        'address'   => '1397',
        'lat'       => 25.632576,
        'lng'       => -80.361512,
        'tags' 		=> [
            'ZONE 04'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1572',
        'address'   => '1572',
        'lat'       => 25.88969,
        'lng'       => -80.369319,
        'tags' 		=> [
            'ZONE 04'
        ]
    ]),
    Address::fromArray([
        'alias'     => '2051',
        'address'   => '2051',
        'lat'       => 25.596058,
        'lng'       => -80.391695,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '228',
        'address'   => '228',
        'lat'       => 25.73956,
        'lng'       => -80.323772,
        'tags' 		=> [
            'ZONE 04'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1411',
        'address'   => '1411',
        'lat'       => 25.695262,
        'lng'       => -80.35019,
        'tags' 		=> [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'alias'     => '2161',
        'address'   => '2161',
        'lat'       => 25.879942,
        'lng'       => -80.181312,
        'tags' 		=> [
            'ZONE 04'
        ]
    ]),
    Address::fromArray([
        'alias'     => '2653',
        'address'   => '2653',
        'lat'       => 25.897973,
        'lng'       => -80.251393,
        'tags' 		=> [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'alias'     => '635',
        'address'   => '635',
        'lat'       => 25.755448,
        'lng'       => -80.345374,
        'tags' 		=> [
            'ZONE 04'
        ]
    ]),
    Address::fromArray([
        'alias'     => '435',
        'address'   => '435',
        'lat'       => 25.840786,
        'lng'       => -80.193978,
        'tags' 		=> [
            'ZONE 04'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1898',
        'address'   => '1898',
        'lat'       => 25.707102,
        'lng'       => -80.291837,
        'tags' 		=> [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'alias'     => '3540',
        'address'   => '3540',
        'lat'       => 25.554037,
        'lng'       => -80.440758,
        'tags' 		=> [
            'ZONE 04'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1448',
        'address'   => '1448',
        'lat'       => 25.438993,
        'lng'       => -80.499711,
        'tags' 		=> [
            'ZONE 04'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1508',
        'address'   => '1508',
        'lat'       => 25.935444,
        'lng'       => -80.246957,
        'tags' 		=> [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'alias'     => '2114',
        'address'   => '2114',
        'lat'       => 25.624977,
        'lng'       => -80.415332,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '3168',
        'address'   => '3168',
        'lat'       => 25.656764,
        'lng'       => -80.313604,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '2296',
        'address'   => '2296',
        'lat'       => 25.71321,
        'lng'       => -80.443086,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '3524',
        'address'   => '3524',
        'lat'       => 25.689408,
        'lng'       => -80.326992,
        'tags' 		=> [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1742',
        'address'   => '1742',
        'lat'       => 25.68284,
        'lng'       => -80.425377,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1844',
        'address'   => '1844',
        'lat'       => 25.718911,
        'lng'       => -80.461655,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '3488',
        'address'   => '3488',
        'lat'       => 25.702125,
        'lng'       => -80.41488,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1418',
        'address'   => '1418',
        'lat'       => 25.597698,
        'lng'       => -80.43969,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1937',
        'address'   => '1937',
        'lat'       => 25.716414,
        'lng'       => -80.409463,
        'tags' 		=> [
            'ZONE 05'
        ]
    ]),
    Address::fromArray([
        'alias'     => '3007',
        'address'   => '3007',
        'lat'       => 25.56263,
        'lng'       => -80.501592,
        'tags' 		=> [
            'ZONE 05'
        ]
    ]),
    Address::fromArray([
        'alias'     => '3589',
        'address'   => '3589',
        'lat'       => 25.877066,
        'lng'       => -80.22757,
        'tags' 		=> [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1274',
        'address'   => '1274',
        'lat'       => 25.888309,
        'lng'       => -80.344764,
        'tags' 		=> [
            'ZONE 05'
        ]
    ]),
    Address::fromArray([
        'alias'     => '3559',
        'address'   => '3559',
        'lat'       => 25.672567,
        'lng'       => -80.414705,
        'tags' 		=> [
            'ZONE 05'
        ]
    ]),
    Address::fromArray([
        'alias'     => '2526',
        'address'   => '2526',
        'lat'       => 25.507321,
        'lng'       => -80.402466,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '2518',
        'address'   => '2518',
        'lat'       => 25.632515,
        'lng'       => -80.368998,
        'tags' 		=> [
            'ZONE 05'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1282',
        'address'   => '1282',
        'lat'       => 25.771978,
        'lng'       => -80.414949,
        'tags' 		=> [
            'ZONE 05'
        ]
    ]),
    Address::fromArray([
        'alias'     => '676',
        'address'   => '676',
        'lat'       => 25.912758,
        'lng'       => -80.22939,
        'tags' 		=> [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1884',
        'address'   => '1884',
        'lat'       => 25.536208,
        'lng'       => -80.386541,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '2412',
        'address'   => '2412',
        'lat'       => 25.85111,
        'lng'       => -80.120576,
        'tags' 		=> [
            'ZONE 05'
        ]
    ]),
    Address::fromArray([
        'alias'     => '3742',
        'address'   => '3742',
        'lat'       => 25.933645,
        'lng'       => -80.323814,
        'tags' 		=> [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1331',
        'address'   => '1331',
        'lat'       => 25.67895,
        'lng'       => -80.313754,
        'tags' 		=> [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'alias'     => '3100',
        'address'   => '3100',
        'lat'       => 25.533563,
        'lng'       => -80.38402,
        'tags' 		=> [
            'ZONE 05'
        ]
    ]),
    Address::fromArray([
        'alias'     => '655',
        'address'   => '655',
        'lat'       => 25.769052,
        'lng'       => -80.243021,
        'tags' 		=> [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'alias'     => '576',
        'address'   => '576',
        'lat'       => 25.764978,
        'lng'       => -80.277512,
        'tags' 		=> [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'alias'     => '2917',
        'address'   => '2917',
        'lat'       => 25.654264,
        'lng'       => -80.316461,
        'tags' 		=> [
            'ZONE 05'
        ]
    ]),
    Address::fromArray([
        'alias'     => '580',
        'address'   => '580',
        'lat'       => 25.896584,
        'lng'       => -80.185163,
        'tags' 		=> [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'alias'     => '2153',
        'address'   => '2153',
        'lat'       => 25.890803,
        'lng'       => -80.157806,
        'tags' 		=> [
            'ZONE 05'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1892',
        'address'   => '1892',
        'lat'       => 25.538826,
        'lng'       => -80.410054,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '2509',
        'address'   => '2509',
        'lat'       => 25.440818,
        'lng'       => -80.483541,
        'tags' 		=> [
            'ZONE 05'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1200',
        'address'   => '1200',
        'lat'       => 25.707728,
        'lng'       => -80.44163,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '296',
        'address'   => '296',
        'lat'       => 25.851701,
        'lng'       => -80.176098,
        'tags' 		=> [
            'ZONE 05'
        ]
    ]),
    Address::fromArray([
        'alias'     => '3541',
        'address'   => '3541',
        'lat'       => 25.462625,
        'lng'       => -80.522619,
        'tags' 		=> [
            'ZONE 05'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1720',
        'address'   => '1720',
        'lat'       => 25.92718,
        'lng'       => -80.316562,
        'tags' 		=> [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'alias'     => '2036',
        'address'   => '2036',
        'lat'       => 25.670897,
        'lng'       => -80.377996,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '3293',
        'address'   => '3293',
        'lat'       => 25.897834,
        'lng'       => -80.166847,
        'tags' 		=> [
            'ZONE 05'
        ]
    ]),
    Address::fromArray([
        'alias'     => '2655',
        'address'   => '2655',
        'lat'       => 25.522536,
        'lng'       => -80.412345,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '760',
        'address'   => '760',
        'lat'       => 25.706278,
        'lng'       => -80.255363,
        'tags' 		=> [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1372',
        'address'   => '1372',
        'lat'       => 25.854665,
        'lng'       => -80.219084,
        'tags' 		=> [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'alias'     => '543',
        'address'   => '543',
        'lat'       => 25.691905,
        'lng'       => -80.166846,
        'tags' 		=> [
            'ZONE 04'
        ]
    ]),
    Address::fromArray([
        'alias'     => '734',
        'address'   => '734',
        'lat'       => 25.876138,
        'lng'       => -80.17468,
        'tags' 		=> [
            'ZONE 04'
        ]
    ]),
    Address::fromArray([
        'alias'     => '2140',
        'address'   => '2140',
        'lat'       => 25.697937,
        'lng'       => -80.305012,
        'tags' 		=> [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'alias'     => '735',
        'address'   => '735',
        'lat'       => 25.738146,
        'lng'       => -80.239778,
        'tags' 		=> [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'alias'     => '3690',
        'address'   => '3690',
        'lat'       => 25.610484,
        'lng'       => -80.443037,
        'tags' 		=> [
            'ZONE 04'
        ]
    ]),
    Address::fromArray([
        'alias'     => '2401',
        'address'   => '2401',
        'lat'       => 25.864908,
        'lng'       => -80.249759,
        'tags' 		=> [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'alias'     => '2111',
        'address'   => '2111',
        'lat'       => 25.470719,
        'lng'       => -80.430468,
        'tags' 		=> [
            'ZONE 04'
        ]
    ]),
    Address::fromArray([
        'alias'     => '169',
        'address'   => '169',
        'lat'       => 25.766635,
        'lng'       => -80.229855,
        'tags' 		=> [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1745',
        'address'   => '1745',
        'lat'       => 25.755992,
        'lng'       => -80.245188,
        'tags' 		=> [
            'ZONE 04'
        ]
    ]),
    Address::fromArray([
        'alias'     => '3640',
        'address'   => '3640',
        'lat'       => 25.717794,
        'lng'       => -80.34849,
        'tags' 		=> [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'alias'     => '2924',
        'address'   => '2924',
        'lat'       => 25.561033,
        'lng'       => -80.383616,
        'tags' 		=> [
            'ZONE 04'
        ]
    ]),
    Address::fromArray([
        'alias'     => '3723',
        'address'   => '3723',
        'lat'       => 25.954617,
        'lng'       => -80.275544,
        'tags' 		=> [
            'ZONE 04'
        ]
    ]),
    Address::fromArray([
        'alias'     => '3683',
        'address'   => '3683',
        'lat'       => 25.667635,
        'lng'       => -80.451966,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '3878',
        'address'   => '3878',
        'lat'       => 25.573239,
        'lng'       => -80.396679,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1580',
        'address'   => '1580',
        'lat'       => 25.866567,
        'lng'       => -80.272164,
        'tags' 		=> [
            'ZONE 04'
        ]
    ]),
    Address::fromArray([
        'alias'     => '3514',
        'address'   => '3514',
        'lat'       => 25.885891,
        'lng'       => -80.210434,
        'tags' 		=> [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1430',
        'address'   => '1430',
        'lat'       => 25.738665,
        'lng'       => -80.340541,
        'tags' 		=> [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1772',
        'address'   => '1772',
        'lat'       => 25.834132,
        'lng'       => -80.364386,
        'tags' 		=> [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'alias'     => '918',
        'address'   => '918',
        'lat'       => 25.954939,
        'lng'       => -80.267666,
        'tags' 		=> [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1080',
        'address'   => '1080',
        'lat'       => 25.619834,
        'lng'       => -80.366447,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '3044',
        'address'   => '3044',
        'lat'       => 25.82931,
        'lng'       => -80.19783,
        'tags' 		=> [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'alias'     => '3644',
        'address'   => '3644',
        'lat'       => 25.643624,
        'lng'       => -80.509277,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '2221',
        'address'   => '2221',
        'lat'       => 25.872052,
        'lng'       => -80.33531,
        'tags' 		=> [
            'ZONE 05'
        ]
    ]),
    Address::fromArray([
        'alias'     => '2303',
        'address'   => '2303',
        'lat'       => 25.808094,
        'lng'       => -80.281248,
        'tags' 		=> [
            'ZONE 05'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1931',
        'address'   => '1931',
        'lat'       => 25.736135,
        'lng'       => -80.426188,
        'tags' 		=> [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1328',
        'address'   => '1328',
        'lat'       => 25.468268,
        'lng'       => -80.42194,
        'tags' 		=> [
            'ZONE 05'
        ]
    ]),
    Address::fromArray([
        'alias'     => '671',
        'address'   => '671',
        'lat'       => 25.944484,
        'lng'       => -80.329091,
        'tags' 		=> [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'alias'     => '3409',
        'address'   => '3409',
        'lat'       => 25.852165,
        'lng'       => -80.293438,
        'tags' 		=> [
            'ZONE 05'
        ]
    ]),
    Address::fromArray([
        'alias'     => '796',
        'address'   => '796',
        'lat'       => 25.658376,
        'lng'       => -80.392911,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1262',
        'address'   => '1262',
        'lat'       => 25.740565,
        'lng'       => -80.222564,
        'tags' 		=> [
            'ZONE 05'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1489',
        'address'   => '1489',
        'lat'       => 25.49048,
        'lng'       => -80.41572,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '3200',
        'address'   => '3200',
        'lat'       => 25.462866,
        'lng'       => -80.483135,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1858',
        'address'   => '1858',
        'lat'       => 25.812964,
        'lng'       => -80.279631,
        'tags' 		=> [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'alias'     => '804',
        'address'   => '804',
        'lat'       => 25.558081,
        'lng'       => -80.358893,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '968',
        'address'   => '968',
        'lat'       => 25.95048,
        'lng'       => -80.329778,
        'tags' 		=> [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'alias'     => '2020',
        'address'   => '2020',
        'lat'       => 25.677095,
        'lng'       => -80.438494,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '2542',
        'address'   => '2542',
        'lat'       => 25.747892,
        'lng'       => -80.244994,
        'tags' 		=> [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'alias'     => '3124',
        'address'   => '3124',
        'lat'       => 25.58947,
        'lng'       => -80.394781,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '3405',
        'address'   => '3405',
        'lat'       => 25.860687,
        'lng'       => -80.198642,
        'tags' 		=> [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1910',
        'address'   => '1910',
        'lat'       => 25.747395,
        'lng'       => -80.402058,
        'tags' 		=> [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'alias'     => '2628',
        'address'   => '2628',
        'lat'       => 25.837379,
        'lng'       => -80.29829,
        'tags' 		=> [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'alias'     => '3911',
        'address'   => '3911',
        'lat'       => 25.773261,
        'lng'       => -80.212652,
        'tags' 		=> [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1556',
        'address'   => '1556',
        'lat'       => 25.457798,
        'lng'       => -80.483813,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1223',
        'address'   => '1223',
        'lat'       => 25.696267,
        'lng'       => -80.445327,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '3143',
        'address'   => '3143',
        'lat'       => 25.888873,
        'lng'       => -80.349537,
        'tags' 		=> [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'alias'     => '3652',
        'address'   => '3652',
        'lat'       => 25.514252,
        'lng'       => -80.479673,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '633',
        'address'   => '633',
        'lat'       => 25.710656,
        'lng'       => -80.261291,
        'tags' 		=> [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1966',
        'address'   => '1966',
        'lat'       => 25.64854,
        'lng'       => -80.391705,
        'tags' 		=> [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'alias'     => '1304',
        'address'   => '1304',
        'lat'       => 25.935256,
        'lng'       => -80.176192,
        'tags' 		=> [
            'ZONE 03'
        ]
    ])
];

$optimizationParams = new OptimizationProblemParams();
$optimizationParams->setAddresses($addresses);
$optimizationParams->setParameters($parameters);

$problem = OptimizationProblem::optimize($optimizationParams);

echo Route4Me::object2json($problem);

