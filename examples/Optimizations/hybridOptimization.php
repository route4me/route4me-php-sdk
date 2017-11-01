<?php
namespace Route4Me;

$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

require $vdir.'/../vendor/autoload.php';

use Route4Me\OptimizationProblem;
use Route4Me\Route;
use Route4Me\Route4Me;

/* The example demonstrates process of creating a Hybrid Optimization using scheduling addresses and orders.
 * Useful links:
 * http://support.route4me.com/route-planning-help.php?id=manual11:tutorial2:chapter7
 * http://support.route4me.com/route-planning-help.php?id=manual11:tutorial3:chapter12
 */ 

Route4Me::setApiKey('11111111111111111111111111111111');

$source_file="addresses_1000.csv";
$max_line_length = 512;
$delemietr=',';


/* Add Address Book Locations with schedules */

if (($handle = fopen("$source_file", "r")) !== FALSE) {
        $columns = fgetcsv($handle, $max_line_length, $delemietr);
        if (!$columns) {
            $error['message'] = 'Empty';
             return ($error);
        }
        
        $iRow=1;
        
        while (($rows = fgetcsv($handle, $max_line_length, $delemietr)) !== false) {
            //if ($iRow==1) {$iRow++; continue;}
            
            if ($rows[0] && $rows[1] && $rows[3] && array(null) !== $rows) { // ignore blank lines
                    //$data1 = $rows[0].", ".$rows[1].", ".$rows[3];
                    
                    $schedule="";
                    $mode="";
                    
                    if (isset($rows[8])) {
                        if (AddressBookLocation::validateScheduleMode($rows[8])) {
                            $schedule='"mode":"'.$rows[8].'",'; 
                            $mode=$rows[8];
                        }
                        else {echo "$iRow --> Wrong schedule mode parameter <br>"; $schedule="";}
                    }
                    else {echo "$iRow --> The schedule mode parameter is not set <br>"; $schedule="";}
                    
                    if ($schedule=="") {$iRow++; continue;}
                    
                    if (isset($rows[9])) {
                        if (AddressBookLocation::validateScheduleEnable($rows[9])) { 
                            $schedule.='"enabled":'.$rows[9].',';
                        }
                        else {echo "$iRow --> The schedule enabled parameter is not set <br>"; $schedule="";}
                    }
                    
                    if ($schedule=="") {$iRow++; continue;}
                    
                    if (isset($rows[10])) {
                        if (AddressBookLocation::validateScheduleEvery($rows[10])) {
                            $schedule.='"'.$mode.'":{'.'"every":'.$rows[10].','; 
                            if ($mode=='daily') {
                                $schedule=trim($schedule,',');
                                $schedule.='}';
                            }
                        }
                        else {echo "$iRow --> The parameter sched_every is not set <br>"; $schedule=""; }
                    }
                    
                    if ($schedule=="") {$iRow++; continue;}
                    
                    if ($mode!='daily') {
                        switch ($mode) {
                            case 'weekly':
                                if (isset($rows[11])) {
                                    if (AddressBookLocation::validateScheduleWeekDays($rows[11])) {
                                         $schedule.='"weekdays":['.$rows[11].']}';
                                    }
                                    else {echo "$iRow --> Wrong weekdays <br>";$schedule="";}
                                }
                                else {echo "$iRow --> The parameters sched_weekdays is not set <br>"; $schedule="";}
                                break;
                            case 'monthly':
                                $monthlyMode="";
                                if (isset($rows[12])) {
                                    if (AddressBookLocation::validateScheduleMonthlyMode($rows[12])) {
                                         $monthlyMode=$rows[12];
                                         $schedule.='"mode": "'.$rows[12].'",';
                                    }
                                    else {echo "$iRow --> Wrong monthly mode <br>"; $schedule="";}
                                }
                                else {echo "$iRow --> The parameter sched_monthly_mode is not set <br>"; $schedule="";}
                                
                                if ($monthlyMode!="") {
                                    switch ($monthlyMode) {
                                        case 'dates':
                                            if (isset($rows[13])) {
                                                if (AddressBookLocation::validateScheduleMonthlyDates($rows[13])) {
                                                     $schedule.='"dates":['.$rows[13].']}';
                                                }
                                                else {echo "$iRow --> Wrong monthly dates <br>"; $schedule="";}
                                            }
                                            break;
                                        case 'nth':
                                            if (isset($rows[16])) {
                                                if (AddressBookLocation::validateScheduleNthN($rows[16])) {
                                                     $schedule.='"nth":{"n":'.$rows[16].',';
                                                }
                                                else {echo "$iRow --> Wrong parameter sched_nth_n <br>"; $schedule="";}
                                            }
                                            else {echo "$iRow --> The parameter sched_nth_n is not set <br>"; $schedule="";}
                                            
                                            if ($schedule!="") {
                                                if (isset($rows[17])) {
                                                    if (AddressBookLocation::validateScheduleNthWhat($rows[17])) {
                                                         $schedule.='"what":'.$rows[17].'}}';
                                                    }
                                                    else {echo "$iRow --> Wrong parameter sched_nth_what <br>"; $schedule="";}
                                                }
                                                else {echo "$iRow --> The parameter sched_nth_what is not set <br>"; $schedule="";}
                                            }
                                            
                                            break;
                                    }
                                }
                                break;
                            default:
                                $schedule=="";
                                break;
                        }
                        
                    }
                    
                    if ($schedule=="") {$iRow++; continue;}
                    
                    $schedule=strtolower($schedule);
                    
                    $schedule='[{'.$schedule.'}]';

                    //echo "$iRow --> ".$schedule."<br>";
                    $oSchedule= json_decode($schedule,TRUE);
                    
                    //echo "<br>"; var_dump($oSchedule); echo "<br>";
                    
                    $AdressBookLocationParameters=AddressBookLocation::fromArray(array(
                        "cached_lat"    => $rows[0],
                        "cached_lng"    => $rows[1],
                        "address_alias"     => $rows[2],
                        "address_1"     => $rows[3],
                        "address_city"     => isset($rows[4]) ? $rows[4] : null,
                        "address_state_id"     => isset($rows[5]) ? $rows[5] : null,
                        "address_zip"     => isset($rows[6]) ? "$rows[6]" : null,
                        "address_phone_number"  => isset($rows[7]) ? $rows[7] : null,
                        "schedule" => isset($oSchedule) ? $oSchedule : null,
                    ));
                    
                    $abContacts=new AddressBookLocation();
    
                    $abcResults=$abContacts->addAdressBookLocation($AdressBookLocationParameters); //temporarry
                    
                    echo "The schedule location with address_id = ".strval($abcResults["address_id"])." added successfuly <br>"; //temporarry
              }
              else echo "$iRow --> Wrong Address or latitude or longitude <br>";
              $iRow++;
            }
    }

