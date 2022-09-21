<?php

namespace Route4Me\TelematicsGateway;

use Route4Me\Enum\Endpoint;
use Route4Me\Route4Me;

/**
 * The response structure from the endpoint /connections
 */
class TelematicsConnection extends \Route4Me\Common
{
    /**
     * Telematics connection access account_id
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
     * Telemetics connection type ID
     * @var integer
     */
    public $vendor_id;
    
    /**
     * Telemetics connection name
     * @var string
     */
    public $name;
    
    /**
     * Vehicle tracking interval in seconds.
     * @var integer
     */
    public $vehicle_position_refresh_rate;
    
    /**
     * Maximum idle time
     * @var integer
     */
    public $max_idle_time;
    
    /**
     * Disable/enable vehicle tracking
     * @var integer
     */
    public $is_enabled;
    
    /**
     * The last timestamp, when the vehicles reloaded.
     * @var integer
     */
    public $last_vehicles_reload;
    
    /**
     * The last timestamp, when the addresses reloaded.
     * @var integer
     */
    public $last_addresses_reload;
    
    /**
     * The last timestamp, when the positions reloaded.
     * @var integer
     */
    public $last_position_reload;
    
    /**
     * Telematics connection access token
     * @var string
     */
    public $connection_token;
    
    /**
     * Connection user ID
     * @var integer
     */
    public $user_id;
    
    /**
     * When the connection updated
     * @var string
     */
    public $updated_at;
    
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
     * Total vehicles number
     * @var integer
     */
    public $total_vehicles_count;
    
    /**
     * Total addresses number
     * @var integer
     */
    public $total_addresses_count;
    
    /**
     * Synchronized vehicles number
     * @var integer
     */
    public $synced_vehicles_count;
    
    /**
     * Telemetics connection vendor
     * @var string
     */
    public $vendor;

    /**
     * Validate connections credentials.<br>
     * If true, the connection validated.
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

    /**
     * Create a telematics connection.
     * @param $apiToken string : API token
     * @param $params TelematicsConnectionParameters : Telematics connection parameters
     * @return array Array from a TelematicsConnection type object
     * @throws \Route4Me\Exception\ApiError
     */
    public function createTelematicsConnection($apiToken, $params)
    {
        Route4Me::setBaseUrl(Endpoint::BASE_URL);

        $excludeFields = ['id', 'connection_token'];

        $allBodyFields = Route4Me::getObjectProperties(new TelematicsConnectionParameters(), $excludeFields);

        $result = Route4Me::makeRequst([
            'url'    => Endpoint::TELEMATICS_CONNECTION,
            'method' => 'POST',
            'body'   => Route4Me::generateRequestParameters($allBodyFields, $params),
            'query'  => ['api_token' => $apiToken],
            'HTTPHEADER'    => 'Content-Type: multipart/form-data',
        ]);

        return $result;
    }

    /**
     * Delete a telematics connection.
     * @param $apiToken string : API token
     * @param $connectionToken string : connection token
     * @return array Array from a TelematicsConnection type object
     * @throws \Route4Me\Exception\ApiError
     */
    public function deleteTelematicsConnection($apiToken, $connectionToken)
    {
        Route4Me::setBaseUrl(Endpoint::BASE_URL);

        $result = Route4Me::makeRequst([
            'url'    => Endpoint::TELEMATICS_CONNECTION,
            'method' => 'DELETE',
            'query'  => [
                    'api_token'         => $apiToken,
                    'connection_token'  => $connectionToken
                ],
        ]);

        return $result;
    }

    /**
     * Get all telematics connections.
     * @param $apiToken string : API token
     * @return array Array of the TelematicsConnection type objects
     * @throws \Route4Me\Exception\ApiError
     */
    public function getTelematicsConnections($apiToken)
    {
        Route4Me::setBaseUrl(Endpoint::BASE_URL);

        $result = Route4Me::makeRequst([
            'url'    => Endpoint::TELEMATICS_CONNECTION,
            'method' => 'GET',
            'query'  => [
                'api_token' => $apiToken
            ],
        ]);

        return $result;
    }

    /**
     * Get a telematics connection
     * @param $apiToken string : API token
     * @param $connectionToken string : connection token
     * @return array Array from a TelematicsConnection type object
     * @throws \Route4Me\Exception\ApiError
     */
    public function getTelematicsConnection($apiToken, $connectionToken)
    {
        Route4Me::setBaseUrl(Endpoint::BASE_URL);

        $result = Route4Me::makeRequst([
            'url'    => Endpoint::TELEMATICS_CONNECTION,
            'method' => 'GE',
            'query'  => [
                'api_token'         => $apiToken,
                'connection_token'  => $connectionToken
            ],
        ]);

        return $result;
    }

    /**
     * Update telematics connection
     * @param $apiToken string : API token
     * @param $connectionToken string : connection token
     * @param $teleConParams TelematicsConnectionParameters : Telematics connection parameters
     * @return array Array from a TelematicsConnection type object
     * @throws \Route4Me\Exception\ApiError
     */
    public function updateTelematicsConnection($apiToken, $connectionToken, $teleConParams)
    {
        $excludeFields = ['id', 'connection_token'];

        $allBodyFields = Route4Me::getObjectProperties(new TelematicsConnectionParameters(), $excludeFields);

        $result = Route4Me::makeRequst([
            'url'    => Endpoint::TELEMATICS_CONNECTION,
            'method' => 'PUT',
            'body'   => Route4Me::generateRequestParameters($allBodyFields, $teleConParams),
            'query'  => ['api_token' => $apiToken, 'connection_token' => $connectionToken],
            'HTTPHEADER'    => 'Content-Type: multipart/form-data',
        ]);

        return $result;
    }
}
