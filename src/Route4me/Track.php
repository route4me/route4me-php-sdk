<?php

namespace Route4me;

use Route4me\Route4me;
use Route4me\TrackSetParams;

class Track extends Common
{
    public static $apiUrl = '/track/set.php';

    public static function set(TrackSetParams $param)
    {
        $query = array_merge($param->toArray(), array(
            'api_key' => Route4me::getApiKey()
        ));

        $json = Route4me::makeRequst(array(
            'url'    => self::$apiUrl,
            'method' => 'GET',
            'query'  => $query
        ));

        return $json['status'];
    }
}
