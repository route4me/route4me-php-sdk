<?php

//**********************************************************************
// Update Schedule
//**********************************************************************

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\V5\RecurringRoutes\Schedules as Schedules;

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

try {
    $schedules = new Schedules;

    $schedule_uid = '1515E9A65DD2DEF79CAD7A7E68D91515';
    $params = [
        'name' => 'The bestest schedule 2',
        'schedule_blacklist' => ['2023-02-01', '2023-03-01'],
        'schedule' => '{"enabled":true,"mode":"daily"}',
        'timezone' => 'America/New_York'
    ];

    $schedule = $schedules->updateSchedule($schedule_uid, $params);

    print_r($schedule);
} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
