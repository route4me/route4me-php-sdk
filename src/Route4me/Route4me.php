<?php

namespace Route4Me;

use Route4Me\Exception\ApiError;

class Route4Me
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
        $query = isset($options['query']) ?
            array_filter($options['query']) : array();
        $body = isset($options['body']) ?
            array_filter($options['body']) : null;
        $ch = curl_init();
        $url = $options['url'] . '?' . http_build_query(array_merge(
            $query, array( 'api_key' => self::getApiKey())
        ));
		//self::simplePrint($query);
		//die("<br> Stop");
		$baseUrl=self::getBaseUrl();
		if (strpos($url,'move_route_destination')>0) $baseUrl='https://www.route4me.com';
        $curlOpts = arraY(
            CURLOPT_URL            => $baseUrl. $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 60,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTPHEADER     => array(
                'User-Agent' => 'Route4Me php-sdk'
            )
        );

        curl_setopt_array($ch, $curlOpts);
        switch($method) {
        case 'DELETE':
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE"); 
            break;
		case 'DELETEARRAY':
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE"); 
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($query));
            break;
        case 'PUT':
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
			//curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body)); 
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($query));
			break;
        case 'POST':
			if (!isset($body)) {curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); }
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($query)); 
			if (isset($body)) {
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body)); 
				echo "IS SET BODY <br>";
			} else {
				curl_setopt($ch, CURLOPT_POSTFIELDS, "");
			}
			break;
		case 'ADD':
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($query)); break;
        }

        $result = curl_exec($ch);
		$isxml=FALSE;
		$jxml="";
		if (strpos($result, '<?xml')>-1)
		{
			$xml = simplexml_load_string($result);
			$jxml = json_encode($xml);
			$isxml = TRUE;
		}
		
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
		
		if ($isxml) {
			$json = $jxml;
		} else $json = json_decode($result, true);
		
        if (200 == $code) {
            return $json;
        } elseif (isset($json['errors'])) {
            throw new ApiError(implode(', ', $json['errors']));
        } else {
            throw new ApiError('Something wrong');
        }
    }
	
	/**
	 * Prints on the screen main keys and values of the array 
	 *
	 */
	public static function simplePrint($results)
	{
		if (isset($results)) {
			if (is_array($results)) {
				foreach ($results as $key=>$result) {
					if (is_array($result)) {
						foreach ($result as $key1=>$result1) {
							if (is_array($result1)) {
								echo $key1." --> "."Array() <br>";
								/**
								 * for deep printing here should be recursive call:
								 * Route4Me::simplePrint($result1); 
								 */
							} else {
								if (is_object($result1)) {
									echo $key." --> "."Object <br>";
									/**
									 * for deep printing here should be recursive call:
									 * $oarray=(array)$result1;
									 * Route4Me::simplePrint($oarray);
									 */
								} else {
									echo $key1." --> ".$result1."<br>";	
								}
								
							}
						}
					} else {
						if (is_object($result)) {
							echo $key." --> "."Object <br>";
							/**
							 * for deep printing here should be recursive call:
							 * $oarray=(array)$result;
							 * Route4Me::simplePrint($oarray);
							 */
						} else {
							echo $key." --> ".$result."<br>";
						}
						
					}
					echo "<br>";
				}
			} 
		}
	}

}
