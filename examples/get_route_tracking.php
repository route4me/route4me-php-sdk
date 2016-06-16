<?php
require __DIR__.'/../vendor/autoload.php';;

use Route4Me\Route4Me;
use Route4Me\Route;

Route4Me::setApiKey('11111111111111111111111111111111');

$routeId = 'AC16E7D338B551013FF34266FE81A5EE';
$route = Route::getRoutes($routeId, array(
    'device_tracking_history' => true
));

var_dump($route->tracking_history);
