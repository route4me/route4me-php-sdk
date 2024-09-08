<?php

namespace Route4Me\V5\OptimizationProfiles;

use Route4Me\Common as Common;

/**
 * The optimization profile API Part structure
 *
 * @since 1.4.0
 *
 * @package Route4Me
 */
class Part extends Common
{
    /**
     * GUID
     */
    public ?string $guid = null;

    /**
     * Data as JSON string
     */
    public ?string $Data = null;

    /**
     * Config as JSON string
     */
    public ?string $Config = null;

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
