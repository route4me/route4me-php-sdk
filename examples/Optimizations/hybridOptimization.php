<?php

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

/* The example demonstrates process of creating a Hybrid Optimization using scheduling addresses and orders.
 * Please, use your own API key for this example.
 * Useful links:
 * http://support.route4me.com/route-planning-help.php?id=manual11:tutorial2:chapter7
 * http://support.route4me.com/route-planning-help.php?id=manual11:tutorial3:chapter12
 */

// This example is not available for demo API key
Route4Me::setApiKey(Constants::API_KEY);

$source_file = 'addresses_1000.csv';
$max_line_length = 512;
$delimiter = ',';

ini_set('max_execution_time', 180);

/* Add Address Book Locations with schedules from a CSV file */

/* Mapping of a CSV file with the address book locations - which of the CSV table column is corresponding to which of the Address Book's field*/
$locationsFieldsMapping['cached_lat'] = 0;
$locationsFieldsMapping['cached_lng'] = 1;
$locationsFieldsMapping['address_alias'] = 2;
$locationsFieldsMapping['address_1'] = 3;
$locationsFieldsMapping['address_city'] = 4;
$locationsFieldsMapping['address_state_id'] = 5;
$locationsFieldsMapping['address_zip'] = 6;
$locationsFieldsMapping['address_phone_number'] = 7;
$locationsFieldsMapping['schedule_mode'] = 8;
$locationsFieldsMapping['schedule_enabled'] = 9;
$locationsFieldsMapping['schedule_every'] = 10;
$locationsFieldsMapping['schedule_weekdays'] = 11;
$locationsFieldsMapping['monthly_mode'] = 12;
$locationsFieldsMapping['monthly_dates'] = 13;
$locationsFieldsMapping['monthly_nth_n'] = 16;
$locationsFieldsMapping['monthly_nth_what'] = 17;

if (false !== ($handle = fopen("$source_file", 'r'))) {
    $oaBook = new AddressBookLocation();

    $results = $oaBook->addLocationsFromCsvFile($handle, $locationsFieldsMapping);

    echo 'Errors: <br><br>';

    foreach ($results['fail'] as $eValue) {
        echo $eValue.'<br>';
    }

    echo 'Successes: <br><br>';

    foreach ($results['success'] as $sValue) {
        echo $sValue.'<br>';
    }
}

/* Add orders with schedules from a CSV file  */

$orders_file = 'orders_baton.csv';

/* Mapping of a CSV file with the orders - which of the CSV table column is corresponding to which of the Order's field */

$ordersFieldsMapping['cached_lat'] = 1;
$ordersFieldsMapping['cached_lng'] = 0;
$ordersFieldsMapping['address_alias'] = 2;
$ordersFieldsMapping['address_1'] = 3;
$ordersFieldsMapping['order_city'] = 4;
$ordersFieldsMapping['order_state_id'] = 5;
$ordersFieldsMapping['order_zip_code'] = 6;
$ordersFieldsMapping['EXT_FIELD_phone'] = 7;
$ordersFieldsMapping['day_scheduled_for_YYMMDD'] = 8;

if (false !== ($handle = fopen("$orders_file", 'r'))) {
    $order = new Order();
    $results = $order->addOrdersFromCsvFile($handle, $ordersFieldsMapping);

    echo 'Errors: <br><br>';

    foreach ($results['fail'] as $eValue) {
        echo $eValue.'<br>';
    }

    echo 'Successes: <br><br>';

    foreach ($results['success'] as $sValue) {
        echo $sValue.'<br>';
    }
}

/* Get Hybrid Optimization */

$ep = time() + 604800;
$scheduleDate = date('Y-m-d', $ep);

$hybridParams = [
    'target_date_string'      => $scheduleDate,
    'timezone_offset_minutes' => 480,
];

$optimization = new OptimizationProblem();
$hybridOptimization = $optimization->getHybridOptimization($hybridParams);

if (null != $hybridOptimization) {
    if (isset($hybridOptimization['optimization_problem_id'])) {
        $optId = $hybridOptimization['optimization_problem_id'];

        echo "Hibrid optimization with optimization_problem_id = $optId <br><br>";

        /* Add depots to the Hybrid Optimization */
        $depotFile = 'depots.csv';

        if (false !== ($handle = fopen("$depotFile", 'r'))) {
            $columns = fgetcsv($handle, $max_line_length, $delimiter);

            if (empty($columns)) {
                $error['message'] = 'Empty';

                return $error;
            }

            $depotsParams = [
                'optimization_problem_id' => $optId,
                'delete_old_depots' => true,
            ];

            $iRow = 1;
            $depotAddresses = [];

            while (false !== ($rows = fgetcsv($handle, $max_line_length, $delimiter))) {
                if ($rows[0] && $rows[1] && $rows[3] && [null] !== $rows) {
                    $depotAddress['lat'] = $rows[0];
                    $depotAddress['lng'] = $rows[1];
                    $depotAddress['address'] = $rows[3];
                    array_push($depotAddresses, $depotAddress);
                }
            }

            $depotsParams['new_depots'] = $depotAddresses;

            $optProblem = new OptimizationProblem();

            $resultDepots = $optProblem->addDepotsToHybrid($depotsParams);

            /* Reoptimize hybrid optimization */

            if (null != $resultDepots) {
                $problemParams = [
                    'optimization_problem_id' => $optId,
                ];
                $problem = OptimizationProblem::reoptimize($problemParams);

                Route4Me::simplePrint($problem);
            }
        }
    }
}
