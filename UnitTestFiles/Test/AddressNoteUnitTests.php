<?php

namespace UnitTestFiles\Test;

use Route4Me\Address;
use Route4Me\AddressNote;
use Route4Me\AddressNoteResponse;
use Route4Me\Constants;
use Route4Me\CustomNoteType;
use Route4Me\CustomNoteTypeResponse;
use Route4Me\Enum\DeviceType;
use Route4Me\OptimizationProblem;
use Route4Me\OptimizationProblemParams;
use Route4Me\Route4Me;
use Route4Me\RouteParameters;

class AddressNoteUnitTests extends \PHPUnit\Framework\TestCase
{
    protected $addressNote;

    public static $problem;

    public static $route_id = null;
    public static $address_id = null;
    public static $address_lat = null;
    public static $address_lng = null;
    public static $address_is_depot = null;
    public static $noteAddressId = null;
    public static $noteFileAddressId = null;

    public static $addresIdMarkedAsVisited;

    public static $afterAddressId;
    public static $route_id_dest;

    public static $createdCustomNotes;

    public static function setUpBeforeClass()
    {
        Route4Me::setApiKey(Constants::API_KEY);

        //<editor-fold desc="Prepare Addresses">
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

        $addresses[] = Address::fromArray([
            'address'           => 'St Johns Florida 32259, USA',
            'lat'               => 30.099642,
            'lng'               => -81.547201,
            'time'              => 300,
            'time_window_start' => 46800,
            'time_window_end'   => 48600,
        ]);

        $parameters = RouteParameters::fromArray([
            'device_type'           => DeviceType::IPAD,
            'disable_optimization'  => false,
            'route_name'            => 'phpunit test '.date('Y-m-d H:i'),
        ]);
        //</editor-fold>

        $optimizationParameters = new OptimizationProblemParams();
        $optimizationParameters->setAddresses($addresses);
        $optimizationParameters->setParameters($parameters);

        self::$problem = OptimizationProblem::optimize($optimizationParameters);
        $routes = self::$problem->getRoutes();
        self::$route_id = $routes[0]->route_id;
        self::$noteAddressId = $routes[0]->addresses[2]->route_destination_id;
        self::$noteFileAddressId = $routes[0]->addresses[3]->route_destination_id;

        $addresses = self::$problem->addresses;
        self::$address_id = $addresses[1]->getAddressId();
        //self::$address_address = $addresses[1]->address;
        self::$address_lat = $addresses[1]->lat;
        self::$address_lng = $addresses[1]->lng;
        self::$address_is_depot = $addresses[1]->is_depot;

        $noteParameters = [
            'route_id'          => self::$route_id,
            'address_id'        => self::$address_id,
            'dev_lat'           => self::$address_lat,
            'dev_lng'           => self::$address_lng,
            'device_type'       => 'web',
            'strUpdateType'     => 'dropoff',
            'strNoteContents'   => 'Test Address Note',
        ];

        $addressNote = new AddressNote();

        $addresses[1] = $addressNote->AddAddressNote($noteParameters);

        self::$createdCustomNotes = [];

        $customNoteTypes = $addressNote->getAllCustomNoteTypes();

        foreach ($customNoteTypes as $custNote) {
            if ($custNote['note_custom_type'] == 'Unit Test To Do') {
                self::$createdCustomNotes[]='Unit Test To Do';
            }
        }

        if (sizeof(self::$createdCustomNotes)<1) {
            $customNoteTypeParameters = [
                'type'   => 'Unit Test To Do',
                'values' => [
                    'Pass a package',
                    'Pickup package',
                    'Do a service',
                ],
            ];

            $customNoteTypeResult = $addressNote->createCustomNoteType($customNoteTypeParameters);

            if ($customNoteTypeResult!=null
                && $customNoteTypeResult['result']!=null
                && $customNoteTypeResult['result']=='OK'
                && $customNoteTypeResult['affected']!=null
                && $customNoteTypeResult['affected']==1
            ) {
                self::$createdCustomNotes[]='Unit Test To Do';
            }
        }
    }

