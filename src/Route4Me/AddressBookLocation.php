<?php

namespace Route4Me;

use Route4Me\Enum\Endpoint;

class AddressBookLocation extends Common
{
    public $address_id;
    public $address_group;
    public $address_alias;
    public $address_1;
    public $address_2;
    public $first_name;
    public $last_name;
    public $address_email;
    public $address_phone_number;
    public $address_city;
    public $address_state_id;
    public $address_country_id;
    public $address_zip;
    public $cached_lat;
    public $cached_lng;
    public $curbside_lat;
    public $curbside_lng;
    public $color;
    public $address_custom_data;
    public $schedule;

    public $created_timestamp;
    public $member_id;
    public $schedule_blacklist;
    public $in_route_count;
    public $last_visited_timestamp;
    public $last_routed_timestamp;
    public $local_time_window_start;
    public $local_time_window_end;
    public $local_time_window_start_2;
    public $local_time_window_end_2;
    public $service_time;
    public $local_timezone_string;
    public $address_icon;
    public $address_stop_type;
    public $address_cube;
    public $address_pieces;
    public $address_reference_no;
    public $address_revenue;
    public $address_weight;
    public $address_priority;
    public $address_customer_po;

    public function __construct()
    {
        Route4Me::setBaseUrl(Endpoint::BASE_URL);
    }

    public static function fromArray(array $params)
    {
        $addressbooklocation = new self();

        foreach ($params as $key => $value) {
            if (property_exists($addressbooklocation, $key)) {
                $addressbooklocation->{$key} = $value;
            }
        }

        return $addressbooklocation;
    }

    public static function getAddressBookLocation($addressId)
    {
        $ablocations = Route4Me::makeRequst([
            'url' => Endpoint::ADDRESS_BOOK_V4,
            'method' => 'GET',
            'query' => [
                'query' => $addressId,
                'limit' => 30,
            ],
        ]);

        return $ablocations;
    }

    public static function searchAddressBookLocations($params)
    {
        $allQueryFields = ['display', 'query', 'fields', 'limit', 'offset'];

        $result = Route4Me::makeRequst([
            'url' => Endpoint::ADDRESS_BOOK_V4,
            'method' => 'GET',
            'query' => Route4Me::generateRequestParameters($allQueryFields, $params),
        ]);

        return $result;
    }

    public static function getAddressBookLocations($params)
    {
        $allQueryFields = ['limit', 'offset', 'address_id'];

        $ablocations = Route4Me::makeRequst([
            'url' => Endpoint::ADDRESS_BOOK_V4,
            'method' => 'GET',
            'query' => Route4Me::generateRequestParameters($allQueryFields, $params),
        ]);

        return $ablocations;
    }

    public static function getRandomAddressBookLocation($params)
    {
        $ablocations = self::getAddressBookLocations($params);

        if (isset($ablocations['results'])) {
            $locationsSize = sizeof($ablocations['results']);

            if ($locationsSize > 0) {
                $randomLocationIndex = rand(0, $locationsSize - 1);

                return $ablocations['results'][$randomLocationIndex];
            }
        }

        return null;
    }

    /**
     * @param AddressBookLocation $params
     */
    public static function addAdressBookLocation($params)
    {
        $allBodyFields = Route4Me::getObjectProperties(new self(), ['address_id', 'in_route_count']);

        $response = Route4Me::makeRequst([
            'url' => Endpoint::ADDRESS_BOOK_V4,
            'method' => 'POST',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params),
        ]);

