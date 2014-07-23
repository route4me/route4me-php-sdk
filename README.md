Route4Me PHP SDK
----------------

[![Build Status](https://travis-ci.org/route4me/route4me-php-sdk.svg?branch=master)](https://travis-ci.org/route4me/route4me-php-sdk)

## Setup

set in composer.json

    {
        "require": {
            "route4me/route4me-php": "~1.1.0"
        }
    }

Now execute the dependency manager (https://getcomposer.org/download/) in your project root:

    php composer.phar install

## Examples

### Single Driver Route Optimization

```php
Route4me\Route4me::setApiKey('11111111111111111111111111111111');

$addresses = array();
$addresses[] = Route4me\Address::fromArray(array(
    "lng"         => -85.757308,
    "lat"         => 38.251698,
    "is_depot"    => true,
    "time"        => 300,
    "sequence_no" => 0,
    "address"     => "455 S 4th St, Louisville, KY 40202"
));

$addresses[] = Route4me\Address::fromArray(array(
    "lng"         => -85.793846,
    "lat"         => 38.141598,
    "is_depot"    => false,
    "time"        => 300,
    "sequence_no" => 1,
    "address"     => "1604 PARKRIDGE PKWY, Louisville, KY, 40214"
));

$addresses[] = Route4me\Address::fromArray(array(
    "lng"         => -85.786514,
    "lat"         => 38.202496,
    "is_depot"    => false,
    "time"        => 300,
    "sequence_no" => 2,
    "address"     => "1407 MCCOY, Louisville, KY, 40215"
));

$addresses[] = Route4me\Address::fromArray(array(
    "lng"         => -85.774864,
    "lat"         => 38.178844,
    "is_depot"    => false,
    "time"        => 300,
    "sequence_no" => 3,
    "address"     => "4805 BELLEVUE AVE, Louisville, KY, 40215"
));

$parameters = Route4me\RouteParameters::fromArray(array(
    "algorithm_type"          => Route4me\Enum\AlgorithmType::TSP,
    "distance_unit"           => Route4me\Enum\DistanceUnit::MILES,
    "device_type"             => Route4me\Enum\DeviceType::WEB,
    "optimize"                => Route4me\Enum\OptimizationType::DISTANCE,
    "travel_mode"             => Route4me\Enum\TravelMode::DRIVING,
    "route_max_duration"      => 86400,
    "store_route"             => true,
    "vehicle_capacity"        => 1,
    "vehicle_max_distance_mi" => 10000
));

$optimizationParams = new Route4Me\OptimizationProblemParams;
$optimizationParams->setAddresses($addresses);
$optimizationParams->setParameters($parameters);

$problem = Route4Me\OptimizationProblem::optimize($optimizationParams);

var_dump($problem);
```

### Multiple Depot Multiple driver route optimization

```php
Route4me\Route4me::setApiKey('11111111111111111111111111111111');

// Huge list of addresses
$json = json_decode(file_get_contents('./examples/addresses.json'), true);

$addresses = array();
foreach($json as $address) {
    $addresses[] = Address::fromArray($address);
}

$parameters = Route4me\RouteParameters::fromArray(array(
    "algorithm_type"          => Route4me\Enum\AlgorithmType::CVRP_TW_MD,
    "distance_unit"           => Route4me\Enum\DistanceUnit::MILES,
    "device_type"             => Route4me\Enum\DeviceType::WEB,
    "optimize"                => Route4me\Enum\OptimizationType::DISTANCE,
    "travel_mode"             => Route4me\Enum\TravelMode::DRIVING,
    "route_max_duration"      => 86400,
    "store_route"             => true,
    "vehicle_capacity"        => 50,
    "vehicle_max_distance_mi" => 10000,
    "parts"                   => 50
));

$optimizationParams = new Route4Me\OptimizationProblemParams;
$optimizationParams->setAddresses($addresses);
$optimizationParams->setParameters($parameters);

$problem = Route4Me\OptimizationProblem::optimize($optimizationParams);

var_dump($problem);
```

## Tests

    ./vendor/bin/phpunit
