<?php

namespace Route4Me\Tracking;

use Route4Me;
use Route4Me\Enum\Endpoint;

class Track extends \Route4Me\Common
{
    public function __construct()
    {
        Route4Me\Route4Me::setBaseUrl(Endpoint::BASE_URL);
    }

    public static function set(TrackSetParams $params)
    {
        $allQueryFields = Route4Me\Route4Me::getObjectProperties(new TrackSetParams(), ['tx_id']);

        $json = Route4Me\Route4Me::makeRequst([
            'url' => Endpoint::TRACK_SET,
            'method' => 'GET',
            'query' => Route4Me\Route4Me::generateRequestParameters($allQueryFields, $params),
        ]);

        return $json;
    }

    public static function getUserLocations($query=null)
    {
        $json = Route4Me\Route4Me::makeRequst([
            'url' => Endpoint::USER_LOCATION,
            'method' => 'GET',
            'query' => isset($query) ? ['query' => $query] : null
        ]);

        return $json;
    }
}
