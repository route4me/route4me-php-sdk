<?php

namespace Route4Me;

class CurlHttpClient
{
    public $ch;
    public $debug = false;
    public $error_msg;

    public function CurlHttpClient($debug = false)
    {
        $this->debug = $debug;
        $this->init();
    }

    public function init()
    {
        // initialize curl handle
        $this->ch = curl_init();
        //set various options
        //set error in case http return code bigger than 300
        curl_setopt($this->ch, CURLOPT_FAILONERROR, true);
        // use gzip if possible
        curl_setopt($this->ch, CURLOPT_ENCODING, 'gzip, deflate');
        // do not veryfy ssl
        // this is important for windows
        // as well for being able to access pages with non valid cert
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, 0);
    }

    /**
     * Set username/pass for basic http auth.
     *
     * @param string user
     * @param string pass
     */
    public function setCredentials($username, $password)
    {
        curl_setopt($this->ch, CURLOPT_USERPWD, "$username:$password");
    }

    /**
     * Set referrer.
     *
     * @param string referrer url
     */
    public function setReferrer($referrer_url)
    {
        curl_setopt($this->ch, CURLOPT_REFERER, $referrer_url);
    }

    /**
     * Set client's userAgent.
     *
     * @param string user agent
     */
    public function setUserAgent($userAgent)
    {
        curl_setopt($this->ch, CURLOPT_USERAGENT, $userAgent);
    }

    /**
     * Set to receive output headers in all output functions.
     *
     * @param bool true to include all response headers with output, false otherwise
     */
    public function includeResponseHeaders($value)
    {
        curl_setopt($this->ch, CURLOPT_HEADER, $value);
    }

    /**
     * Set proxy to use for each curl request.
     *
     * @param string proxy
     */
    public function setProxy($proxy)
    {
        curl_setopt($this->ch, CURLOPT_PROXY, $proxy);
    }

    /**
     * Send post data to target URL
     * return data returned from url or false if error occured.
     *
     * @param string url
     * @param mixed post data (assoc array ie. $foo['post_var_name'] = $value or as string like var=val1&var2=val2)
     * @param string ip address to bind (default null)
     * @param int timeout in sec for complete curl operation (default 10)
     *
     * @return string data
     */
    public function sendPostData($url, $postdata, $ip = null, $timeout = 10)
    {
        //set various curl options first
        // set url to post to
        curl_setopt($this->ch, CURLOPT_URL, $url);
        // return into a variable rather than displaying it
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);

        //bind to specific ip address if it is sent trough arguments
        if ($ip) {
            if ($this->debug) {
                echo "Binding to ip $ip\n";
            }
            curl_setopt($this->ch, CURLOPT_INTERFACE, $ip);
        }

        //set curl function timeout to $timeout
        curl_setopt($this->ch, CURLOPT_TIMEOUT, $timeout);

        //set method to post
        curl_setopt($this->ch, CURLOPT_POST, true);
        // set post string
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $postdata);

        //and finally send curl request
        $result = curl_exec_redir($this->ch);
        if (curl_errno($this->ch)) {
            if ($this->debug) {
                echo "Error Occured in Curl\n";
                echo 'Error number: '.curl_errno($this->ch)."\n";
                echo 'Error message: '.curl_error($this->ch)."\n";
            }

            return false;
        } else {
            return $result;
        }
    }

    /**
     * fetch data from target URL
     * return data returned from url or false if error occured.
     *
     * @param string url
     * @param string ip address to bind (default null)
     * @param int timeout in sec for complete curl operation (default 5)
     *
     * @return string data
     */
    public function fetchUrl($url, $ip = null, $timeout = 5)
    {
        // set url to post to
        curl_setopt($this->ch, CURLOPT_URL, $url);

        //set method to get
        curl_setopt($this->ch, CURLOPT_HTTPGET, true);
        // return into a variable rather than displaying it
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);

        //bind to specific ip address if it is sent trough arguments
        if ($ip) {
            if ($this->debug) {
                echo "Binding to ip $ip\n";
            }

            curl_setopt($this->ch, CURLOPT_INTERFACE, $ip);
        }

        //set curl function timeout to $timeout
        curl_setopt($this->ch, CURLOPT_TIMEOUT, $timeout);

        //and finally send curl request
        $result = curl_exec_redir($this->ch);
        if (curl_errno($this->ch)) {
            if ($this->debug) {
                echo "Error Occured in Curl\n";
                echo 'Error number: '.curl_errno($this->ch)."\n";
                echo 'Error message: '.curl_error($this->ch)."\n";
            }

            return false;
        } else {
            return $result;
        }
    }

    /**
     * Fetch data from target URL
     * and store it directly to file.
     *
     * @param string url
     * @param resource value stream resource(ie. fopen)
     * @param string ip address to bind (default null)
     * @param int timeout in sec for complete curl operation (default 5)
     *
     * @return bool true on success false othervise
     */
    public function fetchIntoFile($url, $fp, $ip = null, $timeout = 5)
    {
        // set url to post to
        curl_setopt($this->ch, CURLOPT_URL, $url);
        //set method to get
        curl_setopt($this->ch, CURLOPT_HTTPGET, true);
        // store data into file rather than displaying it
        curl_setopt($this->ch, CURLOPT_FILE, $fp);

        //bind to specific ip address if it is sent trough arguments
        if ($ip) {
            if ($this->debug) {
                echo "Binding to ip $ip\n";
            }
            curl_setopt($this->ch, CURLOPT_INTERFACE, $ip);
        }

        //set curl function timeout to $timeout
        curl_setopt($this->ch, CURLOPT_TIMEOUT, $timeout);

        //and finally send curl request
        $result = curl_exec_redir($this->ch);
        if (curl_errno($this->ch)) {
            if ($this->debug) {
                echo "Error Occured in Curl\n";
                echo 'Error number: '.curl_errno($this->ch)."\n";
                echo 'Error message: '.curl_error($this->ch)."\n";
            }

            return false;
        } else {
            return true;
        }
    }

    /**
     * Send multipart post data to the target URL
     * return data returned from url or false if error occured
     * (contribution by vule nikolic, vule@dinke.net).
     *
     * @param string url
     * @param array assoc post data array ie. $foo['post_var_name'] = $value
     * @param array assoc                     $file_field_array,    contains file_field name = value - path pairs
     * @param string ip address to bind (default null)
     * @param int timeout in sec for complete curl operation (default 30 sec)
     *
     * @return string data
     */
    public function sendMultipartPostData($url, $postdata, $file_field_array = [], $ip = null, $timeout = 30)
    {
        //set various curl options first
        // set url to post to
        curl_setopt($this->ch, CURLOPT_URL, $url);
        // return into a variable rather than displaying it
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);

        //bind to specific ip address if it is sent trough arguments
        if ($ip) {
            if ($this->debug) {
                echo "Binding to ip $ip\n";
            }

            curl_setopt($this->ch, CURLOPT_INTERFACE, $ip);
        }

        //set curl function timeout to $timeout
        curl_setopt($this->ch, CURLOPT_TIMEOUT, $timeout);
        //set method to post
        curl_setopt($this->ch, CURLOPT_POST, true);
        // disable Expect header
        // hack to make it working
        $headers = ['Expect: '];
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
        // initialize result post array
        $result_post = [];
        //generate post string
        $post_array = [];
        $post_string_array = [];

        if (!is_array($postdata)) {
            return false;
        }

        foreach ($postdata as $key => $value) {
            $post_array[$key] = $value;
            $post_string_array[] = urlencode($key).'='.urlencode($value);
        }

        $post_string = implode('&', $post_string_array);
        if ($this->debug) {
            echo "Post String: $post_string\n";
        }

        // set post string
        //curl_setopt($this->ch, CURLOPT_POSTFIELDS, $post_string);
        // set multipart form data - file array field-value pairs
        if (!empty($file_field_array)) {
            foreach ($file_field_array as $var_name => $var_value) {
                if (false !== strpos(PHP_OS, 'WIN')) {
                    $var_value = str_replace('/', '\\', $var_value);
                } // win hack
                $file_field_array[$var_name] = '@'.$var_value;
            }
        }

        // set post data
        $result_post = array_merge($post_array, $file_field_array);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $result_post);

        //and finally send curl request
        $result = curl_exec_redir($this->ch);
        if (curl_errno($this->ch)) {
            if ($this->debug) {
                echo "Error Occured in Curl\n";
                echo 'Error number: '.curl_errno($this->ch)."\n";
                echo 'Error message: '.curl_error($this->ch)."\n";
            }

            return false;
        } else {
            return $result;
        }
    }

    /**
     * Set file location where cookie data will be stored and send on each new request.
     *
     * @param string absolute path to cookie file (must be in writable dir)
     */
    public function storeCookies($cookie_file)
    {
        // use cookies on each request (cookies stored in $cookie_file)
        curl_setopt($this->ch, CURLOPT_COOKIEJAR, $cookie_file);
        curl_setopt($this->ch, CURLOPT_COOKIEFILE, $cookie_file);
    }

    /**
     * Set custom cookie.
     *
     * @param string cookie
     */
    public function setCookie($cookie)
    {
        curl_setopt($this->ch, CURLOPT_COOKIE, $cookie);
    }

    /**
     * Get last URL info
     * usefull when original url was redirected to other location.
     *
     * @return string url
     */
    public function getEffectiveUrl()
    {
        return curl_getinfo($this->ch, CURLINFO_EFFECTIVE_URL);
    }

    /**
     * Get http response code.
     *
     * @return int
     */
    public function getHttpResponseCode()
    {
        return curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
    }

    /**
     * Return last error message and error number.
     *
     * @return string error msg
     */
    public function getErrorMsg()
    {
        $err = 'Error number: '.curl_errno($this->ch)."\n";
        $err .= 'Error message: '.curl_error($this->ch)."\n";

        return $err;
    }

    /**
     * Close curl session and free resource
     * Usually no need to call this function directly
     * in case you do you have to call init() to recreate curl.
     */
    public function close()
    {
        //close curl session and free up resources
        curl_close($this->ch);
    }
}

