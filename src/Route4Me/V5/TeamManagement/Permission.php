<?php

namespace Route4Me\V5\TeamManagement;

use Route4Me\Common as Common;

/**
 * Team Management API Permission structure.
 *
 * @since 1.2.7
 */
class Permission extends Common
{
    public ?string $id = null;
    public ?string $title = null;
    public ?string $type = null;

    /**
     * Array of Options.
     */
    public ?array $options = null;

    /**
     * Array of strings.
     */
    public ?array $value = null;

    public function __construct(?array $params = null)
    {
        if ($params !== null) {
            foreach ($this as $key => $value) {
                if (isset($params[$key])) {
                    if ($key === 'options') {
                        $this->{$key} = [];
                        foreach ($params[$key] as $opt_key => $opt_value) {
                            array_push($this->{$key}, new Option($opt_value));
                        }
                    } else {
                        $this->{$key} = $params[$key];
                    }
                }
            }
        }
    }
}
