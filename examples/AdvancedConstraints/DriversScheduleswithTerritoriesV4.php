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

$member = new Member();
$response = $member->getUsers();

if ($response==NULL || !isset($response['results']) || sizeof($response['results'])<3) {
    echo "Cannot retrieve 3 members";
    return;
}

$parameters = RouteParameters::fromArray([
    'rt'                => true,
    'algorithm_type'    => Algorithmtype::ADVANCED_CVRP_TW,
    'route_name'        => 'Drivers Schedules - 3 Territories '.date('Y-m-d H:i:s', time()),
    'distance_unit'     => DistanceUnit::MILES,
    'device_type'       => DeviceType::WEB,
    'optimize'          => OptimizationType::DISTANCE,
    'travel_mode'       => TravelMode::DRIVING,
    'parts'             => 9,
    'advanced_constraints'=> [
        [
            'max_cargo_volume'       => 0.0,
            'max_capacity'           => 200,
            'available_time_windows' => [
                [
                    25200,
                    75000
                ]
            ],
            'route4me_members_id' => [
                $response['results'][0]['member_id'],
                $response['results'][1]['member_id'],
                $response['results'][2]['member_id']
            ]
        ],
        [
            'max_cargo_volume'       => 0.0,
            'max_capacity'           => 500,
            'available_time_windows' => [
                [
                    45200,
                    85000
                ]
            ],
            'route4me_members_id' => [
                $response['results'][0]['member_id'],
                $response['results'][1]['member_id'],
                $response['results'][2]['member_id']
            ]
        ]
    ] 
   
]);

