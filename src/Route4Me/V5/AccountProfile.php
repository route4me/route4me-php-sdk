<?php

namespace Route4Me\V5;

use Route4Me\Common As Common;

/**
 * Account profile
 */
class AccountProfile extends Common
{
    /**
     * Account profile email
     * @var type string
     */
    public $email;
    
    /**
     * Account member ID
     * @var type integer
     */
    public $member_id;
    
    /**
     * Account API key
     * @var type string
     */
    public $api_key;
    
    /**
     * Account root member ID
     * @var type integer
     */
    public $root_member_id;
    
    /**
     * Preferred units of the account.
     * @var type string
     */
    public $preferred_units;
    
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
