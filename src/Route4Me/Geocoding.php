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

    public static function fromArray(array $params)
    {
        $geocoding = new self();

        foreach ($params as $key => $value) {
            if (property_exists($geocoding, $key)) {
                $geocoding->{$key} = $value;
            }
        }

        return $geocoding;
    }

    public static function forwardGeocoding($params)
    {
        $allBodyFields = ['strExportFormat', 'addresses'];

        $fgCoding = Route4Me::makeRequst([
            'url' => Endpoint::GEOCODER,
            'method' => 'POST',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params),
            'HTTPHEADER' => 'Content-Type: multipart/form-data',
        ]);

        return $fgCoding;
    }

    /*
     * Reverse geocoding by the GET Http method is obsolete.
     * Use Batch geocoding instead.
     */
    public static function reverseGeocoding($params)
    {
        //$allQueryFields = ['format', 'addresses', 'detailed'];
        $allBodyFields = ['strExportFormat', 'addresses'];

        $rgCoding = Route4Me::makeRequst([
            'url' => Endpoint::GEOCODER,
            'method' => 'POST',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params),
            'HTTPHEADER' => 'Content-Type: multipart/form-data',
        ]);

        /*
        $fgcoding = Route4Me::makeRequst([
            'url' => Endpoint::GEOCODER,
            'method' => 'POST',
            'query' => Route4Me::generateRequestParameters($allQueryFields, $params),
        ]);
*/
        return $rgCoding;
    }

    public static function getStreetData($params)
    {
        Route4Me::setBaseUrl(Endpoint::STREET_DATA);

        $allPathFields = ['pk', 'offset', 'limit'];

        $url_query = Route4Me::generateUrlPath($allPathFields, $params);

        $query = [];

        $response = Route4Me::makeRequst([
            'url' => $url_query,
            'method' => 'GET',
            'query' => $query,
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
            'url' => $url_query,
            'method' => 'GET',
            'query' => $query,
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
            'url' => $url_query,
            'method' => 'GET',
            'query' => $query,
        ]);

        return $response;
    }
}
