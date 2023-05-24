<?php

namespace UnitTestFiles\Test;

use Route4Me\Constants;
use Route4Me\Exception\ApiError;
use Route4Me\Route4Me;
use Route4Me\V5\AddressBook\Address;
use Route4Me\V5\AddressBook\AssignedTo;
use Route4Me\V5\AddressBook\Cluster;
use Route4Me\V5\AddressBook\ResponseAddress;
use Route4Me\V5\AddressBook\ResponseAll;
use Route4Me\V5\AddressBook\ResponseCluster;
use Route4Me\V5\AddressBook\ResponseClustering;
use Route4Me\V5\AddressBook\ResponsePagination;
use Route4Me\V5\AddressBook\ScheduleItem;
use Route4Me\V5\AddressBook\StatusChecker;
use Route4Me\V5\AddressBook\UpdateAddress;
use Route4Me\V5\AddressBook\AddressBook;

final class AddressBookUnitTests extends \PHPUnit\Framework\TestCase
{
    public static $createdAdddressIds = [];

    public static function setUpBeforeClass() : void
    {
        Route4Me::setApiKey(Constants::API_KEY);
    }

    public function testAddressCanBeCreateFromArray() : void
    {
        $this->assertInstanceOf(Address::class, new Address([
            'address_1' => '17205 RICHMOND TNPK, MILFORD, VA, 22514',
            'cached_lat' => 38.024654,
            'cached_lng' => 77.338814,
            'address_stop_type' => 'DELIVERY'
        ]));
    }

    public function testAddressCanBeCreateFromParams() : void
    {
        $this->assertInstanceOf(Address::class, new Address(
            '17205 RICHMOND TNPK, MILFORD, VA, 22514',
            38.024654,
            77.338814,
            'DELIVERY'
        ));
    }

    public function testAssignedToCanBeCreateEmpty() : void
    {
        $this->assertInstanceOf(AssignedTo::class, new AssignedTo());
    }

    public function testAssignedToCanBeCreateFromArray() : void
    {
        $this->assertInstanceOf(AssignedTo::class, new AssignedTo([
            'member_id' => '1',
            'member_first_name' => 'John Doe'
        ]));
    }

    public function testClusterCanBeCreateEmpty() : void
    {
        $this->assertInstanceOf(Cluster::class, new Cluster());
    }

    public function testClusterCanBeCreateFromArray() : void
    {
        $this->assertInstanceOf(Cluster::class, new Cluster([
            'geohash' => '1gmlagrpoarepker',
            'lat' => 34.3456
        ]));
    }

    public function testResponseAddressCanBeCreateEmpty() : void
    {
        $this->assertInstanceOf(ResponseAddress::class, new ResponseAddress());
    }

    public function testResponseAddressCanBeCreateFromArray() : void
    {
        $this->assertInstanceOf(ResponseAddress::class, new ResponseAddress([
            'created_timestamp' => 15,
            'address_id' => 1234567,
            'schedule' => [
                'enable' => true,
                'mode' => 'monthly'
            ],
            'assigned_to' => [
                'member_id' => 123453,
                'member_first_name' => 'Jane Doe'
            ]
        ]));
    }

    public function testResponseAddressCanBeCreateFromArrayAndObjects() : void
    {
        $this->assertInstanceOf(ResponseAddress::class, new ResponseAddress([
            'created_timestamp' => 15,
            'address_id' => 1234567,
            'schedule' => new ScheduleItem(),
            'assigned_to' => new AssignedTo()
        ]));
    }

    public function testResponseAllCanBeCreateEmpty() : void
    {
        $this->assertInstanceOf(ResponseAll::class, new ResponseAll());
    }

    public function testResponseAllCanBeCreateFromArray() : void
    {
        $this->assertInstanceOf(ResponseAll::class, new ResponseAll([
            'results' => [[
                'created_timestamp' => 1,
                'address_id' => 11
            ], [
                'created_timestamp' => 2,
                'address_id' => 22
            ]],
            'total' => 0
        ]));
    }

    public function testResponseAllCanBeCreateFromArrayAndResponseAddresses() : void
    {
        $this->assertInstanceOf(ResponseAll::class, new ResponseAll([
            'results' => [
                new ResponseAddress(),
                new ResponseAddress(),
            ],
            'total' => 0
        ]));
    }

