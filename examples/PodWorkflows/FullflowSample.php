<?php

//**********************************************************************
// Proof of Delivery Workflow fulflow sample.
//**********************************************************************

namespace Route4Me;

$root = realpath(dirname(__FILE__).'/../../');
require $root.'/vendor/autoload.php';

use Exception;
use Route4Me\Exception\ApiError;
use Route4Me\V5\PodWorkflows\PodWorkflows;

// Set the api key in the Route4me class
Route4Me::setApiKey(Constants::API_KEY);

$created_pod_guid = null;

// new PoD Workflow
$params = [
    'workflow_id' => 'workflow_super_ID',
    'is_enabled' => false,
    'is_default' => false,
    'title' => 'Super title from 15',
    'done_actions' => [[
        'title' => 'Signee Name',
        'type' => 'signeeName',
        'required' => true
    ]],
    'failed_actions' => [[
        'title' => 'Signee Name Failed',
        'type' => 'signeeName',
        'required' => false
    ]]
];

$pws = new PodWorkflows();

try {
    // create
    $new_pod = $pws->createPodWorkflow($params);

    if (isset($new_pod->workflow_guid)) {
        $created_pod_guid = $new_pod->workflow_guid;
        echo 'Created PodWorkflow with GUID: ' . $created_pod_guid . PHP_EOL;

        // read
        $read_pod = $pws->getPodWorkflow($created_pod_guid);
        echo 'Read PodWorkflow with GUID: ' . $read_pod->workflow_guid . PHP_EOL;

        // update
        $params['title'] = 'A new Super title from 15';
        $updated_pod = $pws->updatePodWorkflow($created_pod_guid, $params);
        echo 'Updated PodWorkflow with GUID: ' . $updated_pod->workflow_guid
            . ', new title is "'. $updated_pod->title . '"' . PHP_EOL;

        //delete
        $res = $pws->deletePodWorkflow($created_pod_guid);
        echo 'Deleted PodWorkflow with GUID: ' . $created_pod_guid . PHP_EOL;
    } else {
        echo 'Error creating PodWorkflow.' . PHP_EOL;
    }
} catch (Exception | ApiError $e) {
    echo 'Error, Code: ' . $e->getCode() . PHP_EOL . 'Message: ' . $e->getMessage() . PHP_EOL;

    if ($created_pod_guid) {
        echo 'Cleanup PodWorkflow with GUID: ' . $created_pod_guid . PHP_EOL;
        try {
            $pws->deletePodWorkflow($created_pod_guid);
        } catch (Exception | ApiError $e) {
            echo 'Error: Cleanup.' . PHP_EOL;
            echo $e->getMessage() . PHP_EOL;
        }
    }
}
