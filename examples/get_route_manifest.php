<?php
require __DIR__.'/../vendor/autoload.php';;

use Route4me\Route4me;
use Route4me\Route;

Route4me::setApiKey('11111111111111111111111111111111');

$routeId = 'AC16E7D338B551013FF34266FE81A5EE';
$route = Route::getRoutes($routeId);

var_dump($route->addresses);
