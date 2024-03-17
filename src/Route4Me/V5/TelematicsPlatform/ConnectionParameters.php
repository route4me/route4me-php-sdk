<?php

namespace Route4Me\V5\TelematicsPlatform;

use Route4Me\Common as Common;

/**
 * The telematics connection query parameters.
 * Used for: create, update, get connection(s).
 */
class ConnectionParameters extends Common
{
    /**
     * Telemetics connection type
     * @var type string
     */
    public $vendor;
    
    /**
     * Telemetics connection type ID
     * @var type integer
     */
    public $vendor_id;
    
    /**
     * Telemetics connection name
     * Required for telematics connection registration.
     * @var type string
     */
    public $name;
    
    /**
     * Telematics connection access host.
     * @var type string
     */
    public $host;
    
    /**
     * Telematics connection access api_key.
     * @var type string
     */
    public $api_key;
    
    /**
     * Telematics connection access account_id.
     * @var type string
     */
    public $account_id;
    
    /**
     * Telematics connection access username
     * @var type string
     */
    public $username;
    
    /**
     * Telematics connection access password.
     * @var type string
     */
    public $password;
    
    /**
     * Vehicle tracking interval in seconds (default value 60).
     * @var type integer
     */
    public $vehicle_position_refresh_rate;
    
    /**
     * Validate connections credentials.
     * @var type Boolean
     */
    public $validate_remote_credentials;
    
    /**
     * Disable/enable vehicle tracking.
     * @var type Boolean
     */
    public $is_enabled;
    
    /**
     * Metadata
     * @var type string
     */
    public $metadata;
    
    /**
     * Telematics connection access token.
     * Required to show specified connection.
     * @var type string
     */
    public $connection_token;
}