/* Get Hybrid Optimization */

    $ep = time()+604800;
    $sched_date = date("Y-m-d", $ep);

    $hybridParams = array(
        "target_date_string" => $sched_date,
        "timezone_offset_minutes" => 480
    );
    
    $optimization = new OptimizationProblem(); 
    $hybridOptimization = $optimization->getHybridOptimization($hybridParams);
    
    if ($hybridOptimization!=null) {
        
        if (isset($hybridOptimization['optimization_problem_id'])) {
            $optid = $hybridOptimization['optimization_problem_id'];
            
            echo "Hibrid optimization with optimization_problem_id=$optid <br><br>";
            
            /* Add depots to the Hybrid Optimization */
            $depotfile = "depots.csv";
            
            if (($handle = fopen("$depotfile", "r")) !== FALSE) {
                
                $columns = fgetcsv($handle, $max_line_length, $delemietr);
                
                if (!$columns) {
                    $error['message'] = 'Empty';
                     return ($error);
                }
                
                $depotsParams = array(
                    'optimization_problem_id' => $optid,
                    'delete_old_depots'  => true,
                );
                
                $iRow=1;
                $depotAddresses = array();
                
                while (($rows = fgetcsv($handle, $max_line_length, $delemietr)) !== false) {
                    if ($rows[0] && $rows[1] && $rows[3] && array(null) !== $rows) {
                        $depotAddress['lat']= $rows[0];
                        $depotAddress['lng']= $rows[1];
                        $depotAddress['address']= $rows[3];   
                        array_push($depotAddresses,$depotAddress);
                    }
                }
                
                $depotsParams['new_depots'] = $depotAddresses;
                
                $optProblem = new OptimizationProblem();
                
                $resultDepots = $optProblem->addDepotsToHybrid($depotsParams);
                
                var_dump($resultDepots);
                
                /* Reoptimize hybrid optimization */
                
                if ($resultDepots!=null) {
                    $problemParams = array(
                        'optimization_problem_id'  =>  $optid
                    );
                    $problem = OptimizationProblem::reoptimize($problemParams);
                    
                    Route4Me::simplePrint($problem);
                }
            }
                
        }

    }
?>