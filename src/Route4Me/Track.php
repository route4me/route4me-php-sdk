<?php

namespace Route4Me;

use Route4Me\Route4Me;
use Route4Me\TrackSetParams;

class Track extends Common
{
    public static $apiUrl = '/track/set.php';

    public static function set(TrackSetParams $param)
    {
        $query = array_merge($param->toArray(), array(
            'api_key' => Route4Me::getApiKey()
        ));

        $json = Route4Me::makeRequst(array(
            'url'    => self::$apiUrl,
            'method' => 'GET',
            'query'  => $query
        ));

        return $json;
    }
}
