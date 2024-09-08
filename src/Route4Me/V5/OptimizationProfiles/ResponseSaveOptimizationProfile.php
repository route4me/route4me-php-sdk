<?php

namespace Route4Me\V5\OptimizationProfiles;

use Route4Me\Common as Common;
use Route4Me\V5\OptimizationProfiles\Part;

/**
 * The optimization profile API ResponseSaveOptimizationProfile structure
 *
 * @since 1.4.0
 *
 * @package Route4Me
 */
class ResponseSaveOptimizationProfile extends Common
{
    /**
     * GUID
     */
    public ?string $guid = null;

    /**
     * ID
     */
    public ?string $id = null;

    /**
     * parts as array of Parts
     */
    public ?array $parts = null;

    public function __construct(?array $params = null)
    {
        if ($params !== null) {
            foreach ($this as $key => $value) {
                if (isset($params[$key])) {
                    if ($key === 'parts') {
                        $this->{$key} = array();
                        foreach ($params[$key] as $part => $value) {
                            array_push($this->{$key}, new Part($value));
                        }
                    } else {
                        $this->{$key} = $params[$key];
                    }
                }
            }
        }
    }
}
