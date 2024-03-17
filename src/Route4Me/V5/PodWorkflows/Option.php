<?php

namespace Route4Me\V5\PodWorkflows;

use Route4Me\Common as Common;

/**
 * The proof of delivery workflow API Option structure
 *
 * @since 1.2.10
 *
 * @package Route4Me
 */
class Option extends Common
{
    /**
     * Title of action
     */
    public ?string $name = null;

    /**
     * Type of action
     */
    public ?string $value = null;

    public function __construct(?array $params = null)
    {
        if ($params !== null) {
            $this->fillFromArray($params);
        }
    }
}
