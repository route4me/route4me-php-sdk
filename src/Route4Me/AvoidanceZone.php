<?php

namespace Route4Me;

use Route4Me\Exception\BadParam;
use Route4Me\Enum\Endpoint;

class AvoidanceZone extends Common
{
    public $territory_id; // Avoidance zone id
    public $territory_name;
    public $territory_color;
    public $orders;
    public $member_id;
    public $territory; // Territory parameters

    public function __construct()
    {
        Route4Me::setBaseUrl(Endpoint::BASE_URL);
    }

    public static function fromArray(array $params)
    {
        if (!isset($params['territory_name'])) {
            throw new BadParam('Territory name must be provided');
        }

        if (!isset($params['territory_color'])) {
            throw new BadParam('Territory color must be provided');
        }

        if (!isset($params['territory'])) {
            throw new BadParam('Territory must be provided');
        }

        $avoidanceZoneParameters = new self();

        foreach ($params as $key => $value) {
            if (property_exists($avoidanceZoneParameters, $key)) {
                $avoidanceZoneParameters->{$key} = $value;
            }
        }

        return $avoidanceZoneParameters;
    }

    public static function getAvoidanceZone($territory_id)
    {
        $avoidanceZone = Route4Me::makeRequst([
            'url'       => Endpoint::AVOIDANCE_ZONE,
            'method'    => 'GET',
            'query'     => [
                'territory_id' => $territory_id,
            ],
        ]);

        return $avoidanceZone;
    }

    public static function getAvoidanceZones($params)
    {
        $avoidanceZones = Route4Me::makeRequst([
            'url'       => Endpoint::AVOIDANCE_ZONE,
            'method'    => 'GET',
            'query'     => [
                'offset' => isset($params->offset) ? $params->offset : null,
                'limit'  => isset($params->limit) ? $params->limit : null,
            ],
        ]);

        return $avoidanceZones;
    }

    public static function addAvoidanceZone($params)
    {
        $terParams = [];

        if (isset($params->territory['type'])) {
            $terParams['type'] = $params->territory['type'];
        }

        if (isset($params->territory['data'])) {
            $terParams['data'] = $params->territory['data'];
        }

        $abContacts = Route4Me::makeRequst([
            'url'       => Endpoint::AVOIDANCE_ZONE,
            'method'    => 'POST',
            'body'      => [
                'territory_name'    => isset($params->territory_name) ? $params->territory_name : null,
                'territory_color'   => isset($params->territory_color) ? $params->territory_color : null,
                'territory'         => $terParams,
            ],
        ]);

        return $abContacts;
    }

    public function deleteAvoidanceZone($territory_id)
    {
        $result = Route4Me::makeRequst([
            'url'       => Endpoint::AVOIDANCE_ZONE,
            'method'    => 'DELETEARRAY',
            'query'     => [
                'territory_id' => $territory_id,
            ],
        ]);

        return $result;
    }

    public function updateAvoidanceZone($params)
    {
        $avoidanceZone = Route4Me::makeRequst([
            'url'       => Endpoint::AVOIDANCE_ZONE,
            'method'    => 'PUT',
            'body'      => $params,
        ]);

        return $avoidanceZone;
    }
}