$addresses = [
    Address::fromArray([
        'address'   => 'DEPOT',
        'is_depot'  => true,
        'lat'       => 25.723025,
        'lng'       => -80.452883,
        'time'      => 0
    ]),
    Address::fromArray([
        'address'   => '2158',
        'is_depot'  => false,
        'lat'       => 25.603049,
        'lng'       => -80.348022,
        'time'      => 300,
        'tags'      => [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'address'   => '253',
        'is_depot'  => false,
        'lat'       => 25.618737,
        'lng'       => -80.329138,
        'time'      => 300,
        'tags'      => [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'address'   => '1527',
        'is_depot'  => false,
        'lat'       => 25.660645,
        'lng'       => -80.284289,
        'time'      => 300,
        'tags'      => [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'address'   => '1889',
        'is_depot'  => false,
        'lat'       => 25.816771,
        'lng'       => -80.265282,
        'time'      => 300,
        'tags'      => [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'address'   => '3998',
        'is_depot'  => false,
        'lat'       => 25.830834,
        'lng'       => -80.336474,
        'time'      => 300,
        'tags'      => [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'address'   => '1988',
        'is_depot'  => false,
        'lat'       => 25.934509,
        'lng'       => -80.216283,
        'time'      => 300,
        'tags'      => [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'address'   => '3566',
        'is_depot'  => false,
        'lat'       => 25.826221,
        'lng'       => -80.247753,
        'time'      => 300,
        'tags'      => [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'address'   => '2659',
        'is_depot'  => false,
        'lat'       => 25.60218,
        'lng'       => -80.384538,
        'time'      => 300,
        'tags'      => [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'address'   => '2477',
        'is_depot'  => false,
        'lat'       => 25.679245,
        'lng'       => -80.281254,
        'time'      => 300,
        'tags'      => [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'address'   => '3968',
        'is_depot'  => false,
        'lat'       => 25.655636,
        'lng'       => -80.350484,
        'time'      => 300,
        'tags'      => [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'address'   => '1700',
        'is_depot'  => false,
        'lat'       => 25.871786,
        'lng'       => -80.341298,
        'time'      => 300,
        'tags'      => [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'address'   => '1804',
        'is_depot'  => false,
        'lat'       => 25.690688,
        'lng'       => -80.318216,
        'time'      => 300,
        'tags'      => [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'address'   => '209',
        'is_depot'  => false,
        'lat'       => 25.893571,
        'lng'       => -80.20119,
        'time'      => 300,
        'tags'      => [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'address'   => '834',
        'is_depot'  => false,
        'lat'       => 25.951618,
        'lng'       => -80.29993,
        'time'      => 300,
        'tags'      => [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'address'   => '1530',
        'is_depot'  => false,
        'lat'       => 25.818694,
        'lng'       => -80.354931,
        'time'      => 300,
        'tags'      => [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'address'   => '1696',
        'is_depot'  => false,
        'lat'       => 25.748019,
        'lng'       => -80.243968,
        'time'      => 300,
        'tags'      => [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'address'   => '1596',
        'is_depot'  => false,
        'lat'       => 25.834085,
        'lng'       => -80.193554,
        'time'      => 300,
        'tags'      => [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'address'   => '3563',
        'is_depot'  => false,
        'lat'       => 25.690451,
        'lng'       => -80.272227,
        'time'      => 300,
        'tags'      => [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'address'   => '3622',
        'is_depot'  => false,
        'lat'       => 25.602187,
        'lng'       => -80.411931,
        'time'      => 300,
        'tags'      => [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'address'   => '1805',
        'is_depot'  => false,
        'lat'       => 25.780564,
        'lng'       => -80.415264,
        'time'      => 300,
        'tags'      => [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'address'   => '1655',
        'is_depot'  => false,
        'lat'       => 25.779567,
        'lng'       => -80.356258,
        'time'      => 300,
        'tags'      => [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'address'   => '1533',
        'is_depot'  => false,
        'lat'       => 25.459839,
        'lng'       => -80.44416,
        'time'      => 300,
        'tags'      => [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'address'   => '269',
        'is_depot'  => false,
        'lat'       => 25.777716,
        'lng'       => -80.25451,
        'time'      => 300,
        'tags'      => [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'address'   => '1238',
        'is_depot'  => false,
        'lat'       => 25.821602,
        'lng'       => -80.12694,
        'time'      => 300,
        'tags'      => [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'address'   => '3312',
        'is_depot'  => false,
        'lat'       => 25.894716,
        'lng'       => -80.33056,
        'time'      => 300,
        'tags'      => [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'address'   => '3989',
        'is_depot'  => false,
        'lat'       => 25.553594,
        'lng'       => -80.374832,
        'time'      => 300,
        'tags'      => [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'address'   => '457',
        'is_depot'  => false,
        'lat'       => 25.636562,
        'lng'       => -80.451262,
        'time'      => 300,
        'tags'      => [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'address'   => '3105',
        'is_depot'  => false,
        'lat'       => 25.737308,
        'lng'       => -80.43438,
        'time'      => 300,
        'tags'      => [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'address'   => '3317',
        'is_depot'  => false,
        'lat'       => 25.752353,
        'lng'       => -80.215284,
        'time'      => 300,
        'tags'      => [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'address'   => '3589',
        'is_depot'  => false,
        'lat'       => 25.877066,
        'lng'       => -80.22757,
        'time'      => 300,
        'tags'      => [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'address'   => '3313',
        'is_depot'  => false,
        'lat'       => 25.93445,
        'lng'       => -80.257547,
        'time'      => 300,
        'tags'      => [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'address'   => '385',
        'is_depot'  => false,
        'lat'       => 25.902516,
        'lng'       => -80.254678,
        'time'      => 300,
        'tags'      => [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'address'   => '2601',
        'is_depot'  => false,
        'lat'       => 25.85515,
        'lng'       => -80.219475,
        'time'      => 300,
        'tags'      => [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'address'   => '602',
        'is_depot'  => false,
        'lat'       => 25.513304,
        'lng'       => -80.387233,
        'time'      => 300,
        'tags'      => [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'address'   => '2710',
        'is_depot'  => false,
        'lat'       => 25.626475,
        'lng'       => -80.428484,
        'time'      => 300,
        'tags'      => [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'address'   => '1187',
        'is_depot'  => false,
        'lat'       => 25.781259,
        'lng'       => -80.402599,
        'time'      => 300,
        'tags'      => [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'address'   => '2155',
        'is_depot'  => false,
        'lat'       => 25.760206,
        'lng'       => -80.330144,
        'time'      => 300,
        'tags'      => [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'address'   => '990',
        'is_depot'  => false,
        'lat'       => 25.9182,
        'lng'       => -80.352967,
        'time'      => 300,
        'tags'      => [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'address'   => '2810',
        'is_depot'  => false,
        'lat'       => 25.763907,
        'lng'       => -80.293502,
        'time'      => 300,
        'tags'      => [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'address'   => '3294',
        'is_depot'  => false,
        'lat'       => 25.576745,
        'lng'       => -80.380201,
        'time'      => 300,
        'tags'      => [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'address'   => '3578',
        'is_depot'  => false,
        'lat'       => 25.441741,
        'lng'       => -80.454027,
        'time'      => 300,
        'tags'      => [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'address'   => '1040',
        'is_depot'  => false,
        'lat'       => 25.741545,
        'lng'       => -80.320633,
        'time'      => 300,
        'tags'      => [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'address'   => '2184',
        'is_depot'  => false,
        'lat'       => 25.769002,
        'lng'       => -80.404676,
        'time'      => 300,
        'tags'      => [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'address'   => '842',
        'is_depot'  => false,
        'lat'       => 25.705431,
        'lng'       => -80.398938,
        'time'      => 300,
        'tags'      => [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'address'   => '1668',
        'is_depot'  => false,
        'lat'       => 25.770751,
        'lng'       => -80.21817,
        'time'      => 300,
        'tags'      => [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'address'   => '2603',
        'is_depot'  => false,
        'lat'       => 25.660366,
        'lng'       => -80.376896,
        'time'      => 300,
        'tags'      => [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'address'   => '1304',
        'is_depot'  => false,
        'lat'       => 25.935256,
        'lng'       => -80.176192,
        'time'      => 300,
        'tags'      => [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'address'   => '3281',
        'is_depot'  => false,
        'lat'       => 25.962562,
        'lng'       => -80.250286,
        'time'      => 300,
        'tags'      => [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'address'   => '2855',
        'is_depot'  => false,
        'lat'       => 25.781819,
        'lng'       => -80.235649,
        'time'      => 300,
        'tags'      => [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'address'   => '2518',
        'is_depot'  => false,
        'lat'       => 25.632515,
        'lng'       => -80.368998,
        'time'      => 300,
        'tags'      => [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'address'   => '46',
        'is_depot'  => false,
        'lat'       => 25.741641,
        'lng'       => -80.221332,
        'time'      => 300,
        'tags'      => [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'address'   => '3185',
        'is_depot'  => false,
        'lat'       => 25.945872,
        'lng'       => -80.310623,
        'time'      => 300,
        'tags'      => [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'address'   => '3309',
        'is_depot'  => false,
        'lat'       => 25.761921,
        'lng'       => -80.368253,
        'time'      => 300,
        'tags'      => [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'address'   => '2586',
        'is_depot'  => false,
        'lat'       => 25.792323,
        'lng'       => -80.336024,
        'time'      => 300,
        'tags'      => [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'address'   => '237',
        'is_depot'  => false,
        'lat'       => 25.749872,
        'lng'       => -80.393815,
        'time'      => 300,
        'tags'      => [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'address'   => '2192',
        'is_depot'  => false,
        'lat'       => 25.94228,
        'lng'       => -80.174436,
        'time'      => 300,
        'tags'      => [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'address'   => '2887',
        'is_depot'  => false,
        'lat'       => 25.753024,
        'lng'       => -80.232491,
        'time'      => 300,
        'tags'      => [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'address'   => '3485',
        'is_depot'  => false,
        'lat'       => 25.547749,
        'lng'       => -80.375777,
        'time'      => 300,
        'tags'      => [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'address'   => '3832',
        'is_depot'  => false,
        'lat'       => 25.489671,
        'lng'       => -80.419657,
        'time'      => 300,
        'tags'      => [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'address'   => '1393',
        'is_depot'  => false,
        'lat'       => 25.872401,
        'lng'       => -80.295227,
        'time'      => 300,
        'tags'      => [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'address'   => '781',
        'is_depot'  => false,
        'lat'       => 25.912158,
        'lng'       => -80.204096,
        'time'      => 300,
        'tags'      => [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'address'   => '2165',
        'is_depot'  => false,
        'lat'       => 25.745813,
        'lng'       => -80.275891,
        'time'      => 300,
        'tags'      => [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'address'   => '537',
        'is_depot'  => false,
        'lat'       => 25.843267,
        'lng'       => -80.373141,
        'time'      => 300,
        'tags'      => [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'address'   => '235',
        'is_depot'  => false,
        'lat'       => 25.877239,
        'lng'       => -80.222824,
        'time'      => 300,
        'tags'      => [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'address'   => '1175',
        'is_depot'  => false,
        'lat'       => 25.924446,
        'lng'       => -80.162018,
        'time'      => 300,
        'tags'      => [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'address'   => '2235',
        'is_depot'  => false,
        'lat'       => 25.850434,
        'lng'       => -80.183362,
        'time'      => 300,
        'tags'      => [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'address'   => '2775',
        'is_depot'  => false,
        'lat'       => 25.647769,
        'lng'       => -80.410684,
        'time'      => 300,
        'tags'      => [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'address'   => '1556',
        'is_depot'  => false,
        'lat'       => 25.457798,
        'lng'       => -80.483813,
        'time'      => 300,
        'tags'      => [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'address'   => '3233',
        'is_depot'  => false,
        'lat'       => 25.593026,
        'lng'       => -80.382412,
        'time'      => 300,
        'tags'      => [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'address'   => '3534',
        'is_depot'  => false,
        'lat'       => 25.867923,
        'lng'       => -80.24087,
        'time'      => 300,
        'tags'      => [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'address'   => '3205',
        'is_depot'  => false,
        'lat'       => 25.656392,
        'lng'       => -80.291358,
        'time'      => 300,
        'tags'      => [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'address'   => '2893',
        'is_depot'  => false,
        'lat'       => 25.867024,
        'lng'       => -80.201303,
        'time'      => 300,
        'tags'      => [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'address'   => '1555',
        'is_depot'  => false,
        'lat'       => 25.776622,
        'lng'       => -80.415111,
        'time'      => 300,
        'tags'      => [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'address'   => '3218',
        'is_depot'  => false,
        'lat'       => 25.832436,
        'lng'       => -80.280374,
        'time'      => 300,
        'tags'      => [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'address'   => '899',
        'is_depot'  => false,
        'lat'       => 25.855764,
        'lng'       => -80.187256,
        'time'      => 300,
        'tags'      => [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'address'   => '1027',
        'is_depot'  => false,
        'lat'       => 25.735087,
        'lng'       => -80.259917,
        'time'      => 300,
        'tags'      => [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'address'   => '3448',
        'is_depot'  => false,
        'lat'       => 25.84728,
        'lng'       => -80.266024,
        'time'      => 300,
        'tags'      => [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'address'   => '884',
        'is_depot'  => false,
        'lat'       => 25.480335,
        'lng'       => -80.458004,
        'time'      => 300,
        'tags'      => [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'address'   => '448',
        'is_depot'  => false,
        'lat'       => 25.684473,
        'lng'       => -80.451831,
        'time'      => 300,
        'tags'      => [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'address'   => '3643',
        'is_depot'  => false,
        'lat'       => 25.677524,
        'lng'       => -80.425454,
        'time'      => 300,
        'tags'      => [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'address'   => '1952',
        'is_depot'  => false,
        'lat'       => 25.754493,
        'lng'       => -80.342664,
        'time'      => 300,
        'tags'      => [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'address'   => '3507',
        'is_depot'  => false,
        'lat'       => 25.874399,
        'lng'       => -80.345727,
        'time'      => 300,
        'tags'      => [
            'ZONE 02'
        ]
    ]),
    Address::fromArray([
        'address'   => '3520',
        'is_depot'  => false,
        'lat'       => 25.483806,
        'lng'       => -80.428498,
        'time'      => 300,
        'tags'      => [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'address'   => '1611',
        'is_depot'  => false,
        'lat'       => 25.713302,
        'lng'       => -80.440269,
        'time'      => 300,
        'tags'      => [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'address'   => '1402',
        'is_depot'  => false,
        'lat'       => 25.72308,
        'lng'       => -80.444812,
        'time'      => 300,
        'tags'      => [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'address'   => '1211',
        'is_depot'  => false,
        'lat'       => 25.699226,
        'lng'       => -80.422237,
        'time'      => 300,
        'tags'      => [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'address'   => '1161',
        'is_depot'  => false,
        'lat'       => 25.835215,
        'lng'       => -80.252216,
        'time'      => 300,
        'tags'      => [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'address'   => '1274',
        'is_depot'  => false,
        'lat'       => 25.888309,
        'lng'       => -80.344764,
        'time'      => 300,
        'tags'      => [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'address'   => '1341',
        'is_depot'  => false,
        'lat'       => 25.716966,
        'lng'       => -80.438179,
        'time'      => 300,
        'tags'      => [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'address'   => '2946',
        'is_depot'  => false,
        'lat'       => 25.530972,
        'lng'       => -80.448924,
        'time'      => 300,
        'tags'      => [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'address'   => '813',
        'is_depot'  => false,
        'lat'       => 25.488095,
        'lng'       => -80.450334,
        'time'      => 300,
        'tags'      => [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'address'   => '3862',
        'is_depot'  => false,
        'lat'       => 25.954786,
        'lng'       => -80.16335,
        'time'      => 300,
        'tags'      => [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'address'   => '759',
        'is_depot'  => false,
        'lat'       => 25.555122,
        'lng'       => -80.335284,
        'time'      => 300,
        'tags'      => [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'address'   => '52',
        'is_depot'  => false,
        'lat'       => 25.927916,
        'lng'       => -80.268189,
        'time'      => 300,
        'tags'      => [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'address'   => '909',
        'is_depot'  => false,
        'lat'       => 25.832815,
        'lng'       => -80.217156,
        'time'      => 300,
        'tags'      => [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'address'   => '2768',
        'is_depot'  => false,
        'lat'       => 25.835259,
        'lng'       => -80.223997,
        'time'      => 300,
        'tags'      => [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'address'   => '3967',
        'is_depot'  => false,
        'lat'       => 25.630732,
        'lng'       => -80.366065,
        'time'      => 300,
        'tags'      => [
            'ZONE 01'
        ]
    ]),
    Address::fromArray([
        'address'   => '1974',
        'is_depot'  => false,
        'lat'       => 25.931024,
        'lng'       => -80.217991,
        'time'      => 300,
        'tags'      => [
            'ZONE 03'
        ]
    ]),
    Address::fromArray([
        'address'   => '3147',
        'is_depot'  => false,
        'lat'       => 25.921095,
        'lng'       => -80.261839,
        'time'      => 300,
        'tags'      => [
            'ZONE 03'
        ]
    ])
];

$optimizationParams = new OptimizationProblemParams();
$optimizationParams->setAddresses($addresses);
$optimizationParams->setParameters($parameters);

$problem = OptimizationProblem::optimize($optimizationParams);

echo Route4Me::object2json($problem);