        return $response;
    }

    public function deleteAdressBookLocation($address_ids)
    {
        $result = Route4Me::makeRequst([
            'url' => Endpoint::ADDRESS_BOOK_V4,
            'method' => 'DELETEARRAY',
            'query' => [
                'address_ids' => $address_ids,
            ],
        ]);

        return $result;
    }

    public function updateAddressBookLocation($params)
    {
        $allBodyFields = Route4Me::getObjectProperties(new self(), ['in_route_count']);

        $response = Route4Me::makeRequst([
            'url' => Endpoint::ADDRESS_BOOK_V4,
            'method' => 'PUT',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params),
        ]);

        return $response;
    }

    public static function validateScheduleMode($scheduleMode)
    {
        $schedModes = ['daily', 'weekly', 'monthly', 'annually'];

        if (in_array($scheduleMode, $schedModes)) {
            return true;
        } else {
            return false;
        }
    }

    public static function validateScheduleEnable($scheduleEnabled)
    {
        $schedEnables = [true, false];

        if (in_array($scheduleEnabled, $schedEnables)) {
            return true;
        } else {
            return false;
        }
    }

    public static function validateScheduleEvery($scheduleEvery)
    {
        if (is_numeric($scheduleEvery)) {
            return true;
        } else {
            return false;
        }
    }

    public static function validateScheduleWeekDays($scheduleWeekDays)
    {
        $weekdays = explode(',', $scheduleWeekDays);
        $weekdaysSize = sizeof($weekdays);

        if ($weekdaysSize < 1) {
            return false;
        }

        $isValid = true;

        for ($i = 0; $i < $weekdaysSize; ++$i) {
            if (is_numeric($weekdays[$i])) {
                $wday = intval($weekdays[$i]);
                if ($wday < 1 || $wday > 7) {
                    $isValid = false;
                }
            } else {
                $isValid = false;
            }
        }

        return $isValid;
    }

    public static function validateScheduleMonthlyMode($scheduleMonthlyMode)
    {
        $schedMonthlyMmodes = ['dates', 'nth'];

        if (in_array($scheduleMonthlyMode, $schedMonthlyMmodes)) {
            return true;
        } else {
            return false;
        }
    }

    public static function validateScheduleMonthlyDates($scheduleMonthlyDates)
    {
        $monthlyDates = explode(',', $scheduleMonthlyDates);
        $monthlyDatesSize = sizeof($monthlyDates);

        if ($monthlyDatesSize < 1) {
            return false;
        }

        $isValid = true;

        for ($i = 0; $i < $monthlyDatesSize; ++$i) {
            if (is_numeric($monthlyDates[$i])) {
                $mday = intval($monthlyDates[$i]);
                if ($mday < 1 || $mday > 31) {
                    $isValid = false;
                }
            } else {
                $isValid = false;
            }
        }

        return $isValid;
    }

    public static function validateScheduleNthN($scheduleNthN)
    {
        if (!is_numeric($scheduleNthN)) {
            return false;
        }

        $schedNthNs = [1, 2, 3, 4, 5, -1];

        if (in_array($scheduleNthN, $schedNthNs)) {
            return true;
        } else {
            return false;
        }
    }

    public static function validateScheduleNthWhat($scheduleNthWhat)
    {
        if (!is_numeric($scheduleNthWhat)) {
            return false;
        }

        $schedNthWhats = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

        if (in_array($scheduleNthWhat, $schedNthWhats)) {
            return true;
        } else {
            return false;
        }
    }

    /** Function adds the locations (with/without schedule) from the CSV file.
     * $csvFileHandle - a file handler.
     * Returns array $results which contains two arrays: fail and succes.
     */
    public function addLocationsFromCsvFile($csvFileHandle, $locationsFieldsMapping)
    {
        $max_line_length = 512;
        $delemietr = ',';

        $results = [];
        $results['fail'] = [];
        $results['success'] = [];

        $columns = fgetcsv($csvFileHandle, $max_line_length, $delemietr);

        $addressBookFields = Route4Me::getObjectProperties(new self(), ['address_id', 'in_route_count']);

        if (empty($columns)) {
            array_push($results['fail'], 'Empty CSV table');

            return $results;
        }

        $iRow = 1;

        while (false !== ($rows = fgetcsv($csvFileHandle, $max_line_length, $delemietr))) {
            if (!isset($rows[$locationsFieldsMapping['cached_lat']]) || !isset($rows[$locationsFieldsMapping['cached_lng']])
                  || !isset($rows[$locationsFieldsMapping['address_1']]) || [null] == $rows) {
                continue;
            }

            $curSchedule = '';
            $mode = '';

            $failCount = sizeof($results['fail']);

            if (isset($rows[$locationsFieldsMapping['schedule_mode']])) {
                if ($this->validateScheduleMode($rows[$locationsFieldsMapping['schedule_mode']])) {
                    $curSchedule = '"mode":"'.$rows[$locationsFieldsMapping['schedule_mode']].'",';
                    $mode = $rows[$locationsFieldsMapping['schedule_mode']];
                } else {
                    array_push($results['fail'], "$iRow --> Wrong schedule mode parameter");
                }
            } else {
                array_push($results['fail'], "$iRow --> The schedule mode parameter is not set");
            }

            if (isset($rows[$locationsFieldsMapping['schedule_enabled']])) {
                if ($this->validateScheduleEnable($rows[$locationsFieldsMapping['schedule_enabled']])) {
                    $curSchedule .= '"enabled":'.$rows[$locationsFieldsMapping['schedule_enabled']].',';
                } else {
                    array_push($results['fail'], "$iRow --> The schedule enabled parameter is not set ");
                }
            }

            if (isset($rows[$locationsFieldsMapping['schedule_every']])) {
                if ($this->validateScheduleEvery($rows[$locationsFieldsMapping['schedule_every']])) {
                    $curSchedule .= '"'.$mode.'":{'.'"every":'.$rows[$locationsFieldsMapping['schedule_every']].',';
                    if ('daily' == $mode) {
                        $curSchedule = trim($curSchedule, ',');
                        $curSchedule .= '}';
                    }
                } else {
                    array_push($results['fail'], "$iRow --> The parameter sched_every is not set");
                }
            }

            if ('daily' != $mode) {
                switch ($mode) {
                    case 'weekly':
                        if (isset($rows[$locationsFieldsMapping['schedule_weekdays']])) {
                            if ($this->validateScheduleWeekDays($rows[$locationsFieldsMapping['schedule_weekdays']])) {
                                $curSchedule .= '"weekdays":['.$rows[$locationsFieldsMapping['schedule_weekdays']].']}';
                            } else {
                                array_push($results['fail'], "$iRow --> Wrong weekdays");
                            }
                        } else {
                            array_push($results['fail'], "$iRow --> The parameters sched_weekdays is not set");
                        }
                        break;
                    case 'monthly':
                        $monthlyMode = '';
                        if (isset($rows[$locationsFieldsMapping['monthly_mode']])) {
                            if ($this->validateScheduleMonthlyMode($rows[$locationsFieldsMapping['monthly_mode']])) {
                                $monthlyMode = $rows[$locationsFieldsMapping['monthly_mode']];
                                $curSchedule .= '"mode": "'.$rows[$locationsFieldsMapping['monthly_mode']].'",';
                            } else {
                                array_push($results['fail'], "$iRow --> Wrong monthly mode");
                            }
                        } else {
                            array_push($results['fail'], "$iRow --> The parameter sched_monthly_mode is not set");
                        }

                        if ('' != $monthlyMode) {
                            switch ($monthlyMode) {
                                case 'dates':
                                    if (isset($rows[$locationsFieldsMapping['monthly_dates']])) {
                                        if ($this->validateScheduleMonthlyDates($rows[$locationsFieldsMapping['monthly_dates']])) {
                                            $curSchedule .= '"dates":['.$rows[$locationsFieldsMapping['monthly_dates']].']}';
                                        } else {
                                            array_push($results['fail'], "$iRow --> Wrong monthly dates");
                                        }
                                    }
                                    break;
                                case 'nth':
                                    if (isset($rows[$locationsFieldsMapping['monthly_nth_n']])) {
                                        if ($this->validateScheduleNthN($rows[$locationsFieldsMapping['monthly_nth_n']])) {
                                            $curSchedule .= '"nth":{"n":'.$rows[$locationsFieldsMapping['monthly_nth_n']].',';
                                        } else {
                                            array_push($results['fail'], "$iRow --> Wrong parameter sched_nth_n");
                                        }
                                    } else {
                                        array_push($results['fail'], "$iRow --> The parameter sched_nth_n is not set");
                                    }

                                    if ('' != $curSchedule) {
                                        if (isset($rows[$locationsFieldsMapping['monthly_nth_what']])) {
                                            if ($this->validateScheduleNthWhat($rows[$locationsFieldsMapping['monthly_nth_what']])) {
                                                $curSchedule .= '"what":'.$rows[$locationsFieldsMapping['monthly_nth_what']].'}}';
                                            } else {
                                                array_push($results['fail'], "$iRow --> Wrong parameter sched_nth_what");
                                            }
                                        } else {
                                            array_push($results['fail'], "$iRow --> The parameter sched_nth_what is not set");
                                        }
                                    }
                                    break;
                            }
                        }
                        break;
                    default:
                        $curSchedule = '';
                        break;
                }
            }

            if (sizeof($results['fail']) > $failCount) {
                $curSchedule = '';
            }

            if (('daily' == $mode || 'weekly' == $mode || 'monthy' == $mode) && '' == $curSchedule) {
                ++$iRow;
                continue;
            }

            $curSchedule = strtolower($curSchedule);

            $curSchedule = '[{'.$curSchedule.'}]';

            $parametersArray = [];

            foreach ($addressBookFields as $addressBookField) {
                if (isset($locationsFieldsMapping[$addressBookField])) {
                    $parametersArray[$addressBookField] = $rows[$locationsFieldsMapping[$addressBookField]];
                }
            }

            $AdressBookLocationParameters = self::fromArray($parametersArray);

            $abContacts = new self();

            $abcResults = $abContacts->addAdressBookLocation($AdressBookLocationParameters); //temporarry

            array_push($results['success'], 'The schedule location with address_id = '.strval($abcResults['address_id']).' added successfuly.');
        }

        return $results;
    }
}