    public function testFromArray()
    {
        $addressNote = AddressNote::fromArray([
            'note_id'               => 539264,
            'route_id'              => '5555E83A4BE0055551537955558D5555',
            'route_destination_id'  => 162916895,
            'ts_added'              => 1466515325,
            'activity_type'         => 'dropoff',
            'upload_id'             => '1a499993c63d68d1a5d26045a1763d16',
            'upload_extension'      => 'csv',
            'upload_url'            => 'http:\/\/adb6def9928467589ebb-f540d5a8d53c2e76ad581b6e5c346ad6.\/1a499113c63d68d1a5d26045a1763d16.csv',
            'upload_type'           => 'ANY_FILE',
            'contents'              => 'Some text',
            'lat'                   => 33.132675,
            'lng'                   => -83.244743,
            'device_type'           => 'web'
        ]);

        $this->assertEquals(539264, $addressNote->note_id);
        $this->assertEquals('5555E83A4BE0055551537955558D5555', $addressNote->route_id);
        $this->assertEquals(162916895, $addressNote->route_destination_id);
        $this->assertEquals(1466515325, $addressNote->ts_added);
        $this->assertEquals('dropoff', $addressNote->activity_type);
        $this->assertEquals('1a499993c63d68d1a5d26045a1763d16', $addressNote->upload_id);
        $this->assertEquals('csv', $addressNote->upload_extension);
        $this->assertEquals('http:\/\/adb6def9928467589ebb-f540d5a8d53c2e76ad581b6e5c346ad6.\/1a499113c63d68d1a5d26045a1763d16.csv', $addressNote->upload_url);
        $this->assertEquals('ANY_FILE', $addressNote->upload_type);
        $this->assertEquals('Some text', $addressNote->contents);
        $this->assertEquals(33.132675, $addressNote->lat);
        $this->assertEquals(-83.244743, $addressNote->lng);
        $this->assertEquals('web', $addressNote->device_type);
    }

    public function testGetAddressesNotes()
    {
        $noteParameters = [
            'route_id'              => self::$route_id,
            'route_destination_id'  => self::$address_id,
        ];

        $addressNote = new AddressNote();

        $addressWithNotes = Address::fromArray(
             $addressNote->GetAddressesNotes($noteParameters)
        );

        $firstNote = AddressNote::fromArray(
            $addressWithNotes->notes[0]
        );

        $this->assertNotNull($addressWithNotes);
        $this->assertTrue(sizeof( $addressWithNotes->notes)>0);
        $this->assertContainsOnlyInstancesOf(AddressNote::class, [$firstNote]);
        $this->assertEquals('Test Address Note', $firstNote->contents);
        $this->assertEquals('dropoff',$firstNote->activity_type);
    }

    public function testAddAddressNote()
    {
        $noteParameters = [
            'strFilename'       => 'notes.csv',
            'route_id'          => self::$route_id,
            'address_id'        => self::$noteAddressId,
            'dev_lat'           => 33.132675170898,
            'dev_lng'           => -83.244743347168,
            'device_type'       => 'web',
            'strUpdateType'     => 'dropoff',
            'strNoteContents'   => 'Test Add Note To Route Address',
        ];

        $addressNote = new AddressNote();

        $response = AddressNoteResponse::fromArray(
            $addressNote->AddAddressNote($noteParameters)
        );

        $this->assertNotNull($response);
        $this->assertContainsOnlyInstancesOf(AddressNoteResponse::class, [$response]);

        $firstNote = AddressNote::fromArray(
            $response->note
        );

        $this->assertContainsOnlyInstancesOf(AddressNote::class, [$firstNote]);
        $this->assertEquals('Test Add Note To Route Address', $firstNote->contents);
        $this->assertNotNull($firstNote->upload_id);
    }

    public function testAddNoteFile()
    {
        //$this->markTestSkipped('must be revisited.');

        $noteParameters = [
            'strFilename'   => dirname(__FILE__).'\data\notes.csv',
            'route_id'      => self::$route_id,
            'address_id'    => self::$noteFileAddressId,
            'dev_lat'       => 33.132675170898,
            'dev_lng'       => -83.244743347168,
            'device_type'   => 'web',
            'strUpdateType' => 'dropoff',
        ];

        $addressNote = new AddressNote();

        $result = $addressNote->AddNoteFile($noteParameters);

        $response = AddressNoteResponse::fromArray(
            $result
        );

        sleep(5);

        $this->assertNotNull($response);
        $this->assertNotNull($response->status);
        $this->assertTrue($response->status);
        $this->assertContainsOnlyInstancesOf(AddressNoteResponse::class, [$response]);

        $firstNote = AddressNote::fromArray(
            $response->note
        );

        $this->assertContainsOnlyInstancesOf(AddressNote::class, [$firstNote]);
        $this->assertNotNull($firstNote->upload_id);
        $this->assertNotNull($firstNote->upload_url);
        $this->assertEquals('csv', $firstNote->upload_extension);
    }

