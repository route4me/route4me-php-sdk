<?php

namespace UnitTestFiles\Test;

use Route4Me\Constants;
use Route4Me\Enum\TerritoryTypes;
use Route4Me\Route4Me;
use Route4Me\Territory;

class TerritoryTests extends \PHPUnit\Framework\TestCase
{
    public static $createdTerritories = [];

    public static function setUpBeforeClass()
    {
        Route4Me::setApiKey(Constants::API_KEY);

        $territory = new Territory();

        $territoryParams['type'] = TerritoryTypes::CIRCLE;
        $territoryParams['data'] = [
            '37.569752822786455,-77.47833251953125',
            '5000',
        ];

        $TerritoryParameters = Territory::fromArray([
            'territory_name' => 'Test Territory '.strval(rand(10000, 99999)),
            'territory_color' => 'ff7700',
            'territory' => $territoryParams,
        ]);

        $territory = new Territory();

        $response = $territory->addTerritory($TerritoryParameters);

        self::assertNotNull($response);
        self::assertTrue(is_array($response));
        self::assertInstanceOf(Territory::class, Territory::fromArray($response));
        self::assertTrue(isset($response['territory_id']));

        self::$createdTerritories[] = $response['territory_id'];
    }

    public function testFromArray()
    {
        $terrName = 'Test Territory '.strval(rand(10000, 99999));

        $territory = Territory::fromArray([
            'territory_name'    => $terrName,
            'territory_color'   => 'ff7700',
            'territory'         => [
                'type' => TerritoryTypes::CIRCLE,
                'data' => [
                    '37.569752822786455,-77.47833251953125',
                    '5000',
                ]
            ],
        ]);

        $this->assertEquals($terrName, $territory->territory_name);
        $this->assertEquals('ff7700', $territory->territory_color);
        $this->assertEquals(
            [
                'type' => TerritoryTypes::CIRCLE,
                'data' => [
                    '37.569752822786455,-77.47833251953125',
                    '5000',
                ]
            ],
            $territory->territory);
    }

    public function testToArray()
    {
        $terrName = 'Test Territory '.strval(rand(10000, 99999));

        $territory = Territory::fromArray([
            'territory_name'    => $terrName,
            'territory_color'   => 'ff7700',
            'territory'         => [
                'type' => TerritoryTypes::CIRCLE,
                'data' => [
                    '37.569752822786455,-77.47833251953125',
                    '5000',
                ]
            ],
        ]);

        $this->assertEquals(
            $territory->toArray(),
            [
                'territory_name'    => $terrName,
                'territory_color'   => 'ff7700',
                'territory'         => [
                    'type' => TerritoryTypes::CIRCLE,
                    'data' => [
                        '37.569752822786455,-77.47833251953125',
                        '5000',
                    ]
                ],
            ]
        );
    }

    public function testGetTerritories()
    {
        $territory = new Territory();

        $queryParameters = [
            'offset' => 0,
            'limit'  => 20,
        ];

        $response = $territory->getTerritories($queryParameters);

        $this->assertNotNull($response);
        $this->assertTrue(is_array($response));
        $this->assertTrue(sizeof($response)>0);
        $this->assertInstanceOf(Territory::class, Territory::fromArray($response[0]));
    }

    public function testGetTerritory(){
        $territory = new Territory();

        $params = [
            'territory_id' => self::$createdTerritories[0],
        ];

        $response = $territory->getTerritory($params);

        $this->assertNotNull($response);
        $this->assertTrue(is_array($response));
        $this->assertInstanceOf(Territory::class, Territory::fromArray($response));
        $this->assertTrue(isset($response['territory_id']));
        $this->assertEquals(self::$createdTerritories[0],$response['territory_id']);
    }

    public function testCreateCircleTerritory()
    {
        $territoryParams['type'] = TerritoryTypes::CIRCLE;
        $territoryParams['data'] = [
            '37.569752822786455,-77.47833251953125',
            '5100',
        ];

        $TerritoryParameters = Territory::fromArray([
            'territory_name'    => 'Test Circle Territory '.strval(rand(10000, 99999)),
            'territory_color'   => 'ff7700',
            'territory' => $territoryParams,
        ]);

        $territory = new Territory();

        $response = $territory->addTerritory($TerritoryParameters);

        $this->assertNotNull($response);
        $this->assertTrue(is_array($response));
        $this->assertInstanceOf(Territory::class, Territory::fromArray($response));
        $this->assertTrue(isset($response['territory']));
        $this->assertTrue(isset($response['territory']['type']));

        $this->assertEquals(
            TerritoryTypes::CIRCLE,
            $response['territory']['type']
        );

        self::$createdTerritories[] = $response['territory_id'];
    }

