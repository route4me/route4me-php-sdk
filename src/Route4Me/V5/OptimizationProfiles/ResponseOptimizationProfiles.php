<?php

namespace Route4Me\V5\OptimizationProfiles;

use Route4Me\Common as Common;
use Route4Me\V5\OptimizationProfiles\ResponseOptimizationProfile;

/**
 * The optimization profile API ResponseOptimizationProfiles structure
 *
 * @since 1.4.0
 *
 * @package Route4Me
 */
class ResponseOptimizationProfiles extends Common
{
    /**
     * An array of OptimizationProfiles
     */
    public ?array $items = null;

    public function __construct(?array $params = null)
    {
        if ($params !== null) {
            foreach ($this as $key => $value) {
                if (isset($params[$key])) {
                    if ($key === 'items') {
                        $this->{$key} = array();
                        foreach ($params[$key] as $pod_wf => $value) {
                            array_push($this->{$key}, new ResponseOptimizationProfile($value));
                        }
                    }
                }
            }
        }
    }
}
