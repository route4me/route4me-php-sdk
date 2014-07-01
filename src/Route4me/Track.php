<?php

namespace Route4me;

use Route4me\Exception\BadParam;
use Route4me\TrackSetParams;
use Route4me\Route4me;
use Route4me\Base;

use GuzzleHttp\Client;

class Track extends Common
{
    public static $apiUrl = 'http://route4me.com/track/set.php';
    public static function set(TrackSetParams $param)
    {
        $query = array_merge($param->toArray(), array(
            'api_key' => Route4me::getApiKey()
        ));

        try {
            $client = new Client;
            $response = $client->get(self::$apiUrl, array(
                'query' => $query,
                'headers' => array(
                    'User-Agent' => 'Route4me php sdk'
                )
            ));

            $json = $response->json();
            return $json['status'] == true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
