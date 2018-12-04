<?php
namespace Route4Me;

$root = realpath(dirname(__FILE__) . '/../../');
require $root . '/vendor/autoload.php';

use Route4Me\Route4Me;

// Set the api key in the Route4Me class
Route4Me::setApiKey('11111111111111111111111111111111');

//Example refers to the process of retrieving sepcified fields by containg specified text in any field 
//--------------------------------------------------------- 
$ablocation=new AddressBookLocation();

$params = array(
    "query"  => "David",
    "fields" => "first_name,address_email",
    "offset" => 0,
    "limit"  => 20,
);

$abcResult=$ablocation->searchRoutedLocation($params);

$results=$ablocation->getValue($abcResult,"results");

Route4Me::simplePrint($results);
