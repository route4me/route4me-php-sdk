<?php

namespace Route4Me\V5\PodWorkflows;

use Route4Me\Exception\ApiError;
use Route4Me\Route4Me;
use Route4Me\Common;
use Route4Me\V5\Enum\Endpoint;
use Route4Me\V5\PodWorkflows\ResponsePodWorkflow;
use Route4Me\V5\PodWorkflows\ResponsePodWorkflows;

/**
 * The proof of delivery workflow API
 *
 * @since 1.2.10
 *
 * @package Route4Me
 */
class PodWorkflows extends Common
{
    public function __construct()
    {
        Route4Me::setBaseUrl('');
    }

    /**
     * Create a new PodWorkflow by sending the corresponding data.
     *
     * @since 1.2.10
     *
     * @param  array    $params
     *   string   workflow_id         - PodWorkflow ID,
     *   int      [root_member_id]    - Member ID,
     *   bool     is_enabled          - If true, the PodWorkflow is enabled,
     *   bool     is_default          - If true, the PodWorkflow is default,
     *   string   title               - The title of PodWorkflow,
     *   Action[] [done_actions]      - Array of done actions,
     *   Action[] [failed_actions]    - Array of failed actions,
     * @return ResponsePodWorkflow
     * @throws Exception\ApiError
     */
    public function createPodWorkflow(array $params) : ResponsePodWorkflow
    {
        $allBodyFields = ['workflow_id', 'root_member_id', 'is_enabled', 'is_default',
            'title', 'done_actions', 'failed_actions'];

        return $this->toResponsePodWorkflow(Route4Me::makeRequst([
            'url' => Endpoint::POD_WORKFLOW,
            'method' => 'POST',
            'HTTPHEADER' => 'Content-Type: application/json',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params)
        ]));
    }

    /**
     * Get the list of all PodWorkflow filtered by specifying the corresponding query parameters.
     *
     * @since 1.2.10
     *
     * @param  array    [$params]
     *   int     [per_page]          - Number of PodWorkflows per page,
     *   string  [cursor]
     *   string  [search_query]      - Search in the PodWorkflows by the corresponding query phrase.
     *   array   [order_by]          - Array of pairs PodWorkflow field and its sorting direction,
     *                                 e.g. [["title", "asc"], ["last_updated_timestamp", "desc"]]
     * @return ResponsePodWorkflows
      * @throws Exception\ApiError
    */
    public function getAllPodWorkflows(?array $params = null) : ResponsePodWorkflows
    {
        $allBodyFields = ['per_page', 'cursor', 'search_query', 'order_by'];

        $result = Route4Me::makeRequst([
            'url' => Endpoint::POD_WORKFLOW,
            'method' => 'GET',
            'query' => Route4Me::generateRequestParameters($allBodyFields, $params)
        ]);

        if (is_array($result) && isset($result['data'])) {
            return new ResponsePodWorkflows($result);
        }
        throw new ApiError('Can not convert result to ResponsePodWorkflows object.');
    }

    /**
     * Get the PodWorkflow by specifying the PodWorkflow GUID.
     *
     * @since 1.2.10
     *
     * @param  string $workflow_guid - PodWorkflow GUID.
     * @return ResponsePodWorkflow
     * @throws Exception\ApiError
     */
    public function getPodWorkflow(string $workflow_guid) : ResponsePodWorkflow
    {
        return $this->toResponsePodWorkflow(Route4Me::makeRequst([
            'url' => Endpoint::POD_WORKFLOW . '/' . $workflow_guid,
            'method' => 'GET'
        ]));
    }

    /**
     * Update the PodWorkflow by specifying the GUID and the corresponding PodWorkflow parameters.
     *
     * @since 1.2.10
     *
     * @param  string $workflow_guid - PodWorkflow GUID.
     * @param  array    $params      - PodWorkflow properties, look for more
     *                                 information in createPodWorkflow
     * @return ResponsePodWorkflow
     * @throws Exception\ApiError
     */
    public function updatePodWorkflow(string $workflow_guid, array $params) : ResponsePodWorkflow
    {
        $allBodyFields = ['workflow_id', 'root_member_id', 'is_enabled', 'is_default',
        'title', 'done_actions', 'failed_actions'];

        return $this->toResponsePodWorkflow(Route4Me::makeRequst([
            'url' => Endpoint::POD_WORKFLOW . '/' . $workflow_guid,
            'method' => 'PUT',
            'HTTPHEADER' => 'Content-Type: application/json',
            'body' => Route4Me::generateRequestParameters($allBodyFields, $params)
        ]));
    }

    /**
     * Delete the PodWorkflow by specifying the GUID.
     *
     * @since 1.2.10
     *
     * @param  string $workflow_guid - PodWorkflow GUID.
     * @return bool
     * @throws Exception\ApiError
     */
    public function deletePodWorkflow(string $workflow_guid) : bool
    {
        $res = Route4Me::makeRequst([
            'url' => Endpoint::POD_WORKFLOW . '/' . $workflow_guid,
            'method' => 'DELETE'
        ]);
        return isset($res);
    }

    private function toResponsePodWorkflow($result) : ResponsePodWorkflow
    {
        if (is_array($result) && isset($result['data'])) {
            $data = $result['data'];
            if (is_array($data)) {
                return new ResponsePodWorkflow($data);
            }
        }
        throw new ApiError('Can not convert result to ResponsePodWorkflow object.');
    }
}
