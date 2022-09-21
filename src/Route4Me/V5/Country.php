<?php

namespace Route4Me\V5;

use Route4Me\Common As Common;

/**
 * The Country class.
 */
class Country extends Common
{
    /**
     * Country ID
     * @var string
     */
    public $id;
    
    /**
     * Country code
     * @var string
     */
    public $country_code;
    
    /**
     * Country name
     * @var string
     */
    public $country_name;
    
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
