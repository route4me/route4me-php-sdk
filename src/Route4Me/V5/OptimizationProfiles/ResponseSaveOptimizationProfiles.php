<?php

namespace Route4Me\V5\OptimizationProfiles;

use Route4Me\Common as Common;
use Route4Me\V5\OptimizationProfiles\ResponseSaveOptimizationProfile;

/**
 * The optimization profile API ResponseSaveOptimizationProfiles structure
 *
 * @since 1.4.0
 *
 * @package Route4Me
 */
class ResponseSaveOptimizationProfiles extends Common
{
    /**
     * An array of SaveOptimizationProfiles
     */
    public ?array $items = null;

    public function __construct(?array $params = null)
    {
        if ($params !== null) {
            foreach ($this as $key => $value) {
                if (isset($params[$key])) {
                    if ($key === 'items') {
                        $this->{$key} = array();
                        foreach ($params[$key] as $op => $value) {
                            array_push($this->{$key}, new ResponseSaveOptimizationProfile($value));
                        }
                    }
                }
            }
        }
    }
}
