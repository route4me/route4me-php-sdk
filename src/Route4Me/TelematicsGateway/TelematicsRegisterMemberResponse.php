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
     * @var type string
     */
    public $api_token;
    
    /**
     * When the registered member updated
     * @var type string
     */
    public $updated_at;
    
    /**
     * When the registered member created
     * @var type
     */
    public $created_at;
    
    /**
     * Telemetics member ID
     * @var type
     */
    public $id;
}
