<?php

//**********************************************************************
// Create Schedule
//**********************************************************************

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Route4Me\V5\RecurringRoutes\Schedules as Schedules;

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

try {
    $schedules = new Schedules;

    $params = [
        'schedule_uid' => '1515E9A65DD2DEF79CAD7A7E68D91515',
        'root_member_id' => 15,
        'name' => 'The bestest schedule 1',
        'schedule_blacklist' => [],
        'schedule' => null,
        'timezone' => 'UTC'
    ];

    $schedule = $schedules->createSchedule($params);

    print_r($schedule);
} catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
