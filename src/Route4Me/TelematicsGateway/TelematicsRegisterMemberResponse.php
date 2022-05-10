<?php

namespace Route4Me\TelematicsGateway;

/**
 * Response from the process of a telematics member registering.
 */
class TelematicsRegisterMemberResponse extends \Route4Me\Common
{
    /**
     * API token
     * Use for the operations: 
     * Get Telematics Connections, Register Telematics Connection
     * @var string
     */
    public $api_token;
    
    /**
     * When the registered member updated
     * @var string
     */
    public $updated_at;
    
    /**
     * When the registered member created
     * @var integer
     */
    public $created_at;
    
    /**
     * Telemetics member ID
     * @var integer
     */
    public $id;

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
