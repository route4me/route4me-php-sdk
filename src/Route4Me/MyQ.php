<?php
namespace Route4Me;

use Route4Me\Common;
/**
 * class MyQ
 *
 * Offers authentication to MyQ API, and access to garage door open/close/status functions
 *
 */
class MyQException extends \Exception {}

class MyQ {
    /** @var string|null $username contains the username used to authenticate with the MyQ API */
    protected $username = null;
    /** @var string|null $password contains the password used to authenticate with the MyQ API */
    protected $password = null;
    /** @var string|null $appId is the application ID used to register with the MyQ API */
    protected $appId = 'NWknvuBd7LoFHfXmKNMBcgajXtZEgKUh4V7WNzMidrpUUluDpVYVZx+xT4PCM5Kx';
    //protected $appId = 'Vj8pQggXLhLy0WHahglCD4N1nAkkXQtGYpq2HrHD7H1nvmbT55KqtN6RSF4ILB%2fi';
    /** @var string|null $securityToken is the auth token returned after a successful login */
    protected $securityToken = null;
    /** @var string|null $userAgent is the User-Agent header value sent with each API request */
    protected $userAgent = 'Chamberlain/3.4.1';
    /** @var string|null $culture is the API culture code for the API */
    protected $culture = 'en';
    /** @var string|null $contentType is the content type used for all cURL requests */
    protected $contentType = 'application/json';
    /** @var array $headers contain HTTP headers for cURL requests */
    protected $_headers = array();
    protected $_deviceId = null;
    protected $_locationName = null;
    protected $_doorName = null;
    protected $_loginUrl = 'https://myqexternal.myqdevice.com/api/v4/User/Validate';
    protected $_getDeviceDetailUrl = 'https://myqexternal.myqdevice.com/api/v4/userdevicedetails/get?&filterOn=true';
    protected $_putDeviceStateUrl = '/api/v4/DeviceAttribute/PutDeviceAttribute';
    /** @var resource|null $_conn is the web connection to the MyQ API */
    protected $_conn = null;
    
    /**
     * Initializes class. Optionally allows user to override variables
     *
     * @param array $params A associative array for overwriting class variables
     *
     * @return MyQ
     */
    public function __construct ($params = array())
    {
        // Overwrite class variables
        foreach ($params as $k => $v) {
            $this->$k = $v;
        }
        
        // Initialize cURL request headers
        if (sizeof($this->_headers) == 0) {
            $this->_headers = array (
                'MyQApplicationId' => $this->appId,
                'Culture' => $this->culture,
                'Content-Type' => $this->contentType,
                'User-Agent' => $this->userAgent,
            );
        }
        
        // Initialize cURL connection
        $this->_init();
        
        return $this;
    }
    
    /**
     * Perform a login request
     *
     * @param string|null $username Username to use when logging in
     * @param string|null $password Password to use for logging in
     *
     * @return MyQ
     */
    public function login ($username = null, $password = null)
    {
        // Set username/password if not null
        if (!is_null($username)) {
            $this->username = $username;
        }
        
        if (!is_null($password)) {
            $this->password = $password;
        }
        
        // confirm that we have a valid username/password
        $error = array();
        if (is_null($this->username)) {
            $error[] = 'username';
        }
        
        if (is_null($this->password)) {
            $error[] = 'password';
        }
        
        if (sizeof($error) > 0) {
            throw new MyQException('Missing required auth credential: ' . implode(',', $error));
        }
        
        $this->_login();
    }
    
    public function getState()
    {
        $this->_getDetails();
        $timeInState = time() - $this->_doorStateTime;
        echo implode(',', array (
            $this->_locationName,
            $this->_doorName,
            $this->_doorState,
            (int)$timeInState,
        ));
    }
    
    public function getDetails()
    {
        return $this->_getDetails();
    }
    
    private function _init()
    {
        if (!isset($this->_conn)) {
            $this->_conn = curl_init();
            
            curl_setopt_array($this->_conn, array (
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING       => "",
                CURLOPT_MAXREDIRS      => 10,
                CURLOPT_TIMEOUT        => 30,
                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                CURLOPT_FAILONERROR    => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_FRESH_CONNECT  => true,
                CURLOPT_FORBID_REUSE   => true,
                CURLOPT_USERAGENT      => $this->userAgent,
            ));
        }
        
        $this->_setHeaders();
    }
    private function _setHeaders()
    {
        $headers = array();
        
        foreach ($this->_headers as $k => $v) {
            $headers[] = "$k: $v";
        }
        
        curl_setopt($this->_conn, CURLOPT_HTTPHEADER, $headers);
    }
    
    private function _login()
    {
        $this->_init();
        
        curl_setopt($this->_conn, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($this->_conn, CURLOPT_URL, $this->_loginUrl);
        
        $post = json_encode(array('username' => $this->username, 'password' => $this->password));
        
        curl_setopt($this->_conn, CURLOPT_POSTFIELDS, $post);
        
        $output = curl_exec($this->_conn);
        
        $data = json_decode($output);
        
        if ($data == false || !isset($data->SecurityToken)) {
            throw new MyQException("Error processing login request: $output");
        }
        
        $this->_headers['SecurityToken'] = $data->SecurityToken;
        
        return $this;
    }
    
    private function _getDetails()
    {
        $this->_init();
        
        curl_setopt($this->_conn, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($this->_conn, CURLOPT_URL, $this->_getDeviceDetailUrl);
        
        $output = curl_exec($this->_conn);
        
        $data = json_decode($output);
        
        if ($data == false || !isset($data->Devices)) {
            throw new MyQException("Error fetching device details: $output");
        }
        
        // Find our door device ID
        foreach ($data->Devices as $device) {
            if (stripos($device->MyQDeviceTypeName, "Gateway") !== false) {
                // Find location name
                foreach ($device->Attributes as $attr) {
                    if ($attr->AttributeDisplayName == 'desc') {
                        $this->_locationName = $attr->Value;
                    }
                }
            }
            
            $this->_deviceId = $device->MyQDeviceId;
            
            foreach ($device->Attributes as $attr) {
                switch ($attr->AttributeDisplayName) {
                    case 'desc':
                        $this->_doorName = $attr->Value;
                        break;
                    case 'doorstate':
                        $this->_doorState = $attr->Value;
                        // UpdatedTime is a timestamp in ms, so we truncate
                        $this->_doorStateTime = (int)$attr->UpdatedTime / 1000;
                        break;
                    default:
                        continue;
                }
            }
        }
    }
}