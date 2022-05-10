<?php

namespace Route4Me\V5;

use Route4Me\Common As Common;

/**
 * Telematics vendor's feature
 */
class TelematicsVendorFeature extends Common
{
    /**
     * Feature ID
     * @var string
     */
   public $id;
   
   /**
    * Feature name
    * @var string
    */
   public $name;
   
   /**
    * Feature slug
    * @var string
    */
   public $slug;
   
   /**
    * Feature group
    * @var string
    */
   public $feature_group;

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
