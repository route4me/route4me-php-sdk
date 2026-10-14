<?php

namespace Route4Me\V5\TeamManagement;

use Route4Me\Common as Common;

/**
 * Team Management API Option structure.
 *
 * @since 1.2.7
 */
class Option extends Common
{
    public ?string $value = null;
    public ?string $title = null;

    public function __construct(?array $params = null)
    {
        if ($params !== null) {
            $this->fillFromArray($params);
        }
    }
}
