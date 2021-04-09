<?php


namespace Route4Me\TelematicsGateway;

use Route4Me\Common as Common;

class CreateConnectionResponse extends Common
{
    /**
     * Telematics connection access account_id
     * @var string
     */
    public $account_id;

    /**
     * Telematics connection access api_key
     * @var string
     */
    public $api_key;

    /**
     * Telematics connection access token
     * @var string
     */
    public $connection_token;

    /**
     * When the connection created
     * @var string
     */
    public $created_at;

    /**
     * Telemetics connection ID
     * @var integer
     */
    public $id;

    /**
     * Metadata, custom key-value storage.
     * @var array
     */
    public $metadata;

    /**
     * Telemetics connection name
     * @var string
     */
    public $name;

    /**
     * Telematics connection access password
     * @var string
     */
    public $password;

    /**
     * Synchronized vehicles number
     * @var integer
     */
    public $synced_vehicles_count;

    /**
     * Total vehicles number
     * @var integer
     */
    public $total_vehicles_count;

    /**
     * When the connection updated
     * @var string
     */
    public $updated_at;

    /**
     * Connection user ID
     * @var integer
     */
    public $user_id;

    /**
     * Telematics connection access username
     * @var string
     */
    public $username;

    /**
     * Vehicle tracking interval in seconds.
     * @var integer
     */
    public $vehicle_position_refresh_rate;

    /**
     * Telemetics connection vendor
     * @var string
     */
    public $vendor ;

    /**
     * Telemetics connection type ID
     * @var integer
     */
    public $vendor_id ;

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