<?php

namespace Route4Me;

use Route4Me\Exception\ApiError;

class Route4Me
{
    static public $apiKey;
    static public $baseUrl = 'https://route4me.com';

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
	
	public static function fileUploadRequest($options) {
		$query = isset($options['query']) ?
            array_filter($options['query']) : array();

		if (sizeof($query)==0) return null;

		$body = isset($options['body']) ?
            array_filter($options['body']) : null;
			
		$fname = isset($body['strFilename']) ? $body['strFilename'] : '';
		if ($fname=='') return null;

		$rpath = realpath($fname);
		
		$fp=fopen(realpath($fname),"r");
		
		$url = self::$baseUrl.$options['url'] . '?' . http_build_query(array_merge(
            array( 'api_key' => self::getApiKey()), $query)
        );
		
		//self::simplePrint($body);die("");
		//echo "url=".$url."<br>";die("");
		
		$ch = curl_init($url);
		
		$curlOpts = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 60,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYHOST => FALSE,
            CURLOPT_SSL_VERIFYPEER => FALSE
        );
		
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			"Content-Type: multipart/form-data",
			'Content-Disposition: form-data; name="strFilename"',
			'User-Agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)'
		));
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body)); 
		
		$result = curl_exec($ch);
		fclose($fp);
		//var_dump($result); die('');
		$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
		//echo "code = $code <br>";
		$json = json_decode($result, true);
		//var_dump($json); die("");
        if (200 == $code) {
            return $json;
        } elseif (isset($json['errors'])) {
            throw new ApiError(implode(', ', $json['errors']));
        } else {
            throw new ApiError('Something wrong');
        }
	}

    public static function makeRequst($options) {
        $method = isset($options['method']) ? $options['method'] : 'GET';
        $query = isset($options['query']) ?
            array_filter($options['query']) : array();
		//echo "query=".$query['member_id'];die("");
        $body = isset($options['body']) ?
            array_filter($options['body']) : null;
		$file = isset($options['FILE']) ? $options['FILE'] : null;
        $headers = array(
            "User-Agent: Route4Me php-sdk"
        );
        
        if (isset($options['HTTPHEADER'])) {
            $headers[]=$options['HTTPHEADER'];
        }

		if (isset($options['HTTPHEADERS'])) {
		    foreach ($options['HTTPHEADERS'] As $header) $headers[]=$header;
        }
        //self::simplePrint($headers); die("");
        $ch = curl_init();
        $url = $options['url'] . '?' . http_build_query(array_merge(
            $query, array( 'api_key' => self::getApiKey())
        ));
		
		//$jfile=json_encode($body); echo $jfile; die("");

        //self::simplePrint($headers); die("");
		$baseUrl=self::getBaseUrl();
		
		if (strpos($url,'move_route_destination')>0) $baseUrl='https://www.route4me.com';
        $curlOpts = arraY(
            CURLOPT_URL            => $baseUrl. $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 60,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYHOST => FALSE,
            CURLOPT_SSL_VERIFYPEER => FALSE,
            CURLOPT_HTTPHEADER     => $headers
        );
		
		//echo "url=".$baseUrl.$url."<br>";die("");
        curl_setopt_array($ch, $curlOpts);
		
		if ($file !=null) {
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$fp=fopen($file,'r');
			curl_setopt($ch, CURLOPT_INFILE , $fp);
			curl_setopt($ch, CURLOPT_INFILESIZE, filesize($file));
		}
		
        switch($method) {
        case 'DELETE':
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE"); 

			if (isset($body)) {
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body)); 
			}
            break;
		case 'DELETEARRAY':
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE"); 
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($query));
            break;
        case 'PUT':
			//$jfile=json_encode($body); echo $jfile; die("");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
			if (isset($query)) {
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($query));
			}

			if (isset($body)) {
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body)); 
			}
			break;
        case 'POST':
			if (isset($query)) {
            	curl_setopt($ch,  CURLOPT_POSTFIELDS, json_encode($query)); 
			}
            
			//echo json_encode($body); die("");
			if (isset($body)) {
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body)); 
			} 
			break;
		case 'ADD':
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($query)); break;
        }

        $result = curl_exec($ch);
		//var_dump($result); die("");
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
		//var_dump($json); die("");
        if (200 == $code) {
            return $json;
        } elseif (isset($json['errors'])) {
            throw new ApiError(implode(', ', $json['errors']));
        } else {
            throw new ApiError('Something wrong');
        }
    }

	public static function makeUrlRequst($url, $options) {
		$method = isset($options['method']) ? $options['method'] : 'GET';
        $query = isset($options['query']) ?
            array_filter($options['query']) : array();
        $body = isset($options['body']) ?
            array_filter($options['body']) : null;
        $ch = curl_init();
		
		$curlOpts = arraY(
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 60,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYHOST => FALSE,
            CURLOPT_SSL_VERIFYPEER => FALSE,
            CURLOPT_HTTPHEADER     => array(
                'User-Agent' => 'Route4Me php-sdk'
            )
        );
		
		curl_setopt_array($ch, $curlOpts);
		
        switch($method) {
        case 'DELETE':
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE"); 

			if (isset($body)) {
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body)); 
			}
            break;
		case 'DELETEARRAY':
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE"); 
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($query));
            break;
        case 'PUT':
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
			if (isset($query)) {
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($query));
			}

			if (isset($body)) {
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body)); 
			}
			break;
        case 'POST':
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
			if (isset($query)) {
            	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($query)); 
			}

			if (isset($body)) {
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body)); 
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
