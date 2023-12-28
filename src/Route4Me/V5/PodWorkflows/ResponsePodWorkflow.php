<?php

namespace Route4Me\V5\PodWorkflows;

use Route4Me\Common as Common;
use Route4Me\V5\PodWorkflows\Action;

/**
 * The proof of delivery workflow API ResponsePodWorkflow structure
 *
 * @since 1.2.10
 *
 * @package Route4Me
 */
class ResponsePodWorkflow extends Common
{
    /**
     * PodWorkflow GUID
     */
    public ?string $workflow_guid = null;

    /**
     * PodWorkflow ID
     */
    public ?string $workflow_id = null;

    /**
     * Member ID
     */
    public ?int $root_member_id = null;

    /**
     * If true, the PodWorkflow is enabled
     */
    public ?bool $is_enabled = null;

    /**
     * If true, the PodWorkflow is default
     */
    public ?bool $is_default = null;

    /**
     * The title of PodWorkflow
     */
    public ?string $title = null;

    /**
     * Done actions as array of Actions
     */
    public ?array $done_actions = null;

    /**
     * Failed actions as array of Actions
     */
    public ?array $failed_actions = null;

    /**
     * The Timestamp of last update
     */
    public ?int $last_updated_timestamp = null;

    public function __construct(?array $params = null)
    {
        if ($params !== null) {
            foreach ($this as $key => $value) {
                if (isset($params[$key])) {
                    if ($key === 'done_actions' || $key === 'failed_actions') {
                        $this->{$key} = array();
                        foreach ($params[$key] as $action => $value) {
                            array_push($this->{$key}, new Action($value));
                        }
                    } else {
                        $this->{$key} = $params[$key];
                    }
                }
            }
        }
    }
}