    public function testCreateRectangularTerritory()
    {
        $territoryParams['type'] = TerritoryTypes::RECT;
        $territoryParams['data'] = [
            '43.51668853502909,-109.3798828125',
            '46.98025235521883,-101.865234375',
        ];

        $TerritoryParameters = Territory::fromArray([
            'territory_name'    => 'Test Rectangular Territory '.strval(rand(10000, 99999)),
            'territory_color'   => 'ff7705',
            'territory' => $territoryParams,
        ]);

        $territory = new Territory();

        $response = $territory->addTerritory($TerritoryParameters);

        $this->assertNotNull($response);
        $this->assertTrue(is_array($response));
        $this->assertInstanceOf(Territory::class, Territory::fromArray($response));
        $this->assertTrue(isset($response['territory']));
        $this->assertTrue(isset($response['territory']['type']));

        $this->assertEquals(
            TerritoryTypes::RECT,
            $response['territory']['type']
        );

        self::$createdTerritories[] = $response['territory_id'];
    }

    public function testCreatePolygonTerritory()
    {
        $territoryParams['type'] = TerritoryTypes::POLY;
        $territoryParams['data'] = [
            '37.769752822786455,-77.67833251953125',
            '37.75886716305343,-77.68974800109863',
            '37.74763966054455,-77.6917221069336',
            '37.74655084306813,-77.68863220214844',
            '37.7502255383101,-77.68125076293945',
            '37.74797991274437,-77.67498512268066',
            '37.73327960206065,-77.6411678314209',
            '37.74430510679532,-77.63172645568848',
            '37.76641925847049,-77.66846199035645',
        ];

        $TerritoryParameters = Territory::fromArray([
            'territory_name'    => 'Test Polygon Territory '.strval(rand(10000, 99999)),
            'territory_color'   => 'ff7707',
            'territory' => $territoryParams,
        ]);

        $territory = new Territory();

        $response = $territory->addTerritory($TerritoryParameters);

        $this->assertNotNull($response);
        $this->assertTrue(is_array($response));
        $this->assertInstanceOf(Territory::class, Territory::fromArray($response));
        $this->assertTrue(isset($response['territory']));
        $this->assertTrue(isset($response['territory']['type']));

        $this->assertEquals(
            TerritoryTypes::POLY,
            $response['territory']['type']
        );

        self::$createdTerritories[] = $response['territory_id'];
    }

    public function testUpdateTerritory()
    {
        $territory = new Territory();

        // Update territory
        $territoryParameters = [
            'type' => TerritoryTypes::RECT,
            'data' => [
                '29.6600127358956,-95.6593322753906',
                '29.8966150753098,-95.3146362304688',
            ],
        ];

        $TerritoryParameters = Territory::fromArray([
            'territory_id'      => self::$createdTerritories[0],
            'territory_name'    => 'Test Territory Updated as rectangle',
            'territory_color'   => 'ff5500',
            'territory'         => $territoryParameters,
        ]);

        $response = $territory->updateTerritory($TerritoryParameters);

        $this->assertNotNull($response);
        $this->assertTrue(is_array($response));
        $this->assertInstanceOf(Territory::class, Territory::fromArray($response));
        $this->assertTrue(isset($response['territory']));
        $this->assertTrue(isset($response['territory']['type']));

        $this->assertEquals(
            TerritoryTypes::RECT,
            $response['territory']['type']
        );

        $this->assertEquals(
            'Test Territory Updated as rectangle',
            $response['territory_name']
        );
    }

    public function testRemoveTerritory()
    {
        $territory = new Territory();

        $territoryId = self::$createdTerritories[sizeof(self::$createdTerritories)-1];

        $response = $territory->deleteTerritory($territoryId);

        $this->assertNotNull($response);
        $this->assertTrue(isset($response['status']));
        $this->assertTrue($response['status']);

        self::$createdTerritories[] = array_pop(self::$createdTerritories);
    }

    public static function tearDownAfterClass()
    {
        if (sizeof(self::$createdTerritories)<1) return;

        $territory = new Territory();

        foreach (self::$createdTerritories as $createdTerritoryId) {
            $result1 = $territory->deleteTerritory($createdTerritoryId);

            if (!is_null($result1) && isset($result1['status']) && $result1['status']) {
                echo "Removed the territory ".$createdTerritoryId." <br>";
            } else {
                echo "Cannot removed the territory ".$createdTerritoryId." <br>";
            }
        }
    }
}