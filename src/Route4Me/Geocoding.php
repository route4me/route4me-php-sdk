<?php

namespace Route4Me;

use Route4Me\Enum\Endpoint;

class Geocoding extends Common
{
    public $strExportFormat;
    public $format;
    public $addresses;
    public $pk;
    public $offset;
    public $limit;
    public $housenumber;
    public $zipcode;

    public static function forwardGeocoding($params)
    {
        $allBodyFields = ['strExportFormat', 'addresses'];

        $fgCoding = Route4Me::makeRequst([
            'url'           => Endpoint::GEOCODER,
            'method'        => 'POST',
            'body'          => Route4Me::generateRequestParameters($allBodyFields, $params),
            'HTTPHEADER'    => 'Content-Type: multipart/form-data',
        ]);

        return $fgCoding;
    }

    public static function reverseGeocoding($params)
    {
        $allQueryFields = ['format', 'addresses', 'detailed'];

        $fgcoding = Route4Me::makeRequst([
            'url'       => Endpoint::GEOCODER,
            'method'    => 'POST',
            'query'     => Route4Me::generateRequestParameters($allQueryFields, $params),
        ]);

        return $fgcoding;
    }

    public static function getStreetData($params)
    {
        Route4Me::setBaseUrl(Endpoint::STREET_DATA);

        $allPathFields = ['pk', 'offset', 'limit'];

        $url_query = Route4Me::generateUrlPath($allPathFields, $params);

        $query = [];

        $response = Route4Me::makeRequst([
            'url'       => $url_query,
            'method'    => 'GET',
            'query'     => $query,
        ]);

        return $response;
    }

    public static function getZipCode($params)
    {
        Route4Me::setBaseUrl(Endpoint::STREET_DATA_ZIPCODE);

        $allPathFields = ['zipcode', 'offset', 'limit'];

        $url_query = Route4Me::generateUrlPath($allPathFields, $params);

        $query = [];

        $response = Route4Me::makeRequst([
            'url'       => $url_query,
            'method'    => 'GET',
            'query'     => $query,
        ]);

        return $response;
    }

    public static function getService($params)
    {
        Route4Me::setBaseUrl(Endpoint::STREET_DATA_SERVICE);

        $allPathFields = ['zipcode', 'housenumber', 'offset', 'limit'];

        $url_query = Route4Me::generateUrlPath($allPathFields, $params);

        $query = [];

        $response = Route4Me::makeRequst([
            'url'       => $url_query,
            'method'    => 'GET',
            'query'     => $query,
        ]);

        return $response;
    }
}
