<?php

namespace Route4Me;

use Route4Me\Enum\Endpoint;
use Route4Me\Common as Common;

/**
 * Address book contact class.
 * @package Route4Me
 */
class AddressBookLocation extends Common
{
    /**
     * A territory shape name the contact belongs.
     * @var string
     */
    public $address_id;

    /**
     * A group the contact belongs.
     * @var string
     */
    public $address_group;

    /**
     * The contact's alias.
     * @var string
     */
    public $address_alias;

    /**
     * The geographic address of the contact.
     * @var string
     */
    public $address_1;

    /**
     * Second geographic address of the contact.
     * @var string
     */
    public $address_2;

    /**
     * The first name of the contact person.
     * @var string
     */
    public $first_name;

    /**
     * The last name of the contact person.
     * @var string
     */
    public $last_name;

    /**
     * The contact's email.
     * @var string
     */
    public $address_email;

    /**
     * The contact's phone number.
     * @var string
     */
    public $address_phone_number;

    /**
     * A city the contact belongs.
     * @var string
     */
    public $address_city;

    /**
     * The ID of the state the contact belongs.
     * @var string
     */
    public $address_state_id;

    /**
     * The ID of the country the contact belongs.
     * @var string
     */
    public $address_country_id;

    /**
     * The contact's ZIP code.
     * @var string
     */
    public $address_zip;

    /**
     * A latitude of the contact's cached position.
     * @var double
     */
    public $cached_lat;

    /**
     * A longitude of the contact's cached position.
     * @var double
     */
    public $cached_lng;

    /**
     * A latitude of the contact's curbside.
     * @var double
     */
    public $curbside_lat;

    /**
     * A longitude of the contact's curbside.
     * @var double
     */
    public $curbside_lng;

    /**
     * The contact's color on the map.
     * @var string
     */
    public $color;

    /**
     * An array of the contact's custom field-value pairs.
     * @var array
     */
    public $address_custom_data;

    /**
     * An array of the contact's schedules.
     * @var Schedule[]
     */
    public $schedule;

    /**
     * Time when the contact was created.
     * @var long
     */
    public $created_timestamp;

    /**
     * Unique ID of the member.
     * @var integer
     */
    public $member_id;

    /**
     * The list of dates that should be omitted from the schedules.
     * @var string[]
     */
    public $schedule_blacklist;

    /**
     * Number of the routes containing the contact.
     * @var integer
     */
    public $in_route_count;

    /**
     * When the contact was last visited.
     * @var long
     */
    public $last_visited_timestamp;

    /**
     * When the contact was last routed.
     * @var long
     */
    public $last_routed_timestamp;

    /**
     * Start of the contact's local time window.
     * @var long
     */
    public $local_time_window_start;

    /**
     * End of the contact's local time window.
     * @var long
     */
    public $local_time_window_end;

    /**
     * Start of the contact's second local time window.
     * @var long
     */
    public $local_time_window_start_2;

    /**
     * End of the contact's second local time window.
     * @var long
     */
    public $local_time_window_end_2;

    /**
     * The service time at the contact's address.
     * @var integer
     */
    public $service_time;

    /**
     * The contact's local timezone.
     * @var string
     */
    public $local_timezone_string;

    /**
     * The contact's icon on the map.
     * @var string
     */
    public $address_icon;

    /**
     * The contact's stop type.
     * @var string
     */
    public $address_stop_type;

    /**
     * The cubic volume of the contact's cargo.
     * @var double
     */
    public $address_cube;

    /**
     * The number of pieces/pallets that this destination/order/line-item consumes/contains on a vehicle.
     * @var integer
     */
    public $address_pieces;

    /**
     * The reference number of the address.
     * @var string
     */
    public $address_reference_no;

    /**
     * The revenue from the contact.
     * @var double
     */
    public $address_revenue;

    /**
     * The weight of the contact's cargo.
     * @var double
     */
    public $address_weight;

    /**
     * If present, the priority will sequence addresses in all the optimal routes so that
     * higher priority addresses are general at the beginning of the route sequence.<br>
     * 1 is the highest priority, 100000 is the lowest.
     * @var integer
     */
    public $address_priority;

    /**
     * The customer purchase order of the contact.
     * @var string
     */
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
            'query'  => [
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
            'query'  => Route4Me::generateRequestParameters($allQueryFields, $params),
        ]);

        return $result;
    }

    public static function getAddressBookLocations($params)
    {
        $allQueryFields = ['limit', 'offset', 'address_id'];

        $ablocations = Route4Me::makeRequst([
            'url' => Endpoint::ADDRESS_BOOK_V4,
            'method' => 'GET',
            'query'  => Route4Me::generateRequestParameters($allQueryFields, $params),
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
            'url'       => Endpoint::ADDRESS_BOOK_V4,
            'method'    => 'POST',
            'body'      => Route4Me::generateRequestParameters($allBodyFields, $params),
        ]);

        return $response;
    }

    public function deleteAdressBookLocation($address_ids)
    {
        $result = Route4Me::makeRequst([
            'url'       => Endpoint::ADDRESS_BOOK_V4,
            'method'    => 'DELETEARRAY',
            'query'     => [
                'address_ids' => $address_ids,
            ],
        ]);

        return $result;
    }

    public function updateAddressBookLocation($params)
    {
        $allBodyFields = Route4Me::getObjectProperties(new self(), ['in_route_count']);

        $response = Route4Me::makeRequst([
            'url'       => Endpoint::ADDRESS_BOOK_V4,
            'method'    => 'PUT',
            'body'      => Route4Me::generateRequestParameters($allBodyFields, $params),
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
        if (is_string($scheduleEnabled)) {
            if (strtolower($scheduleEnabled)=="true") $scheduleEnabled = true;
            if (strtolower($scheduleEnabled)=="false") $scheduleEnabled = false;
        }

        $schedEnables = [true, false,];

        if (in_array($scheduleEnabled, $schedEnables,true)) {
            return true;
        } else {
            return false;
        }
    }

    public static function validateScheduleEvery($scheduleEvery)
    {
        if (is_numeric($scheduleEvery)) {
            if ($scheduleEvery>0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function validateScheduleWeekDays($scheduleWeekDays)
    {
        if (is_bool($scheduleWeekDays)) return false;

        $weekdays = explode(',', $scheduleWeekDays);
        $weekdaysSize = sizeof($weekdays);

        if ($weekdaysSize < 1) {
            return false;
        }

        $isValid = true;

        for ($i = 0; $i < $weekdaysSize; ++$i) {
            if (is_bool($weekdays[$i])) {
                $isValid = false;
            } elseif (is_numeric($weekdays[$i])) {
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

        if (in_array($scheduleMonthlyMode, $schedMonthlyMmodes,true)) {
            return true;
        } else {
            return false;
        }
    }

    public static function validateScheduleMonthlyDates($scheduleMonthlyDates)
    {
        if (is_bool($scheduleMonthlyDates)) return false;

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

            array_push(
                $results['success'],
                'The schedule location with address_id = '.strval($abcResults['address_id']).' added successfuly.'
            );
        }

        return $results;
    }
}
