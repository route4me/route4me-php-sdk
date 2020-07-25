<?php
namespace UnitTestFiles\Test;

use Route4Me\Address;
use Route4Me\AddressNote;
use Route4Me\AddressNoteResponse;
use Route4Me\Constants;
use Route4Me\CustomNoteType;
use Route4Me\CustomNoteTypeResponse;
use Route4Me\Enum\DeviceType;
use Route4Me\Enum\TerritoryTypes;
use Route4Me\Exception\BadParam;
use Route4Me\OptimizationProblem;
use Route4Me\OptimizationProblemParams;
use Route4Me\Route;
use Route4Me\Route4Me;
use Route4Me\RouteParameters;

class AddressUnitTests extends \PHPUnit\Framework\TestCase {
    protected $address;
    public static $createdAddresses;

    public static $problem;
    public static $problemDest;

    public static $route_id = null;
    public static $address_id = null;
    public static $address_address = null;
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

        $optimizationParameters = new OptimizationProblemParams();
        $optimizationParameters->setAddresses($addresses);
        $optimizationParameters->setParameters($parameters);

        self::$problem = OptimizationProblem::optimize($optimizationParameters);
        $routes = self::$problem->getRoutes();
        self::$route_id = $routes[0]->route_id;
        self::$createdAddresses = $routes[0]->addresses;
        self::$noteAddressId = self::$createdAddresses[2]->route_destination_id;
        self::$noteFileAddressId = self::$createdAddresses[3]->route_destination_id;

        self::$problemDest = OptimizationProblem::optimize($optimizationParameters);
        $routesDest = self::$problemDest->getRoutes();
        $addressesDest = $routesDest[0]->addresses;
        self::$route_id_dest = $routesDest[0]->route_id;
        self::$afterAddressId = $addressesDest[2]->route_destination_id;

        $addresses = self::$problem->addresses;
        self::$address_id = $addresses[1]->getAddressId();
        self::$address_address = $addresses[1]->address;
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

        $addresses[1] = $addresses[1]->AddAddressNote($noteParameters);

        self::$addresIdMarkedAsVisited = $addresses[2]->getAddressId();

        $params = [
            'route_id'      =>  self::$route_id,
            'address_id'    =>  self::$addresIdMarkedAsVisited,
            'is_visited'    => 1
        ];

        $result =  $addresses[2]->markAsVisited($params);

        $address = new Address();

        self::$createdCustomNotes = [];

        $customNoteTypes = $address->getAllCustomNoteTypes();


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

            $customNoteTypeResult = $address->createCustomNoteType($customNoteTypeParameters);

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

    public function testAddressFromArray()
    {
        $address = Address::fromArray([
            'address'           => '10609 Mystic Pointe Dr, Fredericksburg, VA 22407',
            'lat'               => 38.2513427734,
            'lng'               => -77.5993652344,
            'time'              => 300,
            'time_window_end'   => 75600,
            'time_window_start' => 28800,
        ]);

        $this->assertEquals($address->address, '10609 Mystic Pointe Dr, Fredericksburg, VA 22407');
        $this->assertEquals($address->lat, 38.2513427734);
        $this->assertEquals($address->lng, -77.5993652344);
        $this->assertEquals($address->time, 300);
        $this->assertEquals($address->time_window_start, 28800);
        $this->assertEquals($address->time_window_end, 75600);
    }

    public function testToArray()
    {
        $address = Address::fromArray([
            'address'           => '10609 Mystic Pointe Dr, Fredericksburg, VA 22407',
            'lat'               => 38.2513427734,
            'lng'               => -77.5993652344,
            'time'              => 300,
            'time_window_end'   => 75600,
            'time_window_start' => 28800,
            'custom_fields'     => [
                'cf_1' => 1,
            ],
        ]);

        $this->assertEquals($address->toArray(), [
            'address'           => '10609 Mystic Pointe Dr, Fredericksburg, VA 22407',
            'lat'               => 38.2513427734,
            'lng'               => -77.5993652344,
            'is_depot'          => false,
            'time'              => 300,
            'time_window_end'   => 75600,
            'time_window_start' => 28800,
            'custom_fields'     => [
                'cf_1' => 1,
            ],
        ]);
    }

    public function testBadParameter()
    {
        $this->expectException(BadParam::class);

        $address = Address::fromArray([
            'lat1' => 38.2513427734,
            'lng1' => -77.5993652344,
        ]);

        echo "address:$address <br>";
    }

    public function testAddressFromArrayWithBadKeys()
    {
        $this->expectException(BadParam::class);

        $address = Address::fromArray([
            'address'       => '10609 Mystic Pointe Dr, Fredericksburg, VA 22407',
            'lat'           => 38.2513427734,
            'lng'           => -77.5993652344,
            'demoaddress'   => '333333',
        ]);

        $this->assertNotNull($address->address);
        $this->assertEquals($address->address, '10609 Mystic Pointe Dr, Fredericksburg, VA 22407');
        $this->assertEquals($address->lat, 38.2513427734);
        $this->assertEquals($address->lng, -77.5993652344);

        $this->assertFalse(property_exists($address, 'demoaddress'));
    }

    public function testGetAddress()
    {
        $address = Address::getAddress(self::$route_id, self::$address_id);

        $this->assertNotNull($address);
        $this->assertNotNull($address->address);
        $this->assertEquals($address->address, self::$address_address);
        $this->assertEquals($address->lat, self::$address_lat);
        $this->assertEquals($address->lng, self::$address_lng);
        $this->assertEquals($address->is_depot, self::$address_is_depot);

        return $address;
    }

