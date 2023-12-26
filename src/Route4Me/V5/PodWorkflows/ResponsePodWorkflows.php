<?php

namespace Route4Me\V5\PodWorkflows;

use Route4Me\Common as Common;
use Route4Me\V5\PodWorkflows\ResponsePodWorkflow;

/**
 * The proof of delivery workflow API ResponsePodWorkflows structure
 *
 * @since 1.2.10
 *
 * @package Route4Me
 */
class ResponsePodWorkflows extends Common
{
    /**
     * An array of PodWorkflows
     */
    public ?array $data = null;

    /**
     * Name of next page cursor
     */
    public ?string $next_page_cursor = null;

    /**
     * Total items count
     */
    public ?int $total_items_count = null;

    public function __construct(?array $params = null)
    {
        if ($params !== null) {
            foreach ($this as $key => $value) {
                if (isset($params[$key])) {
                    if ($key === 'data') {
                        $this->{$key} = array();
                        foreach ($params[$key] as $pod_wf => $value) {
                            array_push($this->{$key}, new ResponsePodWorkflow($value));
                        }
                    } else {
                        $this->{$key} = $params[$key];
                    }
                }
            }
        }
    }
}
