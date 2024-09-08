<?php

namespace Route4Me\V5\OptimizationProfiles;

use Route4Me\Common as Common;

/**
 * The optimization profile API ResponseOptimizationProfile structure
 *
 * @since 1.4.0
 *
 * @package Route4Me
 */
class ResponseOptimizationProfile extends Common
{
    /**
     * OptimizationProfile ID
     */
    public ?string $optimization_profile_id = null;

    /**
     * Name OptimizationProfile
     */
    public ?string $profile_name = null;

    /**
     * If true, the OptimizationProfile is default
     */
    public ?bool $is_default = null;

    public function __construct(?array $params = null)
    {
        if ($params !== null) {
            foreach ($this as $key => $value) {
                if (isset($params[$key])) {
                    $this->{$key} = $params[$key];
                }
            }
        }
    }
}
