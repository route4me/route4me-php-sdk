<?php

namespace Route4Me\TelematicsGateway;

use Route4Me\Common as Common;

/**
 * Parameters for requesting the telematics connection.
 */
class TelematicsConnectionParameters extends Common
{
    /**
     * Account ID
     * @var type string
     */
    public $account_id;
    
    /**
     * User name
     * @var type string
     */
    public $username;
    
    /**
     * Password
     * @var type string
     */
    public $password;
    
    /**
     * Connection host
     * @var type string
     */
    public $host;
    
    /**
     * An unique ID of a telematics vendor.
     * @var type integer
     */
    public $vendor_id;
    
    /**
     * Telematics connection name
     * @var type string
     */
    public $name;
    
    /**
     * Vehicle tracking interval in seconds
     * @var type integer
     */
    public $vehicle_position_refresh_rate;
    
    /**
     * Connection token
     * @var type string
     */
    public $connection_token;
    
    /**
     * Connection user ID
     * @var type integer
     */
    public $user_id;
    
    /**
     * Connection ID
     * @var type integer
     */
    public $id;
    
    /**
     * Telemetics connection type
     * @var type string
     */
    public $vendor;
    
    /**
     * Validate connections credentials.
     * @var type Boolean
     */
    public $validate_remote_credentials;
}
