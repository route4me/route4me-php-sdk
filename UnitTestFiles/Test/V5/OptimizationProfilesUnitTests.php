<?php

namespace UnitTestFiles\Test;

use Route4Me\Constants;
use Route4Me\Exception\ApiError;
use Route4Me\Route4Me;
use Route4Me\V5\AddressBook\ResponsePagination;
use Route4Me\V5\OptimizationProfiles\Part;
use Route4Me\V5\OptimizationProfiles\ResponseOptimizationProfile;
use Route4Me\V5\OptimizationProfiles\ResponseOptimizationProfiles;
use Route4Me\V5\OptimizationProfiles\ResponseSaveOptimizationProfile;
use Route4Me\V5\OptimizationProfiles\ResponseSaveOptimizationProfiles;
use Route4Me\V5\OptimizationProfiles\OptimizationProfiles;

final class OptimizationProfilesTests extends \PHPUnit\Framework\TestCase
{
    public static ?string $default_profile_id = null;

    public static function setUpBeforeClass() : void
    {
        Route4Me::setApiKey(Constants::API_KEY);
    }

    public function testPartCanBeCreateEmpty() : void
    {
        $this->assertInstanceOf(Part::class, new Part());
    }

    public function testPartCanBeCreateFromArray() : void
    {
        $this->assertInstanceOf(Part::class, new Part([
            'guid' => '1',
            'Data' => '2',
            'Config' => '3'
        ]));
    }

    public function testResponseOptimizationProfilesCanBeCreateEmpty() : void
    {
        $this->assertInstanceOf(ResponseOptimizationProfiles::class, new ResponseOptimizationProfiles());
    }

    public function testResponseOptimizationProfilesCanBeCreateFromArray() : void
    {
        $this->assertInstanceOf(ResponseOptimizationProfiles::class, new ResponseOptimizationProfiles([
            'items' => [
                [
                    'optimization_profile_id' => '1',
                    'profile_name' => 'aaa',
                    'is_default' => false
                ], [
                    'optimization_profile_id' => '2',
                    'profile_name' => 'bbb',
                    'is_default' => true
                ]
            ]
        ]));
    }

    public function testResponseSaveOptimizationProfilesCanBeCreateEmpty() : void
    {
        $this->assertInstanceOf(ResponseSaveOptimizationProfiles::class, new ResponseSaveOptimizationProfiles());
    }

    public function testResponseSaveOptimizationProfilesCanBeCreateFromArray() : void
    {
        $this->assertInstanceOf(ResponseSaveOptimizationProfiles::class, new ResponseSaveOptimizationProfiles([
            'items' => [
                [
                    'guid' => '1',
                    'id' => 'aaa',
                    'parts' => [[
                        'guid' => '11',
                        'Data' => '22',
                        'Config' => '33'
                    ], [
                        'guid' => '111',
                        'Data' => '222',
                        'Config' => '333'
                    ]]
                ], [
                    'guid' => '2',
                    'id' => 'bbb',
                    'parts' => [[
                        'guid' => '111',
                        'Data' => '222',
                        'Config' => '333'
                    ]]
                ]
            ]
        ]));
    }

    public function testOptimizationProfilesCanBeCreateEmpty() : void
    {
        $this->assertInstanceOf(OptimizationProfiles::class, new OptimizationProfiles());
    }

    public function testGetAllMustReturnResponseOptimizationProfiles() : void
    {
        $op = new OptimizationProfiles();
        $profiles = $op->getAll();

        $this->assertInstanceOf(ResponseOptimizationProfiles::class, $profiles);
        $this->assertNotNull($profiles->items);
        
        foreach ($profiles->items as $key => $value) {
            if ($value->is_default) {
                self::$default_profile_id = $value->optimization_profile_id;
                break;
            }
        }
        $this->assertNotNull(self::$default_profile_id);
    }

    public function testSaveMustReturnResponseSaveOptimizationProfiles() : void
    {
        $op = new OptimizationProfiles();

        $params = [
            'items' => [[
                'guid' => 'eaa',
                'parts' => [[
                    'guid' => 'pav',
                    'data' => [ 'append_date_to_route_name' => true ]
                ]],
                'id' => self::$default_profile_id
            ]]
        ];

        $result = $op->save($params);

        $this->assertInstanceOf(ResponseSaveOptimizationProfile::class, $result);
    }

    public function testDeleteMustReturnResponseSaveOptimizationProfiles() : void
    {
        $op = new OptimizationProfiles();

        $params = [
            'items' => [[
                'id' => self::$default_profile_id
            ]]
        ];

        $result = $op->delete($params);

        $this->assertInstanceOf(ResponseSaveOptimizationProfile::class, $result);
    }
}
