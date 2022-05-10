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
     * @var string
     */
    public $email;
    
    /**
     * Account member ID
     * @var integer
     */
    public $member_id;
    
    /**
     * Account API key
     * @var string
     */
    public $api_key;
    
    /**
     * Account root member ID
     * @var integer
     */
    public $root_member_id;
    
    /**
     * Preferred units of the account.
     * @var string
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
