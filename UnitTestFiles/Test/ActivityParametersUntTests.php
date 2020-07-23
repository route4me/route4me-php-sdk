<?php

namespace UnitTestFiles\Test;

use Route4Me\Address;
use Route4Me\Enum\ActivityTypes;
use Route4Me\Enum\DeviceType;
use Route4Me\OptimizationProblem;
use Route4Me\OptimizationProblemParams;
use Route4Me\Route4Me;
use Route4Me\ActivityParameters;
use Route4Me\RouteParameters;

class ActivityParametersUntTests extends \PHPUnit\Framework\TestCase
{
    public static $route_id = null;
    public static $problem = null;

    public static function setUpBeforeClass()
    {
        Route4Me::setApiKey('bd48828717021141485a701453273458');

        $addresses = [];
        $addresses[] = Address::fromArray([
            'address'           => '11497 Columbia Park Dr W, Jacksonville, FL 32258',
            'is_depot'          => true,
            'lat'               => 30.159341812134,
            'lng'               => -81.538619995117,
            'time'              => 300,
            'time_window_start' => 28800,
            'time_window_end'   => 32400,
        ]);

        $addresses[] = Address::fromArray([
            'address'           => '214 Edgewater Branch Drive 32259',
            'lat'               => 30.103567123413,
            'lng'               => -81.595352172852,
            'time'              => 300,
            'time_window_start' => 36000,
            'time_window_end'   => 37200,
        ]);

        $addresses[] = Address::fromArray([
            'address'           => '756 eagle point dr 32092',
            'lat'               => 30.046422958374,
            'lng'               => -81.508758544922,
            'time'              => 300,
            'time_window_start' => 39600,
            'time_window_end'   => 41400,
        ]);

        $addresses[] = Address::fromArray([
            'address'           => '63 Stone Creek Cir St Johns, FL 32259, USA',
            'lat'               => 30.048496,
            'lng'               => -81.558716,
            'time'              => 300,
            'time_window_start' => 43200,
            'time_window_end'   => 45000,
        ]);

        $parameters = RouteParameters::fromArray([
            'device_type'           => DeviceType::IPAD,
            'disable_optimization'  => false,
            'route_name'            => 'phpunit test '.date('Y-m-d H:i'),
        ]);

        $optimizationParameters = new OptimizationProblemParams();
        $optimizationParameters->setAddresses($addresses);
        $optimizationParameters->setParameters($parameters);

        self::$problem = OptimizationProblem::optimize($optimizationParameters);
        $routes = self::$problem->getRoutes();
        self::$route_id = $routes[0]->route_id;
    }

    public function testFromArray()
    {
        $activityParameters = ActivityParameters::fromArray([
            "activity_id"           => "77BBB5F38723CCCCCCCCCCCCCCCCDD88",
            "member_id"             => 444333,
            "activity_timestamp"    => 1595418362,
            "activity_type"         => "note-insert",
            "activity_message"      => "A note was added to address '63 Stone Creek Cir St Johns, FL 32259, USA' from Web Interface",
            "route_id"              => "38777FFFE274A1F970A3CA8D96F32222",
            "route_destination_id"  => 535455583,
            "note_id"               => 9933366,
            "note_type"             => "Drop Off Occurred",
            "note_contents"         => "Test Add Note To Route Address",
            "route_name"            => "phpunit test 2020-07-22 13:45",
            "note_file"             => "file.ext",
            "destination_name"      => "63 Stone Creek Cir St Johns, FL 32259, USA",
            "destination_alias"     => "Dest Alias",
            "member" => [
                "member_id"         => "444333",
                "member_first_name" => "Olbay",
                "member_last_name"  => "Gustavson",
                "member_email"      => "aaaa1111@gmail.com"
            ]
        ]);

        $this->assertEquals('77BBB5F38723CCCCCCCCCCCCCCCCDD88', $activityParameters->activity_id);

        $this->assertEquals(444333, $activityParameters->member_id);
        $this->assertEquals(1595418362, $activityParameters->activity_timestamp);
        $this->assertEquals('note-insert', $activityParameters->activity_type);
        $this->assertEquals('A note was added to address \'63 Stone Creek Cir St Johns, FL 32259, USA\' from Web Interface', $activityParameters->activity_message);
        $this->assertEquals('38777FFFE274A1F970A3CA8D96F32222', $activityParameters->route_id);
        $this->assertEquals(535455583, $activityParameters->route_destination_id);
        $this->assertEquals(9933366, $activityParameters->note_id);
        $this->assertEquals('Drop Off Occurred', $activityParameters->note_type);
        $this->assertEquals('Test Add Note To Route Address', $activityParameters->note_contents);
        $this->assertEquals('phpunit test 2020-07-22 13:45', $activityParameters->route_name);
        $this->assertEquals('file.ext', $activityParameters->note_file);
        $this->assertEquals('63 Stone Creek Cir St Johns, FL 32259, USA', $activityParameters->destination_name);
        $this->assertEquals('Dest Alias', $activityParameters->destination_alias);
        $this->assertEquals([
            "member_id"         => "444333",
            "member_first_name" => "Olbay",
            "member_last_name"  => "Gustavson",
            "member_email"      => "aaaa1111@gmail.com"
        ], $activityParameters->member);
    }

    public function testGetActivities()
    {
        $activities = new ActivityParameters();

        $activityParameters = ActivityParameters::fromArray([
            'limit' => 10,
            'offset' => 0,
        ]);

        $result = $activities->getActivities($activityParameters);

        $this->assertNotNull($result);
        $this->assertNotNull(isset($result['results']));

        $firstActivity = ActivityParameters::fromArray(
            $result['results'][0]
        );

        $this->assertContainsOnlyInstancesOf(ActivityParameters::class, [$firstActivity]);
    }

    public function testSearchActivities()
    {
        $activities = new ActivityParameters();

        $activityTypes = new ActivityTypes();

        foreach ($activityTypes->getConstants() as $prop => $value) {
            $activityParameters = ActivityParameters::fromArray([
                'activity_type' => $value,
                'limit' => 2,
                'offset' => 0,
            ]);

            $activities = new ActivityParameters();
            $result = $activities->searchActivities($activityParameters);

            $this->assertNotNull($result);
            $this->assertNotNull(isset($result['results']));

            if (sizeof($result['results'])>0) {
                $firstActivity = ActivityParameters::fromArray(
                    $result['results'][0]
                );

                $this->assertContainsOnlyInstancesOf(ActivityParameters::class, [$firstActivity]);
            }
        }
    }

    public function testSendUserMessage()
    {
        $activities = new ActivityParameters();

        $postParameters = ActivityParameters::fromArray([
            'activity_type' => 'user_message',
            'activity_message' => 'Hello - php!',
            'route_id' => self::$route_id,
        ]);

        $result = $activities->sendUserMessage($postParameters);

        $this->assertNotNull($result);
        $this->assertNotNull(isset($result['status']));
        $this->assertTrue(isset($result['status']));
    }

    public static function tearDownAfterClass()
    {
        $optimizationProblemId = self:: $problem->optimization_problem_id;

        $params = [
            'optimization_problem_ids' => [
                '0' => $optimizationProblemId
            ],
            'redirect' => 0,
        ];

        $result = OptimizationProblem::removeOptimization($params);

        if ($result!=null && $result['status']==true) {
            echo "The test optimization was removed <br>";
        } else {
            echo "Cannot remove the test optimization <br>";
        }
    }
}