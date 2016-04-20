<?php
namespace Route4me;
require __DIR__.'/../vendor/autoload.php';
//See video tutorial here: http://support.route4me.com/route-planning-help.php?id=manual0:tutorial2:chapter1:subchapter3

use Route4me\Route4me;
use Route4me\Enum\OptimizationType;
use Route4me\OptimizationProblem;
use Route4me\OptimizationProblemParams;
use Route4me\Enum\AlgorithmType;
use Route4me\Enum\DistanceUnit;
use Route4me\Enum\DeviceType;
use Route4me\Enum\TravelMode;
use Route4me\Enum\Metric;
use Route4me\RouteParameters;
use Route4me\Address;
use Route4me\Route;

Route4me::setApiKey('11111111111111111111111111111111');

// Huge list of addresses
$json = json_decode(file_get_contents('./addresses.json'), true);

$addresses = array();
foreach($json as $address) {
    $addresses[] = Address::fromArray($address);
}

$parameters = RouteParameters::fromArray(array(
    "algorithm_type"          => Algorithmtype::TSP,
    "route_name"			  => "Single Driver Multiple TimeWindows 12 Stops",
    "route_date"			  => time() + 24*60*60,
    "route_time"			  => 5 * 3600 + 30 * 60,
    "distance_unit"           => DistanceUnit::MILES,
    "device_type"             => DeviceType::WEB,
    "optimize"                => OptimizationType::DISTANCE,
    "metric"                  => Metric::GEODESIC
));

$optimizationParams = new OptimizationProblemParams;
$optimizationParams->setAddresses($addresses);
$optimizationParams->setParameters($parameters);

$problem = OptimizationProblem::optimize($optimizationParams);

foreach ((array)$problem as $key => $value) {
	if (is_string($value))
	{
		echo $key." --> ".$value."<br>";
	}
	else 
	{
		echo "************ $key ************* <br>";
		Route4me::simplePrint((array)$value);
		echo "******************************* <br>";
	}
}

?>
