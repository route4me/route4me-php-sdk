<?php
namespace Route4Me;

use Route4Me\Route4Me;
use Route4Me\TrackSetParams;
use Route4Me\Enum\Endpoint;

class Track extends Common
{
    public static function set(TrackSetParams $params)
    {
        $allQueryFields = Route4Me::getObjectProperties(new TrackSetParams(), array('tx_id'));

        $json = Route4Me::makeRequst(array(
            'url'    => Endpoint::TRACK_SET,
            'method' => 'GET',
            'query'  => Route4Me::generateRequestParameters($allQueryFields, $params)
        ));

        return $json;
    }
}
