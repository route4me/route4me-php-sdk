<?php

namespace Route4Me;

use Route4Me\Exception\ApiError;
use Route4Me\Enum\Endpoint;

class Route4Me
{
    public static $apiKey;
    public static $baseUrl = Endpoint::BASE_URL;

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

    public static function makeRequst($options)
    {
        $method = isset($options['method']) ? $options['method'] : 'GET';
        $query = isset($options['query']) ? array_filter($options['query'], function ($x) { return !is_null($x); }) : [];

        $body = isset($options['body']) ? $options['body'] : null;
        $file = isset($options['FILE']) ? $options['FILE'] : null;
        $headers = [
            'User-Agent: Route4Me php-sdk',
        ];

        if (isset($options['HTTPHEADER'])) {
            $headers[] = $options['HTTPHEADER'];
        }

        if (isset($options['HTTPHEADERS'])) {
            foreach ($options['HTTPHEADERS'] as $header) {
                $headers[] = $header;
            }
        }

        $ch = curl_init();

        $url = isset($options['url']) ? $options['url'].'?'.http_build_query(array_merge(
            $query, ['api_key' => self::getApiKey()]
        )) : '';

        $baseUrl = self::getBaseUrl();

        $curlOpts = [
            CURLOPT_URL             => $baseUrl.$url,
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_TIMEOUT         => 120,
            CURLOPT_FOLLOWLOCATION  => true,
            CURLOPT_SSL_VERIFYHOST  => false,
            CURLOPT_SSL_VERIFYPEER  => false,
            CURLOPT_HTTPHEADER      => $headers,
        ];

        curl_setopt_array($ch, $curlOpts);

        if (null != $file) {
            $cfile = new \CURLFile($file,'','');
            $body['strFilename']=$cfile;
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_POST,true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        } else {
            switch ($method) {
                case 'DELETE':
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                    break;
                case 'DELETEARRAY':
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($query));
                    break;
                case 'PUT':
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                    break;
                case 'POST':
                    if (isset($body)) {
                        $bodyData = json_encode($body);
                        if (isset($options['HTTPHEADER'])) {
                            if (strpos($options['HTTPHEADER'], 'multipart/form-data') > 0) {
                                $bodyData = $body;
                            }
                        }

                        curl_setopt($ch, CURLOPT_POSTFIELDS, $bodyData);
                    }
                    break;
                case 'ADD':
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($query)); break;
            }

            if (is_numeric(array_search($method, ['DELETE', 'PUT']))) {
                if (isset($body)) {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
                }
            }
        }

        $result = curl_exec($ch);

        $isxml = false;
        $jxml = '';
        if (strpos($result, '<?xml') > -1) {
            $xml = simplexml_load_string($result);
            //$jxml = json_encode($xml);
            $jxml = self::object2array($xml);
            $isxml = true;
        }

        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if (200 == $code) {
            if ($isxml) {
                $json = $jxml;
            } else {
                $json = json_decode($result, true);
            }

            if (isset($json['errors'])) {
                throw new ApiError(implode(', ', $json['errors']));
            } else {
                return $json;
            }
        } elseif (409 == $code) {
            throw new ApiError('Wrong API key');
        } else {
            throw new ApiError('Something wrong');
        }
    }

    /**
     * @param $object object JSON
     */
    public static function object2array($object)
    {
        return @json_decode(@json_encode($object), 1);
    }
    
    //public static function object2json

    /**
     * Prints on the screen main keys and values of the array.
     *
     * @param $results: object to be printed on the screen
     * @param $deepPrinting Boolean: if true, object will be printed recursively
     */
    public static function simplePrint($results, $deepPrinting = null)
    {
        if (isset($results)) {
            if (is_array($results)) {
                foreach ($results as $key => $result) {
                    if (is_array($result)) {
                        foreach ($result as $key1 => $result1) {
                            if (is_array($result1)) {
                                if ($deepPrinting) {
                                    echo "<br>$key1 ------><br>";
                                    self::simplePrint($result1, true);
                                    echo '------<br>';
                                } else {
                                    echo $key1.' --> '.'Array() <br>';
                                }
                            } else {
                                if (is_object($result1)) {
                                    if ($deepPrinting) {
                                        echo "<br>$key1 ------><br>";
                                        $oarray = (array) $result1;
                                        self::simplePrint($oarray, true);
                                        echo '------<br>';
                                    } else {
                                        echo $key1.' --> '.'Object <br>';
                                    }
                                } else {
                                    if (!is_null($result1)) {
                                        echo $key1.' --> '.$result1.'<br>';
                                    }
                                }
                            }
                        }
                    } else {
                        if (is_object($result)) {
                            if ($deepPrinting) {
                                echo "<br>$key ------><br>";
                                $oarray = (array) $result;
                                self::simplePrint($oarray, true);
                                echo '------<br>';
                            } else {
                                echo $key.' --> '.'Object <br>';
                            }
                        } else {
                            if (!is_null($result)) {
                                echo $key.' --> '.$result.'<br>';
                            }
                        }
                    }
                    //echo "<br>";
                }
            }
        }
    }

    /**
     * Converts an object to a JSON string.  
     * @param $obj: object, the object to convert.  
     * @param $prettify: integer, the option parameter.  
     *  Default value JSON_PRETTY_PRINT is for getting prettified JSON string.  
     *  If $prettify=NULL, minified JSON string is returned.
     */
    public static function object2json($obj, $prettify=JSON_PRETTY_PRINT) {
        return json_encode($obj, $prettify);
    }

    /**
     * Generates query or body parameters.
     *
     * @param $allFields array: all known fields could be used for parameters generation
     * @param $params object: input parameters (array or object)
     */
    public static function generateRequestParameters($allFields, $params)
    {
        $generatedParams = [];

        if (is_array($params)) {
            foreach ($allFields as $field) {
                if (isset($params[$field])) {
                    $generatedParams[$field] = $params[$field];
                }
            }
        } elseif (is_object($params)) {
            foreach ($allFields as $field) {
                if (isset($params->{$field})) {
                    $generatedParams[$field] = $params->{$field};
                }
            }
        }

        return $generatedParams;
    }

    /**
     * Returns an array of the object properties.
     *
     * @param $object object
     * @param $exclude: array of the object parameters to be excluded from the returned array
     */
    public static function getObjectProperties($object, $exclude)
    {
        $objectParameters = [];

        foreach (get_object_vars($object) as $key => $value) {
            if (property_exists($object, $key)) {
                if (!is_numeric(array_search($key, $exclude))) {
                    array_push($objectParameters, $key);
                }
            }
        }

        return $objectParameters;
    }

    /**
     * Returns url path generated from the array of the fields and parameters.
     *
     * @param $allFields; array of the paossible fields (parameter names)
     * @param $params array: input parameters
     */
    public static function generateUrlPath($allFields, $params)
    {
        $generatedPath = '';

        if (is_array($params)) {
            foreach ($allFields as $field) {
                if (isset($params[$field])) {
                    $generatedPath .= $params[$field].'/';
                }
            }
        } elseif (is_object($params)) {
            foreach ($allFields as $field) {
                if (isset($params->{$field})) {
                    $generatedPath .= $params->{$field}.'/';
                }
            }
        }

        return $generatedPath;
    }

    public static function getFileRealPath($fileName)
    {
        $rpath = function_exists('curl_file_create') ? curl_file_create(realpath($fileName)) : '@'.realpath($fileName);

        return $rpath;
    }
}
