<?php
namespace Route4Me;

$root = realpath(dirname(__FILE__) . '/../../');
require $root . '/vendor/autoload.php';

use Route4Me\Route4Me;

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_BAIL, 1);

// Set the api key in the Route4Me class
Route4Me::setApiKey('11111111111111111111111111111111');

$ablocation=new AddressBookLocation();

//Example refers to the process of search for routed addresses 
//--------------------------------------------------------- 
$params= array(
    'offset'  => 0,
    'limit'   => 5,
    'display' => 'routed'
);

$abcResult=$ablocation->searchRoutedLocation($params);

assert(isset($abcResult['results']) && isset($abcResult['total']), "Cannot done search for the locations");

echo "Was found " . $abcResult['total'] . " routed locations";
