<?php

namespace Route4Me\TelematicsGateway;

use Route4Me\Common As Common;

/**
 * Parameters for requesting the telematics connection.
 */
class TelematicsConnectionParameters extends Common
{
    /**
     * Account ID
     * @var string
     */
    public $account_id;
    
    /**
     * User name
     * @var string
     */
    public $username;
    
    /**
     * Password
     * @var string
     */
    public $password;
    
    /**
     * Connection host
     * @var string
     */
    public $host;
    
    /**
     * An unique ID of a telematics vendor.
     * @var integer
     */
    public $vendor_id;
    
    /**
     * Telematics connection name
     * @var string
     */
    public $name;
    
    /**
     * Vehicle tracking interval in seconds
     * @var integer
     */
    public $vehicle_position_refresh_rate;
    
    /**
     * Connection token
     * @var string
     */
    public $connection_token;
    
    /**
     * Connection user ID
     * @var integer
     */
    public $user_id;
    
    /**
     * Connection ID
     * @var integer
     */
    public $id;
    
    /**
     * Telemetics connection type
     * @var string
     */
    public $vendor;
    
    /**
     * Validate connections credentials.
     * @var Boolean
     */
    public $validate_remote_credentials;

    public static function fromArray(array $params)
    {
        $thisParams = new self();

        foreach ($params as $key => $value) {
            if (property_exists($thisParams, $key)) {
                $thisParams->{$key} = $value;
            }
        }

        return $thisParams;
    }
}
