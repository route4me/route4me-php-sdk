<?php

namespace Route4Me\V5\TelematicsPlatform;

use Route4Me\Common As Common;

/**
 * The response structure from the endpoint /connections
 */
class Connection extends Common
{
    /**
     * Telemetics connection name
     * @var string
     */
    public $name;
    
    /**
     * Telemetics connection type
     * @var string
     */
    public $vendor;
   
    /**
     * Telematics connection access host
     * @var string
     */
    public $host;
    
    /**
     * Telematics connection access api_key
     * @var string
     */
    public $api_key;
    
    /**
     * Telematics connection access account ID.
     * @var string
     */
    public $account_id;
    
    /**
     * Telematics connection access username
     * @var string
     */
    public $username;
    
    /**
     * Telematics connection access password
     * @var string
     */
    public $password;
    
    /**
     * Telematics connection access token
     * @var string
     */
    public $connection_token;
    
    /**
     * Telemetics connection type ID
     * @var integer
     */
    public $vendor_id;
    
    /**
     * Disable/enable vehicle tracking
     * @var Boolean
     */
    public $is_enabled;
    
    /**
     * Vehicle tracking interval in seconds
     * @var integer
     */
    public $vehicle_position_refresh_rate;
    
    /**
     * Maximum idle time
     * @var integer
     */
    public $max_idle_time;
    
    /**
     * Syncronized vehicles count
     * @var integer
     */
    public $synced_vehicles_count;
    
    /**
     * Total vehicles count
     * @var integer
     */
    public $total_vehicles_count;
    
    /**
     * Total addresses count
     * @var integer
     */
    public $total_addresses_count;
    
    /**
     * The last timestamp the vehicles reloaded
     * @var string
     */
    public $last_vehicles_reload;
    
    /**
     * The last timestamp the addresses reloaded
     * @var string
     */
    public $last_addresses_reload;
    
    /**
     * The last timestamp the postions reloaded
     * @var string
     */
    public $last_position_reload;
    
    /**
     * Metadata, custom key-value storage.
     * @var array
     */
    public $metadata = [];
    
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
