<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

// The example requires an API key with the enterprise subscription.

// Set the api key in the Route4Me class
Route4Me::setApiKey(Constants::API_KEY);

$now            = new \DateTime();

$schedCalendarParams = new ScheduleCalendarParameters();

$schedCalendarParams->date_from_string   = $now->add(\DateInterval::createFromDateString('-5 days'))->format('Y-m-d');
$schedCalendarParams->date_to_string     = $now->add(\DateInterval::createFromDateString('5 days'))->format('Y-m-d');
$schedCalendarParams->orders             = true;
$schedCalendarParams->ab                 = true;
$schedCalendarParams->routes_count       = true;

$scheduleCalendar = $schedCalendarParams->getScheduleCalendar($schedCalendarParams);

Route4Me::simplePrint($scheduleCalendar);
