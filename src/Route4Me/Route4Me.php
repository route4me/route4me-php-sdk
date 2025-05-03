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

    /**
     * Make request with CURL
     *
     * @since 1.2.3 changed error handling
     * @since 1.2.8 added $options['return_headers']
     *
     * @param array  $options
     *   string url                        - HTTP URL.
     *   string method                     - HTTP method.
     *   string api_key                    - API key to access to route4me server.
     *   array  query                      - Array of query parameters.
     *   array  body                       - Array of body parameters.
     *   string HTTPHEADER                 - Content type of body e.g.
     *                                       'Content-Type: application/json'
     *                                       'Content-Type: multipart/form-data'
     *   array  HTTPHEADERS                - Array of headers.
     *   string FILE                       - Path to uploading file.
     *   array  return_headers             - Array of response headers to return as a result.
     * @throws Exception\ApiError
     */
    public static function makeRequst($options)
    {
        $method = isset($options['method']) ? $options['method'] : 'GET';
        $query = isset($options['query'])
            ? array_filter($options['query'], function ($x) {
                return !is_null($x);
            }) : [];

        $body = isset($options['body']) ? $options['body'] : null;
        $file = isset($options['FILE']) ? $options['FILE'] : null;
        $headers = [
            'User-Agent: Route4Me php-sdk',
        ];

        $return_headers = (isset($options['return_headers']) ? $options['return_headers'] : null);

        if (isset($options['HTTPHEADER'])) {
            $headers[] = $options['HTTPHEADER'];
        }

        if (isset($options['HTTPHEADERS'])) {
            foreach ($options['HTTPHEADERS'] as $header) {
                $headers[] = $header;
            }
        }

        $ch = curl_init();

        $baseUrl = self::getBaseUrl();
        $host = parse_url($baseUrl . (isset($options['url']) ? $options['url'] : ''), PHP_URL_HOST);
        $url = null;
        if (isset($host) && strtolower(substr($host, 0, 2)) == "wh") {
            $url = (isset($options['url']) ? $options['url'] . '?' . http_build_query($query) : '');
            $headers[] = 'Authorization: Bearer ' . self::getApiKey();
        } else {
            $url = (isset($options['url'])
                ? $options['url'] . '?' . http_build_query(array_merge(
                    $query,
                    ['api_key' => self::getApiKey()]
                )) : '');
        }

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

        // read response headers if need
        $response_headers = [];
        if ($return_headers) {
            curl_setopt($ch, CURLOPT_HEADERFUNCTION, function ($curl, $header) use (&$response_headers) {
                $len = strlen($header);
                $header = explode(':', $header, 2);
                if (count($header) >= 2) {
                    $response_headers[strtolower(trim($header[0]))] = trim($header[1]);
                }
                return $len;
            });
        }

        if (null != $file) {
            $cfile = new \CURLFile($file, '', '');
            $body['strFilename']=$cfile;
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_POST, true);
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
                        if (isset($options['HTTPHEADER'])
                            && strpos($options['HTTPHEADER'], 'multipart/form-data') > 0) {
                            $bodyData = $body;
                        } else {
                            $bodyData = json_encode($body);
                        }
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTREDIR, 7);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $bodyData);
                    }
                    break;
                case 'ADD':
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($query));
                    break;
                case 'PATCH':
                    if (isset($body)) {
                        $bodyData = json_encode($body);
                        if (isset($options['HTTPHEADER'])) {
                            if (strpos($options['HTTPHEADER'], 'multipart/form-data') > 0) {
                                $bodyData = $body;
                            }
                        }
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $bodyData);
                    }
                    break;
            }

            if (is_numeric(array_search($method, ['DELETE', 'PUT']))) {
                if (isset($body)) {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
                }
            }
        }

        $result = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $json = null;
        if (strpos($result, '<?xml') > -1) {
            $xml = simplexml_load_string($result);
            $json = self::object2array($xml);
        } else {
            $json = json_decode($result, true);
        }
        if (200 == $code || 201 == $code || 202 == $code || 204 == $code) {
            if (isset($json['errors'])) {
                throw new ApiError(implode(', ', $json['errors']), $code, $result);
            } else {
                // return response headers if they were asked for
                if (count($response_headers) !== 0) {
                    $res = [
                        'code' => $code,
                        'data' => $json
                    ];
                    foreach ($return_headers as $key => $value) {
                        // most headers has char '-' but it is forbidden in PHP names replace it with '_'
                        $res[strtolower(str_replace('-', '_', $value))] =
                            (isset($response_headers[$value]) ? $response_headers[$value] : null);
                    }
                    return $res;
                }
                if (204 == $code) {
                    return true;
                }
                return $json;
            }
        } elseif (isset($code) && (!isset($result) || !$result)) {
            throw new ApiError('', $code, $result);
        } else {
            if (isset($json['messages'])) {
                $msg = '';
                foreach ($json['messages'] as $key => $value) {
                    if ($msg !== '') {
                        $msg .= PHP_EOL;
                    }
                    $msg .= $key . ': ' . (is_array($value) ? implode(', ', $value) : $value);
                }
                throw new ApiError($msg, $code, $result);
            } elseif (isset($json['error']) && !empty($json['error'])) {
                throw new ApiError($json['error'], $code, $result);
            } elseif (isset($json['error'])) {
                $msg = '';
                foreach ($json['errors'] as $key => $value) {
                    if ($msg !== '') {
                        $msg .= PHP_EOL;
                    }
                    $msg .= $value;
                }
                throw new ApiError($msg, $code, $result);
            } else {
                throw new ApiError($result, $code, $result);
            }
        }
    }

    /**
     * @param $object: JSON object
     */
    public static function object2array($object)
    {
        return @json_decode(@json_encode($object), 1);
    }

    /**
     * Prints on the screen main keys and values of the array.
     *
     * @param $results: object to be printed on the screen
     * @param $deepPrinting: if true, object will be printed recursively
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
     * Generates query or body parameters.
     *
     * @param $allFields: all known fields could be used for parameters generation
     * @param $params: input parameters (array or object)
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
     * @param $object: An object
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
     * @param $params: input parameters (array or object)
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