    public function testResponseClusterCanBeCreateEmpty() : void
    {
        $this->assertInstanceOf(ResponseCluster::class, new ResponseCluster());
    }

    public function testResponseClusterCanBeCreateFromArrays() : void
    {
        $this->assertInstanceOf(ResponseCluster::class, new ResponseCluster([
            'cluster' => [
                'geohash' => 'tipageohash',
                'lat' => 123.5657
            ],
            'address_count' => 1
        ]));
    }

    public function testResponseClusterCanBeCreateFromArrayAndCluster() : void
    {
        $this->assertInstanceOf(ResponseCluster::class, new ResponseCluster([
            'cluster' => new Cluster(),
            'address_count' => 1
        ]));
    }

    public function testResponseClusteringCanBeCreateEmpty() : void
    {
        $this->assertInstanceOf(ResponseClustering::class, new ResponseClustering());
    }

    public function testResponseClusteringCanBeCreateFromArrays() : void
    {
        $this->assertInstanceOf(ResponseClustering::class, new ResponseClustering([
            'clusters' => [[
                'geohash' => 'tipageohash',
                'lat' => 123.5657
            ], [
                'geohash' => 'tipageohashtoo',
                'lat' => 23.56578
            ]],
            'total' => 2
        ]));
    }

    public function testResponseClusteringCanBeCreateFromArrayAndClusters() : void
    {
        $this->assertInstanceOf(ResponseClustering::class, new ResponseClustering([
            'clusters' => [
                new Cluster(),
                new Cluster()
            ],
            'total' => 2
        ]));
    }

    public function testResponsePaginationCanBeCreateEmpty() : void
    {
        $this->assertInstanceOf(ResponsePagination::class, new ResponsePagination());
    }

    public function testResponsePaginationCanBeCreateFromArray() : void
    {
        $this->assertInstanceOf(ResponsePagination::class, new ResponsePagination([
            'current_page' => 1,
            'last_page' => 2
        ]));
    }

    public function testScheduleItemCanBeCreateEmpty() : void
    {
        $this->assertInstanceOf(ScheduleItem::class, new ScheduleItem());
    }

    public function testScheduleItemCanBeCreateFromArray() : void
    {
        $this->assertInstanceOf(ScheduleItem::class, new ScheduleItem([
            'enable' => true,
            'mode' => 'monthly'
        ]));
    }

    public function testStatusCheckerCanBeCreateEmpty() : void
    {
        $this->assertInstanceOf(StatusChecker::class, new StatusChecker());
    }

    public function testStatusCheckerCanBeCreateFromArray() : void
    {
        $this->assertInstanceOf(StatusChecker::class, new StatusChecker([
            'code' => 200,
            'data' => []
        ]));
    }

    public function testUpdateAddressCanBeCreateFromParam() : void
    {
        $this->assertInstanceOf(UpdateAddress::class, new UpdateAddress(15));
    }

    public function testAddressBookCanBeCreateEmpty() : void
    {
        $this->assertInstanceOf(AddressBook::class, new AddressBook());
    }

    public function testAddAddressGetArrayMustReturnResponseAddress() : void
    {
        $addr_book = new AddressBook();
        $res_addr = $addr_book->addAddress([
            'address_1' => '17205 RICHMOND TNPK, MILFORD, VA, 22514',
            'cached_lat' => 38.024654,
            'cached_lng' => 77.338814,
            'address_stop_type' => 'DELIVERY',
            'address_city' => 'Tbilisi Vah',
            'first_name' => 'Tusha I',
            'last_name' => 'Grigoriani'
        ]);

        $this->assertInstanceOf(ResponseAddress::class, $res_addr);
        $this->assertNotNull($res_addr->address_id);
        $this->assertEquals($res_addr->first_name, 'Tusha I');

        self::$createdAdddressIds[] = $res_addr->address_id;
    }

    public function testAddAddressGetAddressMustReturnResponseAddress() : void
    {
        $addr_book = new AddressBook();
        $addr = new Address('17205 Tbilisi Vah, GEORGIAN, GE, 22514', 38.024654, 77.338814, 'DELIVERY');
        $addr->first_name = 'Tusha I';
        $res_addr = $addr_book->addAddress($addr);

        $this->assertInstanceOf(Address::class, $addr);
        $this->assertEquals($addr->first_name, 'Tusha I');
        $this->assertInstanceOf(ResponseAddress::class, $res_addr);
        $this->assertNotNull($res_addr->address_id);
        $this->assertEquals($res_addr->first_name, 'Tusha I');

        self::$createdAdddressIds[] = $res_addr->address_id;
    }

