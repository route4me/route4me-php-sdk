<?php

namespace Route4me;

class Route4me
{
    static public $apiKey;

    public static function setApiKey($apiKey)
    {
        self::$apiKey = $apiKey;
    }

    public static function getApiKey()
    {
        return self::$apiKey;
    }
}
