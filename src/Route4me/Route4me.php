<?php

namespace Route4me;

use Route4me\Exception\ApiError;

class Route4me
{
    static public $apiKey;
    static public $baseUrl = 'http://route4me.com';

    public static function setApiKey($apiKey)
    {
        self::$apiKey = $apiKey;
    }

    public static function getApiKey()
    {
        return self::$apiKey;
    }

    public static function setBaseUrl($baseUrl)
    {
        self::$baseUrl = $baseUrl;
    }

    public static function getBaseUrl()
    {
        return self::$baseUrl;
    }

    public static function makeRequst($options) {
        $method = isset($options['method']) ? $options['method'] : 'GET';
        $query = isset($options['query']) ? $options['query'] : array();
        $body = isset($options['body']) ? $options['body'] : null;

        $ch = curl_init();
        $url = $options['url'] . '?' . http_build_query(array_merge(
            $query, array( 'api_key' => self::getApiKey())
        ));

        $curlOpts = arraY(
            CURLOPT_URL            => self::getBaseUrl() . $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 60,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTPHEADER     => array(
                'User-Agent' => 'Route4me php-sdk'
            )
        );

        curl_setopt_array($ch, $curlOpts);
        if ('POST' == $method) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
        }

        $result = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $json = json_decode($result);
        if (200 == $code) {
            return $json;
        } elseif (isset($json->errors)) {
            throw new ApiError($json->errors);
        } else {
            throw new ApiError('Something wrong');
        }
    }
}