    public function testAddMultipleAddressGetArrayMustReturnBool() : void
    {
        $addr_book = new AddressBook();
        $res = $addr_book->addMultipleAddresses([[
            'address_1' => '17205 RICHMOND TNPK, MILFORD, VA, 22514',
            'cached_lat' => 38.024654,
            'cached_lng' => 77.338814,
            'address_stop_type' => 'DELIVERY',
            'address_city' => 'Tbilisi Vah',
            'first_name' => 'Tusha I',
            'last_name' => 'Grigoriani'
        ], [
            'address_1' => '17205 RICHMOND TNPK, MILFORD, VA, 22514',
            'cached_lat' => 38.024654,
            'cached_lng' => 77.338814,
            'address_stop_type' => 'DELIVERY',
            'address_city' => 'Tbilisi Vah',
            'first_name' => 'Tusha II',
            'last_name' => 'Grigoriani'
        ]]);

        $this->assertIsBool($res);
        $this->assertTrue($res);
    }

    public function testAddMultipleAddressGetAddressesMustReturnBool() : void
    {
        $addr_book = new AddressBook();
        $addresses = [
            new Address('17205 Tbilisi Vah, GEORGIAN, GE, 22514', 38.024654, 77.338814, 'DELIVERY'),
            new Address('17205 Tbilisi Vah, GEORGIAN, GE, 22514', 38.024654, 77.338814, 'DELIVERY')
        ];
        $addresses[0]->first_name = 'Tusha I';
        $addresses[1]->first_name = 'Tusha II';
        $res = $addr_book->addMultipleAddresses($addresses);

        $this->assertIsBool($res);
        $this->assertTrue($res);
    }

    public function testGetAddressesMustReturnResponseAll() : void
    {
        $options = [
            'fields' => "address_id, address_1, first_name, last_name, address_city",
            'query' => 'Tusha',
            'limit' => 5,
            'offset' => 0
        ];
        $addr_book = new AddressBook();
        $result = $addr_book->getAddresses($options);

        $this->assertInstanceOf(ResponseAll::class, $result);
        $this->assertNotNull($result->fields);
        $this->assertIsArray($result->results);
        $this->assertInstanceOf(ResponseAddress::class, $result->results[0]);
    }

    public function testGetAddressesByBodyPayloadMustReturnResponseAll() : void
    {
        $options = [
            'filter' => [
                'query' => 'Tusha',
                'selected_areas' => [[
                    'type' => 'circle',
                    'value' => [
                        'center' => [
                            'lat' => 38.024654,
                            'lng' => 77.338814
                            ],
                        'distance' => 10000
                    ]
                ]]
            ],
            'limit' => 5,
            'offset' => 0
        ];
        $addr_book = new AddressBook();
        $result = $addr_book->getAddressesByBodyPayload($options);

        $this->assertInstanceOf(ResponseAll::class, $result);
        $this->assertIsArray($result->results);
        $this->assertInstanceOf(ResponseAddress::class, $result->results[0]);
    }

    public function testGetAddressesPaginatedMustReturnResponsePaginated() : void
    {
        $options = [
            'fields' => "address_id, address_1, first_name, last_name, address_city",
            'query' => 'Tusha',
            'per_page' => 5,
            'page' => 0
        ];
        $addr_book = new AddressBook();
        $result = $addr_book->getAddressesPaginated($options);

        $this->assertInstanceOf(ResponsePagination::class, $result);
        $this->assertNotNull($result->fields);
        $this->assertNotNull($result->current_page);
        $this->assertIsArray($result->results);
        $this->assertInstanceOf(ResponseAddress::class, $result->results[0]);
    }

    public function testGetAddressesPaginatedByBodyPayloadMustReturnResponsePaginated() : void
    {
        $options = [
            'filter' => [
                'query' => 'Tusha',
                'selected_areas' => [[
                    'type' => 'circle',
                    'value' => [
                        'center' => [
                            'lat' => 52.4025,
                            'lng' => 4.5601
                        ],
                        'distance' => 10000
                    ]
                ]]
            ],
            'page' => 2,
            'per_page' => 10
        ];
            $addr_book = new AddressBook();
        $result = $addr_book->getAddressesPaginatedByBodyPayload($options);

        $this->assertInstanceOf(ResponsePagination::class, $result);
        $this->assertNotNull($result->current_page);
        $this->assertIsArray($result->results);
        $this->assertInstanceOf(ResponseAddress::class, $result->results[0]);
    }

