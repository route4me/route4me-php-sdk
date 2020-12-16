<?php
namespace UnitTestFiles\Test;

use Route4Me\AvoidanceZone;
use Route4Me\Constants;
use Route4Me\Enum\TerritoryTypes;
use Route4Me\Route4Me;

class AvoidanceZoneUnitTests extends \PHPUnit\Framework\TestCase {
    protected $avoidanceZone;
    protected $createdAvoidanceZones;

    public function setUp()
    {
        $this->avoidanceZone = new AvoidanceZone();

        Route4Me::setApiKey(Constants::API_KEY);

        $createdAvoidanceZones = [];

        $rectTerritoryParams['type'] = TerritoryTypes::RECT;
        $rectTerritoryParams['data'] = [
            '43.51668853502909,-109.3798828125',
            '46.98025235521883,-101.865234375',
        ];

        $AvoidanceZoneParameters = AvoidanceZone::fromArray([
            'territory_name'    => 'Test Rectangular Avoidance Zone '.strval(rand(10000, 99999)),
            'territory_color'   => 'ff7700',
            'territory' => $rectTerritoryParams,
        ]);

        $rectAvoidanceZone = AvoidanceZone::fromArray(
            AvoidanceZone::addAvoidanceZone($AvoidanceZoneParameters)
        );

        $this->createdAvoidanceZones[] = $rectAvoidanceZone;

        $circleTerritoryParams['type'] = TerritoryTypes::CIRCLE;
        $circleTerritoryParams['data'] = [
            '37.569752822786455,-77.47833251953125',
            '5000',
        ];

        $AvoidanceZoneParameters = AvoidanceZone::fromArray([
            'territory_name'    => 'Test Rectangular Avoidance Zone '.strval(rand(10000, 99999)),
            'territory_color'   => 'ff7700',
            'territory' => $circleTerritoryParams,
        ]);

        $circleAvoidanceZone = AvoidanceZone::fromArray(
            AvoidanceZone::addAvoidanceZone($AvoidanceZoneParameters)
        );

        $this->createdAvoidanceZones[] = $circleAvoidanceZone;
    }

    public function testFromArray()
    {
        $circleTerritoryParams['type'] = TerritoryTypes::CIRCLE;
        $circleTerritoryParams['data'] = [
            '37.569752822786455,-77.47833251953125',
            '5000',
        ];

        $avoidanceZone = AvoidanceZone::fromArray([
            'territory_name'    => "Rect Territory Name",
            'territory_color'   => "ff0000",
            'territory' => $circleTerritoryParams
        ]);

        $this->assertEquals($avoidanceZone->territory_name, "Rect Territory Name");
        $this->assertEquals($avoidanceZone->territory_color, "ff0000");
        $this->assertEquals($avoidanceZone->territory['type'], TerritoryTypes::CIRCLE);
        $this->assertEquals($avoidanceZone->territory['data'], [
            '37.569752822786455,-77.47833251953125',
            '5000',
        ]);
    }

    public function testToArray()
    {
        $rectTerritoryParams['type'] = TerritoryTypes::RECT;
        $rectTerritoryParams['data'] = [
            '43.51668853502909,-109.3798828125',
            '46.98025235521883,-101.865234375',
        ];

        $avoidanceZone = AvoidanceZone::fromArray([
            'territory_name'    => "Rect Territory Name",
            'territory_color'   => "ff0000",
            'territory'         => $rectTerritoryParams
        ]);

        $this->assertEquals($avoidanceZone->toArray(),
            [
                'territory_name'    => "Rect Territory Name",
                'territory_color'   => "ff0000",
                'territory'         => $rectTerritoryParams
            ]
        );
    }

    public function testGetAvoidanceZones()
    {
        $avoidanceZones = AvoidanceZone::getAvoidanceZones([]);

        $this->assertNotNull($avoidanceZones);
        $this->assertIsArray($avoidanceZones);
        $first=AvoidanceZone::fromArray($avoidanceZones[0]);
        $this->assertContainsOnlyInstancesOf('Route4Me\AvoidanceZone', [$first]);
    }

    public function testGetAvoidanceZone()
    {
        $avoidanceZones = AvoidanceZone::getAvoidanceZones([]);

        $avoidanceZoneId = $avoidanceZones[0]['territory_id'];
        $this->assertNotNull($avoidanceZoneId);

        $avoidanceZone = AvoidanceZone::fromArray(AvoidanceZone::getAvoidanceZone($avoidanceZoneId));

        $this->assertNotNull($avoidanceZone);
        $this->assertContainsOnlyInstancesOf('Route4Me\AvoidanceZone', [$avoidanceZone]);
    }

    public function testAddAvoidanceZone()
    {
        $polyTerritoryParams['type'] = TerritoryTypes::POLY;
        $polyTerritoryParams['data'] = [
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

        $AvoidanceZoneParameters = AvoidanceZone::fromArray([
            'territory_name'    => 'Test Rectangular Avoidance Zone '.strval(rand(10000, 99999)),
            'territory_color'   => 'ff7700',
            'territory'         => $polyTerritoryParams,
        ]);

        $polyAvoidanceZone = AvoidanceZone::fromArray(
            AvoidanceZone::addAvoidanceZone($AvoidanceZoneParameters)
        );

        $this->createdAvoidanceZones[] = $polyAvoidanceZone;

        $this->assertNotNull($polyAvoidanceZone);
        $this->assertContainsOnlyInstancesOf('Route4Me\AvoidanceZone', [$polyAvoidanceZone]);
        $this->assertEquals(TerritoryTypes::POLY, $polyAvoidanceZone->territory['type']);
    }

    public function testDeleteAvoidanceZone()
    {
        $territoryId = $this->createdAvoidanceZones[sizeof($this->createdAvoidanceZones)-1]->territory_id;
        $result = $this->avoidanceZone->deleteAvoidanceZone($territoryId);
        //$result = AvoidanceZone::deleteAvoidanceZone($territoryId);

        $this->assertNotNull($result);
        $this->assertTrue($result['status']);

        $this->createdAvoidanceZones[] = array_pop($this->createdAvoidanceZones);
    }

    public function testUpdateAvoidanceZone()
    {
        $territoryId = $this->createdAvoidanceZones[0]->territory_id;

        $avoidanceZoneParameters = [
            'territory_id'      => $territoryId,
            'territory_name'    => 'Test Territory Updated',
            'territory_color'   => 'ff5500'
        ];

        $updatedRoute = AvoidanceZone::fromArray(
            $this->avoidanceZone->updateAvoidanceZone($avoidanceZoneParameters)
        );

        $this->assertNotNull($updatedRoute);
        $this->assertContainsOnlyInstancesOf('Route4Me\AvoidanceZone', [$updatedRoute]);
        $this->assertEquals('Test Territory Updated',$updatedRoute->territory_name, "The territory name not updated");
        $this->assertEquals('ff5500',$updatedRoute->territory_color, "The territory color not updated");
    }

    public function tearDown()
    {
        foreach ($this->createdAvoidanceZones as $avZone)
        {
            $territoryId = $avZone->territory_id;

            $result = $this->avoidanceZone->deleteAvoidanceZone($territoryId);

            if ($result==true) {
                echo "The test avoidance zone with territory_id=".$territoryId." removed. <br>";
            }
            else {
                echo "Cannot remove the test avoidance zone with territory_id=".$territoryId."<br>";
            }

        }
    }
}
