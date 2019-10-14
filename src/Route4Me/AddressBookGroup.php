<?php

namespace Route4Me;

use Route4Me\Enum\Endpoint;

class AddressBookGroup extends Common
{
    public $group_id;
    public $group_name;
    public $group_color;
    public $group_icon;
    public $member_id;
    public $filter;

    public function __construct()
    {
        Route4Me::setBaseUrl(Endpoint::BASE_URL);
    }

    public static function fromArray(array $params)
    {
        $addressBookGroup = new self();

        foreach ($params as $key => $value) {
            if (property_exists($addressBookGroup, $key)) {
                $addressBookGroup->{$key} = $value;
            }
        }

        return $addressBookGroup;
    }

    public static function getAddressBookGroup(array $params)
    {
        $abGroup = Route4Me::makeRequst([
            'url' => Endpoint::ADDRESS_BOOK_GROUP,
            'method' => 'GET',
            'query' => [
                'group_id' => isset($params['group_id']) ?  $params['group_id'] : null,
            ],
        ]);

        return $abGroup;
    }

    public static function updateAddressBookGroup(array $params)
    {
        $allBodyFields = ['group_id', 'group_color', 'group_icon', 'filter'];

        $abGroup = Route4Me::makeRequst([
            'url' => Endpoint::ADDRESS_BOOK_GROUP,
            'method' => 'PUT',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params),
        ]);

        return $abGroup;
    }

    public static function removeAddressBookGroup(array $params)
    {
        $allBodyFields = ['group_id'];

        $abGroup = Route4Me::makeRequst([
            'url' => Endpoint::ADDRESS_BOOK_GROUP,
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params),
        ]);

        return $abGroup;
    }

    public static function createAddressBookGroup(array $params)
    {
        $allBodyFields = ['group_name', 'group_color', 'group_icon', 'filter'];

        $abGroup = Route4Me::makeRequst([
            'url' => Endpoint::ADDRESS_BOOK_GROUP,
            'method' => 'POST',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params),
        ]);

        return $abGroup;
    }

    public static function  searchAddressBookGroups(array $params)
    {
        $allBodyFields = ['fields', 'offset', 'limit', 'filter'];

        $abGroups = Route4Me::makeRequst([
            'url' => Endpoint::ADDRESS_BOOK_V4,
            'method' => 'POST',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params),
        ]);

        return $abGroups;
    }

    public static function getAddressBookContactsByGroup(array $params)
    {
        $allBodyFields = ['fields', 'group_id'];

        $abGroups = Route4Me::makeRequst([
            'url' => Endpoint::ADDRESS_BOOK_SEARCH,
            'method' => 'POST',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params),
        ]);

        return $abGroups;
    }

    public static function getAddressBookGroups(array $params)
    {
        $abGroup = Route4Me::makeRequst([
            'url' => Endpoint::ADDRESS_BOOK_GROUP,
            'method' => 'GET',
            'query' => [
                'offset' => isset($params['offset']) ?  $params['offset'] : null,
                'limit' => isset($params['limit']) ?  $params['limit'] : null,
            ],
        ]);

        return $abGroup;
    }

    public static function getRandomAddressBookGroup(array $params)
    {
        $abGroups = self::getAddressBookGroups($params);

        if (isset($abGroups) && sizeof($abGroups>1)) {
            $groupsSize = sizeof($abGroups);

                $randomGroupIndex = rand(0, $groupsSize - 1);

                return $abGroups[$randomGroupIndex];
        }

        return null;
    }

    public static function getAddressBookGroupIdByName($name)
    {
        $abGroups = self::getAddressBookGroups(['offset'=>0,'limit'=>100]);

        $abGroupId = null;

        foreach ($abGroups as $abg) {
            if (isset($abg['group_name'])) {
                if ($abg['group_name']==$name) {
                    $abGroupId = $abg['group_id'];
                    break;
                }
            }
        }

        return $abGroupId;
    }
}
