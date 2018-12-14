<?php

namespace Route4Me;

use Route4Me\Route4Me;
use Route4Me\TrackSetParams;
use Route4Me\Enum\Endpoint;

class Track extends Common
{
    public static function set(TrackSetParams $param)
    {
        $query = array_merge($param->toArray(), array(
            'api_key' => Route4Me::getApiKey()
        ));

        $json = Route4Me::makeRequst(array(
            'url'    => Endpoint::TRACK_SET,
            'method' => 'GET',
            'query'  => $query
        ));

        return $json;
    }
}