    public function testGetCustomNoteTypeByKey()
    {
        $addressNote = new AddressNote();

        $customNoteType = $addressNote->getCustomNoteTypeByKey(self::$createdCustomNotes[0]);

        $this->assertEquals(self::$createdCustomNotes[0],$customNoteType['note_custom_type']);
    }

    public function testGetAllCustomNoteTypes()
    {
        $addressNote = new AddressNote();

        $customNoteTypes =  $addressNote->getAllCustomNoteTypes();

        $firstCustomNoteType = CustomNoteTypeResponse::fromArray($customNoteTypes[0]);

        $this->assertNotNull($customNoteTypes);
        $this->assertTrue(sizeof($customNoteTypes)>0);
        $this->assertContainsOnlyInstancesOf(CustomNoteTypeResponse::class, [$firstCustomNoteType]);
    }

    public function testCreateCustomNoteType()
    {
        $customNoteTypeKey = 'cnt'.date('yMdHi');

        $noteParameters = [
            'type'   => $customNoteTypeKey,
            'values' => [
                'First value',
                'Second value',
                'Third value',
            ],
        ];

        $addressNote = new AddressNote();

        $response = $addressNote->createCustomNoteType($noteParameters);

        $this->assertNotNull($response);
        $this->assertNotNull($response['result']);
        $this->assertEquals('OK', $response['result']);
        $this->assertNotNull($response['affected']);
        $this->assertEquals(1, $response['affected']);

        self::$createdCustomNotes[] = $customNoteTypeKey;
    }

    public function testAddCustomNoteToRoute()
    {
        $addressNote = new AddressNote();

        $customNoteType = $addressNote->getCustomNoteTypeByKey(self::$createdCustomNotes[0]);

        $noteParameters = [
            'route_id'          => self::$route_id,
            'address_id'        => self::$address_id,
            'format'            => 'json',
            'dev_lat'           => 33.132675170898,
            'dev_lng'           => -83.244743347168,
            'custom_note_type['.$customNoteType["note_custom_type_id"].']' => 'Pickup package',
            'strUpdateType'     => 'dropoff',
            'strNoteContents'   => 'php test 1111',
        ];

        $response = AddressNoteResponse::fromArray(
            $addressNote->addCustomNoteToRoute($noteParameters)
        );

        $this->assertNotNull($response);
        $this->assertContainsOnlyInstancesOf(AddressNoteResponse::class, [$response]);

        $note = AddressNote::fromArray($response->note);
        $this->assertNotNull($note);
        $this->assertNotNull($note->custom_types);
        $this->assertTrue(sizeof($note->custom_types)>0);

        $customNote = CustomNoteType::fromArray($note->custom_types[0]);

        $this->assertContainsOnlyInstancesOf(CustomNoteType::class, [$customNote]);
        $this->assertEquals('Pickup package',$customNote->note_custom_value);
    }

    public function testRemoveCustomNoteType()
    {
        $addressNote = new AddressNote();

        $customNoteType = $addressNote->getCustomNoteTypeByKey(self::$createdCustomNotes[0]);

        $customNoteTypeParameters = [
            'id' => $customNoteType["note_custom_type_id"],
        ];

        $response = $addressNote->removeCustomNoteType($customNoteTypeParameters);

        $this->assertNotNull($response);
        $this->assertNotNull($response['result']);
        $this->assertEquals('OK', $response['result']);
        $this->assertNotNull($response['affected']);
        $this->assertEquals(1, $response['affected']);

        array_shift(self::$createdCustomNotes);
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

        $result = self:: $problem->removeOptimization($params);

        if ($result!=null && $result['status']==true) {
            echo "The test optimization was removed <br>";
        } else {
            echo "Cannot remove the test optimization <br>";
        }

        $addressNote = new AddressNote();

        foreach (self::$createdCustomNotes as $createdCustomNote) {
            $customNoteId = $addressNote->getCustomNoteTypeByKey($createdCustomNote)["note_custom_type_id"];

            $customNoteTypeParameters = [
                'id' => $customNoteId,
            ];

            $response = $addressNote->removeCustomNoteType($customNoteTypeParameters);

            if ($response!=null && $response['result']!=null && $response['result']=='OK') {
                echo "Removed the custom note type ".$createdCustomNote.'<br>';
            }
        }

    }
}