    public function testGetAddressesNotes()
    {
        $noteParameters = [
            'route_id'              => self::$route_id,
            'route_destination_id'  => self::$address_id,
        ];

        $address = new Address();

        $addressWithNotes = Address::fromArray(
            $address->GetAddressesNotes($noteParameters)
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

    public function testUpdateAddress()
    {
        $address = Address::getAddress(self::$route_id, self::$address_id);
        $this->assertNotNull($address);

        $address->address = 'Updated address';
        $newAddress = $address->update();

        $this->assertEquals($newAddress->address, 'Updated address');
    }

    public function testMarkAsDeparted()
    {
        $address = new Address();

        $params = [
            'route_id'      =>  self::$route_id,
            'address_id'    =>  self::$addresIdMarkedAsVisited,
            'is_departed'   => 1
        ];

        $result = $address->markAsDeparted($params);

        $this->assertNotNull($result);
        $this->assertIsBool($result['status']);
        $this->assertTrue($result['status']);
    }

    public function testMarkAsVisited()
    {
        $address = new Address();

        $params = [
            'route_id'   =>  self::$route_id,
            'address_id' =>  self::$address_id,
            'is_visited' => 1
        ];

        $result = $address->markAsVisited($params);

        $this->assertNotNull($result);
        $this->assertIsInt($result);
        $this->assertEquals(1,$result);
    }

    public function testDeleteAddress()
    {
        $lastAddressId = self::$createdAddresses[sizeof(self::$createdAddresses)-1]->route_destination_id;

        $address = Address::getAddress(self::$route_id, $lastAddressId);
        $this->assertNotNull($address);

        $state = $address->deleteAddress();
        $this->assertTrue($state);

        array_pop(self::$createdAddresses);
    }

    public function testMoveDestinationToRoute()
    {
        $lastAddressId = self::$createdAddresses[sizeof(self::$createdAddresses)-1]->route_destination_id;

        // Move the destination to the route
        $routeParams = [
            'to_route_id'           => self::$route_id_dest,
            'route_destination_id'  => $lastAddressId,
            'after_destination_id'  => self::$afterAddressId,
        ];

        $address = new Address();
        $result = $address->moveDestinationToRoute($routeParams);

        $this->assertNotNull($result);
        $this->assertNotNull($result['success']);
        $this->assertEquals(true,$result['success']);
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

        $address = new Address();

        $response = AddressNoteResponse::fromArray(
            $address->AddAddressNote($noteParameters)
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
        $this->markTestSkipped('must be revisited.');

        $noteParameters = [
            'strFilename'   => 'notes.csv',
            'route_id'      => self::$route_id,
            'address_id'    => self::$noteFileAddressId,
            'dev_lat'       => 33.132675170898,
            'dev_lng'       => -83.244743347168,
            'device_type'   => 'web',
            'strUpdateType' => 'ANY_FILE',
        ];

        $address = new Address();

        $response = AddressNoteResponse::fromArray(
            $address->AddNoteFile($noteParameters)
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
        $this->assertEquals('ext', $firstNote->upload_extension);
    }

    public function testGetCustomNoteTypeByKey()
    {
        $address = new Address();

        $customNoteType = $address->getCustomNoteTypeByKey(self::$createdCustomNotes[0]);

        $this->assertEquals(self::$createdCustomNotes[0],$customNoteType->note_custom_type);
    }

    public function testGetAllCustomNoteTypes()
    {
        $address = new Address();

        $customNoteTypes =  $address->getAllCustomNoteTypes();

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

        $address = new Address();

        $response = $address->createCustomNoteType($noteParameters);

        $this->assertNotNull($response);
        $this->assertNotNull($response['result']);
        $this->assertEquals('OK', $response['result']);
        $this->assertNotNull($response['affected']);
        $this->assertEquals(1, $response['affected']);

        self::$createdCustomNotes[] = $customNoteTypeKey;
    }

    public function testAddCustomNoteToRoute()
    {
        $address = new Address();

        $customNoteType = $address->getCustomNoteTypeByKey(self::$createdCustomNotes[0]);

        $noteParameters = [
            'route_id'          => self::$route_id,
            'address_id'        => self::$address_id,
            'format'            => 'json',
            'dev_lat'           => 33.132675170898,
            'dev_lng'           => -83.244743347168,
            'custom_note_type['.$customNoteType->note_custom_type_id.']' => 'Pickup package',
            'strUpdateType'     => 'dropoff',
            'strNoteContents'   => 'php test 1111',
        ];

        $response = AddressNoteResponse::fromArray(
            $address->addCustomNoteToRoute($noteParameters)
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
        $address = new Address();

        $customNoteType = $address->getCustomNoteTypeByKey(self::$createdCustomNotes[0]);

        $customNoteTypeParameters = [
            'id' => $customNoteType->note_custom_type_id,
        ];

        $response = $address->removeCustomNoteType($customNoteTypeParameters);

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
        $destOptimizationProblemId = self::$problemDest->optimization_problem_id;

        $params = [
            'optimization_problem_ids' => [
                '0' => $optimizationProblemId,
                '1' => $destOptimizationProblemId
            ],
            'redirect' => 0,
        ];

        $result = OptimizationProblem::removeOptimization($params);

        if ($result!=null && $result['status']==true) {
            echo "The test optimization was removed <br>";
        } else {
            echo "Cannot remove the test optimization <br>";
        }

        $address = new Address();

        foreach (self::$createdCustomNotes as $createdCustomNote) {
            $customNoteId = $address
                ->getCustomNoteTypeByKey($createdCustomNote)
                ->note_custom_type_id;

            $customNoteTypeParameters = [
                'id' => $customNoteId,
            ];

            $response = $address->removeCustomNoteType($customNoteTypeParameters);

            if ($response!=null && $response['result']!=null && $response['result']=='OK') {
                echo "Removed the custom note type ".$createdCustomNote.'<br>';
            }
        }
    }
}
