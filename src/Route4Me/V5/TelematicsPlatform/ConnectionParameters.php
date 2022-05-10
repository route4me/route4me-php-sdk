<?php

namespace Route4Me\V5\TelematicsPlatform;

use Route4Me\Common As Common;

/**
 * The telematics connection query parameters.
 * Used for: create, update, get connection(s).
 */
class ConnectionParameters extends Common
{
    /**
     * Telemetics connection type
     * @var string
     */
    public $vendor;
    
    /**
     * Telemetics connection type ID
     * @var integer
     */
    public $vendor_id;
    
    /**
     * Telemetics connection name
     * Required for telematics connection registration.
     * @var string
     */
    public $name;
    
    /**
     * Telematics connection access host.
     * @var string
     */
    public $host;
    
    /**
     * Telematics connection access api_key.
     * @var string
     */
    public $api_key;
    
    /**
     * Telematics connection access account_id.
     * @var string
     */
    public $account_id;
    
    /**
     * Telematics connection access username
     * @var string
     */
    public $username;
    
    /**
     * Telematics connection access password.
     * @var string
     */
    public $password;
    
    /**
     * Vehicle tracking interval in seconds (default value 60).
     * @var integer
     */
    public $vehicle_position_refresh_rate;
    
    /**
     * Validate connections credentials.
     * @var Boolean
     */
    public $validate_remote_credentials;
    
    /**
     * Disable/enable vehicle tracking.
     * @var Boolean
     */
    public $is_enabled;
    
    /**
     * Metadata
     * @var string
     */
    public $metadata;
    
    /**
     * Telematics connection access token.
     * Required to show specified connection.
     * @var string
     */
    public $connection_token;

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
