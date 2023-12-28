<?php

namespace UnitTestFiles\Test;

use Route4Me\Constants;
use Route4Me\Exception\ApiError;
use Route4Me\Route4Me;
use Route4Me\V5\AddressBook\ResponsePagination;
use Route4Me\V5\PodWorkflows\Option;
use Route4Me\V5\PodWorkflows\Action;
use Route4Me\V5\PodWorkflows\ResponsePodWorkflow;
use Route4Me\V5\PodWorkflows\ResponsePodWorkflows;
use Route4Me\V5\PodWorkflows\PodWorkflows;

final class PodWorkflowsTests extends \PHPUnit\Framework\TestCase
{
    public static ?string $created_guid = null;

    public static function setUpBeforeClass() : void
    {
        Route4Me::setApiKey(Constants::API_KEY);
    }

    public function testOptionCanBeCreateEmpty() : void
    {
        $this->assertInstanceOf(Option::class, new Option());
    }

    public function testOptionCanBeCreateFromArray() : void
    {
        $this->assertInstanceOf(Option::class, new Option([
            'name' => '1',
            'value' => '2'
        ]));
    }

    public function testActionCanBeCreateEmpty() : void
    {
        $this->assertInstanceOf(Action::class, new Action());
    }

    public function testActionCanBeCreateFromArray() : void
    {
        $this->assertInstanceOf(Action::class, new Action([
            'title' => 'ti',
            'type' => 'ty',
            'required' => false,
            'options' => [
                [
                    'name' => '2',
                    'value' => '3'
                ], [
                    'name' => '4',
                    'value' => '5'
                ]
            ]
        ]));
    }

    public function testResponsePodWorkflowCanBeCreateEmpty() : void
    {
        $this->assertInstanceOf(ResponsePodWorkflow::class, new ResponsePodWorkflow());
    }

    public function testResponsePodWorkflowBeCreateFromArray() : void
    {
        $this->assertInstanceOf(ResponsePodWorkflow::class, new ResponsePodWorkflow([
            'workflow_guid' => '1',
            'workflow_id' => '2',
            'root_member_id' => 3,
            'is_enabled' => false,
            'is_default' => false,
            'title' => '4',
            'done_actions' => [
                [
                    'title' => 'da_ti1',
                    'type' => 'da_ty1',
                    'required' => false,
                    'options' => [
                        [
                            'name' => 'da_21',
                            'value' => 'da_31'
                        ], [
                            'name' => 'da_41',
                            'value' => 'da_51'
                        ]
                    ]
                ], [
                    'title' => 'da_ti2',
                    'type' => 'da_ty2',
                    'required' => false,
                    'options' => [
                        [
                            'name' => 'da_22',
                            'value' => 'da_32'
                        ], [
                            'name' => 'da_42',
                            'value' => 'da_52'
                        ]
                    ]
                ]
            ],
            'failed_actions' => [[
                'title' => 'fa_ti',
                'type' => 'fa_ty',
                'required' => false,
                'options' => [
                    [
                        'name' => 'fa_2',
                        'value' => 'fa_3'
                    ], [
                        'name' => 'fa_4',
                        'value' => 'fa_5'
                    ]
                ]
            ]],
        ]));
    }

    public function testPodWorkflowsCanBeCreateEmpty() : void
    {
        $this->assertInstanceOf(PodWorkflows::class, new PodWorkflows());
    }

    public function testCreateMustReturnResponsePodWorkflow() : void
    {
        $pod_workflows = new PodWorkflows();
        $res_pod = $pod_workflows->createPodWorkflow([
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
        ]);

        $this->assertInstanceOf(ResponsePodWorkflow::class, $res_pod);
        $this->assertNotNull($res_pod->workflow_guid);
        $this->assertEquals($res_pod->title, 'Super title from 15');
        
        self::$created_guid = $res_pod->workflow_guid;
    }

    public function testGetAllPodWorkflowsMustReturnResponsePodWorkflows() : void
    {
        $pod_workflows = new PodWorkflows();
        $result = $pod_workflows->getAllPodWorkflows([
            'search_query' => 'Super title from 15',
            'order_by' => [['last_updated_timestamp', 'asc']],
            'per_page' => 5
        ]);

        $this->assertInstanceOf(ResponsePodWorkflows::class, $result);
        $this->assertNotNull($result->next_page_cursor);
    }

    public function testGetPodWorkflowMustReturnResponsePodWorkflow() : void
    {
        $pod_workflows = new PodWorkflows();
        $res_pod = $pod_workflows->getPodWorkflow(self::$created_guid);

        $this->assertInstanceOf(ResponsePodWorkflow::class, $res_pod);
        $this->assertNotNull($res_pod->workflow_guid);
        $this->assertEquals($res_pod->workflow_guid, self::$created_guid);
    }

    public function testupdatePodWorkflowMustReturnUpdatedResponsePodWorkflow() : void
    {
        $pod_workflows = new PodWorkflows();
        $res_pod = $pod_workflows->updatePodWorkflow(self::$created_guid, [
            'workflow_id' => 'workflow_super_ID',
            'is_enabled' => false,
            'is_default' => false,
            'title' => 'A new Super title from 15',
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
        ]);

        $this->assertInstanceOf(ResponsePodWorkflow::class, $res_pod);
        $this->assertNotNull($res_pod->title);
        $this->assertEquals($res_pod->title, 'A new Super title from 15');
    }

    public function testDeleteMustReturnDeletedResponsePodWorkflow() : void
    {
        $pod_workflows = new PodWorkflows();
        $result = $pod_workflows->deletePodWorkflow(self::$created_guid);

        $this->assertNotNull($result);
        self::$created_guid = null;
    }

    public static function tearDownAfterClass() : void
    {
        sleep(5);

        if (self::$created_guid !== null) {
            $pod_workflows = new PodWorkflows();
            $pod_workflows->deletePodWorkflow(self::$created_guid);
        }
    }
}