    public function testGetAddressClustersMustReturnResponseClustering() : void
    {
        $options = [
            'display' => 'unrouted',
            'query' => 'Tusha'
        ];
        $addr_book = new AddressBook();
        $result = $addr_book->getAddressClusters($options);

        $this->assertInstanceOf(ResponseClustering::class, $result);
        $this->assertIsArray($result->clusters);
        $this->assertInstanceOf(Cluster::class, $result->clusters[0]);
    }

    public function testGetAddressClustersByBodyPayloadMustReturnResponseClustering() : void
    {
        $options = [
            'clustering' => [
                'precision' => 2
            ],
            'filter' => [
                'query' => 'Tusha',
                'selected_areas' => [[
                    'type' => 'circle',
                    'value' => [
                        'center' => [
                            'lat' => 52.4025,
                            'lng' => 4.5601
                        ],
                        'distance' => 10000
                    ]
                ]]
            ]
        ];
        $addr_book = new AddressBook();
        $result = $addr_book->getAddressClustersByBodyPayload($options);

        $this->assertInstanceOf(ResponseClustering::class, $result);
        $this->assertIsArray($result->clusters);
    }

    public function testGetAddressByIdMustReturnResponseAddress() : void
    {
        $addr_book = new AddressBook();
        $result = $addr_book->getAddressById(self::$createdAdddressIds[0]);

        $this->assertInstanceOf(ResponseAddress::class, $result);
        $this->assertIsInt($result->address_id);
    }

    public function testGetAddressesByIdsMustReturnResponseAddress() : void
    {
        $addr_book = new AddressBook();
        $result = $addr_book->getAddressesByIds(self::$createdAdddressIds);

        $this->assertInstanceOf(ResponseAll::class, $result);
        $this->assertIsArray($result->results);
        $this->assertInstanceOf(ResponseAddress::class, $result->results[0]);
        $this->assertIsInt($result->results[0]->address_id);
    }

    public function testUpdateAddressByIdMustReturnResponseAddress() : void
    {
        $addr_book = new AddressBook();
        $result = $addr_book->updateAddressById(self::$createdAdddressIds[0], ['last_name' => 'Grigoriani III']);

        $this->assertInstanceOf(ResponseAddress::class, $result);
        $this->assertEqualsCanonicalizing($result->last_name, 'Grigoriani III');
    }

    public function testUpdateAddressesByIdsMustReturnArray() : void
    {
        $addr_book = new AddressBook();
        $result = $addr_book->updateAddressesByIds(self::$createdAdddressIds, ['last_name' => 'Grigoriani IV']);

        $this->assertIsArray($result);
        $this->assertInstanceOf(ResponseAddress::class, $result[0]);
        $this->assertEqualsCanonicalizing($result[0]->last_name, 'Grigoriani IV');
    }

    // TODO: request has uncheckable result - 403 forbidden
    public function testUpdateAddressesByAreasMustReturnStatusChecker() : void
    {
        $addr_book = new AddressBook();
        $filter = [
            'query' => "Tusha",
            'bounding_box' => null,
            'selected_areas' => [[
                'type' => 'circle',
                'value' => [
                    'center' => [
                        'lat' => 38.024654,
                        'lng' => 77.338814
                    ],
                    'distance' => 10000
                ]
            ]]
        ];
    
        $params = [
            'last_name' => 'Grigoriani V'
        ];
        try {
            $result = $addr_book->updateAddressesByAreas($filter, $params);

            $this->assertInstanceOf(StatusChecker::class, $result);
        } catch (ApiError $err) {
            $this->assertEquals($err->getCode(), 403);
        }
    }

    public function testDeleteAddressesByIdsMustReturnStatusChecker() : void
    {
        $addr_book = new AddressBook();
        $result = $addr_book->deleteAddressesByIds(self::$createdAdddressIds);

        $this->assertInstanceOf(StatusChecker::class, $result);
        $this->assertIsInt($result->code);
    }

