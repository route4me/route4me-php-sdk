<?php

namespace Route4Me;

use Route4Me\Enum\Endpoint;

class Track extends Common
{
    public static function set(TrackSetParams $params)
    {
        $allQueryFields = Route4Me::getObjectProperties(new TrackSetParams(), ['tx_id']);

        $json = Route4Me::makeRequst([
            'url' => Endpoint::TRACK_SET,
            'method' => 'GET',
            'query' => Route4Me::generateRequestParameters($allQueryFields, $params),
        ]);

        return $json;
    }

    public static function getUserLocations($query=null)
    {
        $json = Route4Me::makeRequst([
            'url' => Endpoint::USER_LOCATION,
            'method' => 'GET',
            'query' => isset($query) ? ['query' => $query] : null
        ]);

        return $json;
    }
}
