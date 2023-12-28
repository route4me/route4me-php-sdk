<?php

namespace Route4Me\V5\PodWorkflows;

use Route4Me\Common as Common;
use Route4Me\V5\PodWorkflows\Option;

/**
 * The proof of delivery workflow API Action structure
 *
 * @since 1.2.10
 *
 * @package Route4Me
 */
class Action extends Common
{
    /**
     * Title of action
     */
    public ?string $title = null;

    /**
     * Type of action
     */
    public ?string $type = null;

    /**
     * If true, the action is required
     */
    public ?bool $required = null;

    /**
     * Options of the action as array of Options
     */
    public ?array $options = null;

    public function __construct(?array $params = null)
    {
        if ($params !== null) {
            foreach ($this as $key => $value) {
                if (isset($params[$key])) {
                    if ($key === 'options') {
                        $this->{$key} = array();
                        foreach ($params[$key] as $option => $value) {
                            array_push($this->{$key}, new Option($value));
                        }
                    } else {
                        $this->{$key} = $params[$key];
                    }
                }
            }
        }
    }
}