    // TODO: request has uncheckable result - 403 forbidden
    public function testDeleteAddressesByAreasMustReturnStatusChecker() : void
    {
        $addr_book = new AddressBook();
        $filter = [
            'query' => 'Tusha',
            'selected_areas' => [[
                'type' => 'circle',
                'value' => [
                    'center' => [
                        'lat' => 38.024654,
                        'lng' => 77.338814
                    ],
                    'distance' => 10000
                ]
            ]]
        ];
        try {
            $result = $addr_book->deleteAddressesByAreas($filter);

            $this->assertInstanceOf(StatusChecker::class, $result);
            $this->assertIsInt($result->code);
        } catch (ApiError $err) {
            $this->assertEquals($err->getCode(), 403);
        }
    }

    public function testGetAddressCustomFieldsMustReturnArray() : void
    {
        $addr_book = new AddressBook();
        $result = $addr_book->getAddressCustomFields();

        $this->assertIsArray($result);
    }

    public function testGetAddressDepotsFieldsMustReturnArray() : void
    {
        $addr_book = new AddressBook();
        $result = $addr_book->getAddressesDepots();

        $this->assertIsArray($result);
    }

    public function testExportAddressesByIdsMustReturnStatusChecker() : void
    {
        $addr_book = new AddressBook();
        $filename = 'test_export.csv';
        $result = $addr_book->exportAddressesByIds(self::$createdAdddressIds, $filename);

        $this->assertInstanceOf(StatusChecker::class, $result);
        $this->assertIsInt($result->code);
    }

    // TODO: request has uncheckable result - 403 forbidden
    public function testExportAddressesByAreasMustReturnStatusChecker() : void
    {
        $addr_book = new AddressBook();
        $filter = [
            'query' => "Tusha",
            'bounding_box' => null,
            'selected_areas' => [[
                'type' => 'circle',
                'value' => [
                    'center' => [
                        'lat' => 38.024654,
                        'lng' => 77.338814
                    ],
                    'distance' => 10000
                ]
            ]],
            'filename' => 'test_export.csv'
        ];
        try {
            $result = $addr_book->exportAddressesByAreas($filter);

            $this->assertInstanceOf(StatusChecker::class, $result);
            $this->assertIsInt($result->code);
        } catch (ApiError $err) {
            $this->assertEquals($err->getCode(), 403);
        }
    }

    // TODO: request has uncheckable result - 403 forbidden
    public function testExportAddressesByAreaIdsMustReturnStatusChecker() : void
    {
        $addr_book = new AddressBook();
        $territoryIds = [96100573, 96100961];
        $filename = 'test_export.csv';
        try {
            $result = $addr_book->exportAddressesByAreaIds($territoryIds, $filename);

            $this->assertInstanceOf(StatusChecker::class, $result);
            $this->assertIsInt($result->code);
        } catch (ApiError $err) {
            $this->assertEquals($err->getCode(), 403);
        }
    }

    public function testGetAddressesAsynchronousJobStatusMustReturnStatusChecker() : void
    {
        $addr_book = new AddressBook();
        $jobId = 96100961;
        try {
            $result = $addr_book->getAddressesAsynchronousJobStatus($jobId);

            $this->assertInstanceOf(StatusChecker::class, $result);
            $this->assertIsInt($result->code);
        } catch (ApiError $err) {
            $this->assertEquals($err->getCode(), 404);
        }
    }

    public function testGetAddressesAsynchronousJobResultMustReturnBool() : void
    {
        $addr_book = new AddressBook();
        $jobId = 96100961;
        try {
            $result = $addr_book->getAddressesAsynchronousJobResult($jobId);

            $this->assertIsBool($result);
        } catch (ApiError $err) {
            $this->assertEquals($err->getCode(), 404);
        }
    }

    public static function tearDownAfterClass() : void
    {
        sleep(5);

        $addr_book = new AddressBook();

        if (count(self::$createdAdddressIds)) {
            $addr_book->deleteAddressesByIds(self::$createdAdddressIds);
        }

        $res = $addr_book->getAddresses(['query' => 'Tusha']);
        if ($res) {
            $ids = [];
            foreach ($res->results as $key => $value) {
                $ids[] = $value->address_id;
            }

            if (count($ids)) {
                $addr_book->deleteAddressesByIds($ids);
            }
        }
    }
}