/**
 * This function allows curl to follow redirects without using CURLOPT_FOLLOWLOCATION
 * which is disabled when using open_basedir or safe_mode.
 */
function curlExecRedir($ch)
{
    static $curl_loops = 0;
    static $curl_max_loops = 20;

    if ($curl_loops++ >= $curl_max_loops) {
        $curl_loops = 0;

        return false;
    }

    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Expect:']);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_VERBOSE, false);
    $data = curl_exec($ch);
    $data = str_replace("\r", "\n", str_replace("\r\n", "\n", $data));
    list($header, $data) = explode("\n\n", $data, 2);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    //echo "*** Got HTTP code: $http_code ***\n";
    //echo "**  Got headers: \n$header\n\n";

    if (301 == $http_code || 302 == $http_code) {
        // If we're redirected, we should revert to GET
        curl_setopt($ch, CURLOPT_HTTPGET, true);

        $matches = [];
        preg_match('/Location:\s*(.*?)(\n|$)/i', $header, $matches);
        $url = @parse_url(trim($matches[1]));

        if (!$url) {
            //couldn't process the url to redirect to
            $curl_loops = 0;

            return $data;
        }

        $last_url = parse_url(curl_getinfo($ch, CURLINFO_EFFECTIVE_URL));
        if (empty($url['scheme'])) {
            $url['scheme'] = $last_url['scheme'];
        }

        if (empty($url['host'])) {
            $url['host'] = $last_url['host'];
        }

        if (empty($url['path'])) {
            $url['path'] = $last_url['path'];
        }

        $new_url = $url['scheme'].'://'.$url['host'].$url['path'].(!empty($url['query']) ? '?'.$url['query'] : '');
        //echo "Being redirected to $new_url\n";
        curl_setopt($ch, CURLOPT_URL, $new_url);

        return curl_exec_redir($ch);
    } else {
        $curl_loops = 0;

        return $data;
    }
}
