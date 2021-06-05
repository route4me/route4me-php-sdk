<?php

namespace UnitTestFiles\Test;

use Route4Me\Constants;
use Route4Me\Route4Me;
use Route4Me\Vehicles\Vehicle;
use Route4Me\V5\Vehicles\DataTypes\DataVehicle;
use Route4Me\Vehicles\VehicleCreateResponseV4;
use Route4Me\Vehicles\VehiclesResponseV4;
use Route4Me\Vehicles\VehicleV4;

class VehicleTests extends \PHPUnit\Framework\TestCase
{
    public static $createdVehicles=[];

    public static function setUpBeforeClass()
    {
        Route4Me::setApiKey(Constants::API_KEY);

        $vehicle = new VehicleV4();

        $vehicleParameters = Vehicle::fromArray([
            'vehicle_name'              => 'Ford Transit Test 5',
            'vehicle_alias'             => 'Ford Transit Test 5',
            'vehicle_vin'               => 'JS3TD62V1Y4107898',
            'vehicle_reg_country_id'    => '223',
            'vehicle_make'              => 'Ford',
            'vehicle_model_year'        => 2013,
            'vehicle_axle_count'        => 2,
            'mpg_city'                  => 8,
            'mpg_highway'               => 14,
            'fuel_type'                 => 'unleaded 93',
            'height_inches'             => 72,
            'weight_lb'                 => 2000,
        ]);

        $result = $vehicle->createVehicle($vehicleParameters);

        self::assertNotNull($result);
        self::assertInstanceOf(
            VehicleV4::class,
            VehicleV4::fromArray($result)
        );

        self::$createdVehicles[] = $result['vehicle_id'];
    }

    public function testFromArray()
    {
        $vehicleParameters = VehicleV4::fromArray([
            'vehicle_id'                        => '43B1DC9C2C4DC3A8FE080A126B12ACBD',
            'member_id'                         => 18154,
            'is_deleted'                        => false,
            'vehicle_alias'                     => 'Ford Transit Test 5',
            'vehicle_vin'                       => 'JS3TD62V1Y4107898',
            'vehicle_reg_state_id'              => null,
            'vehicle_reg_country_id'            => 223,
            'vehicle_license_plate'             => null,
            'vehicle_type_id'                   => null,
            'timestamp_added'                   => '2020-12-20T17:25:14+00:00',
            'vehicle_make'                      => 'Ford',
            'vehicle_model_year'                => 2013,
            'vehicle_model'                     => null,
            'vehicle_year_acquired'             => null,
            'vehicle_cost_new'                  => null,
            'purchased_new'                     => null,
            'license_start_date'                => '2020-12-20',
            'license_end_date'                  => '2020-12-20',
            'is_operational'                    => true,
            'fuel_type'                         => 'unleaded 93',
            'external_telematics_vehicle_id'    => null,
            'timestamp_removed'                 => null,
            'vehicle_profile_id'                => null,
            'fuel_consumption_city'             => '8',
            'fuel_consumption_highway'          => '14',
            'fuel_consumption_city_unit'        => 'mi\/l',
            'fuel_consumption_highway_unit'     => 'mi\/l',
            'mpg_city'                          => 30.28,
            'mpg_highway'                       => 53,
            'fuel_consumption_city_uf_value'    => '8 mi\/l',
            'fuel_consumption_highway_uf_value' => '14 mi\/l'
        ]);

        $this->assertEquals('43B1DC9C2C4DC3A8FE080A126B12ACBD', $vehicleParameters->vehicle_id);
        $this->assertEquals(18154, $vehicleParameters->member_id);
        $this->assertEquals(false, $vehicleParameters->is_deleted);
        $this->assertEquals('Ford Transit Test 5', $vehicleParameters->vehicle_alias);
        $this->assertEquals('JS3TD62V1Y4107898', $vehicleParameters->vehicle_vin);
        $this->assertEquals(null, $vehicleParameters->vehicle_reg_state_id);
        $this->assertEquals(223, $vehicleParameters->vehicle_reg_country_id);
        $this->assertEquals(null, $vehicleParameters->vehicle_license_plate);
        $this->assertEquals(null, $vehicleParameters->vehicle_type_id);
        $this->assertEquals('2020-12-20T17:25:14+00:00', $vehicleParameters->timestamp_added);
        $this->assertEquals('Ford', $vehicleParameters->vehicle_make);
        $this->assertEquals(2013, $vehicleParameters->vehicle_model_year);
        $this->assertEquals(null, $vehicleParameters->vehicle_model);
        $this->assertEquals(null, $vehicleParameters->vehicle_year_acquired);
        $this->assertEquals(null, $vehicleParameters->vehicle_cost_new);
        $this->assertEquals(null, $vehicleParameters->purchased_new);
        $this->assertEquals('2020-12-20', $vehicleParameters->license_start_date);
        $this->assertEquals('2020-12-20', $vehicleParameters->license_end_date);
        $this->assertEquals(true, $vehicleParameters->is_operational);
        $this->assertEquals('unleaded 93', $vehicleParameters->fuel_type);
        $this->assertEquals(null, $vehicleParameters->external_telematics_vehicle_id);
        $this->assertEquals(null, $vehicleParameters->timestamp_removed);
        $this->assertEquals(null, $vehicleParameters->vehicle_profile_id);
        $this->assertEquals('8', $vehicleParameters->fuel_consumption_city);
        $this->assertEquals('14', $vehicleParameters->fuel_consumption_highway);
        $this->assertEquals('mi\/l', $vehicleParameters->fuel_consumption_city_unit);
        $this->assertEquals('mi\/l', $vehicleParameters->fuel_consumption_highway_unit);
        $this->assertEquals(30.28, $vehicleParameters->mpg_city);
        $this->assertEquals(53, $vehicleParameters->mpg_highway);
        $this->assertEquals('8 mi\/l', $vehicleParameters->fuel_consumption_city_uf_value);
        $this->assertEquals('14 mi\/l', $vehicleParameters->fuel_consumption_highway_uf_value);
    }

    public function testToArray()
    {
        $vehicleParameters = VehicleV4::fromArray([
            'vehicle_id' => '43B1DC9C2C4DC3A8FE080A126B12ACBD',
            'member_id' => 18154,
            'is_deleted' => false,
            'vehicle_alias' => 'Ford Transit Test 5',
            'vehicle_vin' => 'JS3TD62V1Y4107898',
             'vehicle_reg_country_id' => 223,
            'timestamp_added' => '2020-12-20T17:25:14+00:00',
            'vehicle_make' => 'Ford',
            'vehicle_model_year' => 2013,
            'license_start_date' => '2020-12-20',
            'license_end_date' => '2020-12-20',
            'is_operational' => true,
            'fuel_type' => 'unleaded 93',
            'fuel_consumption_city' => '8',
            'fuel_consumption_highway' => '14',
            'fuel_consumption_city_unit' => 'mi\/l',
            'fuel_consumption_highway_unit' => 'mi\/l',
            'mpg_city' => 30.28,
            'mpg_highway' => 53,
            'fuel_consumption_city_uf_value' => '8 mi\/l',
            'fuel_consumption_highway_uf_value' => '14 mi\/l'
        ]);

        $this->assertEquals($vehicleParameters->toArray(),
            [
                'vehicle_id' => '43B1DC9C2C4DC3A8FE080A126B12ACBD',
                'member_id' => 18154,
                'is_deleted' => false,
                'vehicle_alias' => 'Ford Transit Test 5',
                'vehicle_vin' => 'JS3TD62V1Y4107898',
                'vehicle_reg_country_id' => 223,
                'timestamp_added' => '2020-12-20T17:25:14+00:00',
                'vehicle_make' => 'Ford',
                'vehicle_model_year' => 2013,
                'license_start_date' => '2020-12-20',
                'license_end_date' => '2020-12-20',
                'is_operational' => true,
                'fuel_type' => 'unleaded 93',
                'fuel_consumption_city' => '8',
                'fuel_consumption_highway' => '14',
                'fuel_consumption_city_unit' => 'mi\/l',
                'fuel_consumption_highway_unit' => 'mi\/l',
                'mpg_city' => 30.28,
                'mpg_highway' => 53,
                'fuel_consumption_city_uf_value' => '8 mi\/l',
                'fuel_consumption_highway_uf_value' => '14 mi\/l'
            ]
        );
    }

    public function testGetVehiclesList()
    {
        $vehicle = new Vehicle();

        $vehicleParameters = [
            'with_pagination' => true,
            'page' => 2,
            'perPage' => 10,
        ];

        $result = $vehicle->getVehicles($vehicleParameters);

        $this->assertNotNull($result);
        $this->assertTrue(is_array($result));
        $this->assertInstanceOf(
            DataVehicle::class,
            DataVehicle::fromArray($result)
        );


//        $this->assertTrue(isset($result['current_page']));
//        $this->assertTrue(isset($result['data']));
//        $this->assertTrue(is_array($result['data']));
    }

    public function testGetVehicle()
    {
        $vehicle = new VehicleV4();

        $randomVehicleID = self::$createdVehicles[0];

        // Get a vehicle by ID
        $result = $vehicle->getVehicleByID($randomVehicleID);

        $this->assertNotNull($result);
        $this->assertInstanceOf(
            VehicleV4::class,
            VehicleV4::fromArray($result)
        );
    }

    public function testUpdateVehicle()
    {
        $vehicle = new VehicleV4();

        $randomVehicleID = self::$createdVehicles[0];

        // Update the vehicle
        $vehicleParameters = Vehicle::fromArray([
            'vehicle_id' => $randomVehicleID,
            'vehicle_model_year' => 2013,
            'vehicle_year_acquired' => 2016,
            'vehicle_reg_country_id' => '223',
            'vehicle_make' => 'Ford',
            'fuel_type' => 'unleaded 93',
        ]);

        $result = $vehicle->updateVehicle($vehicleParameters);

        $this->assertNotNull($result);
        $this->assertInstanceOf(
            VehicleV4::class,
            VehicleV4::fromArray($result)
        );
        $this->assertEquals(2013, $result['vehicle_model_year']);
        $this->assertEquals(2016, $result['vehicle_year_acquired']);
        $this->assertEquals('223', $result['vehicle_reg_country_id']);
        $this->assertEquals('Ford', $result['vehicle_make']);
        $this->assertEquals('unleaded 93', $result['fuel_type']);
    }

    public function testCreateVehicle()
    {
        $vehicle = new VehicleV4();

        $vehicleParameters = Vehicle::fromArray([
            'vehicle_alias' => 'Ford Transit Test 5',
            'vehicle_vin' => 'JS3TD62V1Y4107898',
            'vehicle_reg_country_id' => '223',
            'vehicle_make' => 'Ford',
            'vehicle_model_year' => 2013,
            'mpg_city' => 8,
            'mpg_highway' => 14,
            'fuel_type' => 'unleaded 93',
        ]);

        $result = $vehicle->createVehicle($vehicleParameters);

        self::assertNotNull($result);
        self::assertInstanceOf(
            VehicleV4::class,
            VehicleV4::fromArray($result)
        );
        $this->assertEquals('Ford Transit Test 5', $vehicleParameters->vehicle_alias);
        $this->assertEquals('JS3TD62V1Y4107898', $vehicleParameters->vehicle_vin);

        self::$createdVehicles[] = $result['vehicle_id'];
    }

    public function testCreateHazmatTruck()
    {
        $vehicle = new VehicleV4();

        $vehicleParameters = Vehicle::fromArray([
            'vehicle_alias' => 'ISUZU FTR',
            'vehicle_vin' => '1NP5DB9X93N507873',
            'vehicle_license_plate' => 'IFT6253',
            'license_start_date' => '2008-05-14',
            'license_end_date' => '2020-09-24',
            'vehicle_model' => 'FTR',
            'vehicle_model_year' => 2008,
            'vehicle_year_acquired' => 2008,
            'vehicle_reg_country_id' => 223,
            'vehicle_type_id' => 'bigrig',
            //'has_trailer' => false,
            'mpg_city' => 5,
            'mpg_highway' => 15,
            'fuel_type' => 'diesel',
            //'height_inches' => 112,
            //'height_metric' => 280,
            //'maxWeightPerAxleGroupInPounds' => 19000,
            //'max_weight_per_axle_group_metric' => 8620,
            //'widthInInches' => 94,
            //'width_metric' => 235,
            //'lengthInInches' => 384,
            //'length_metric' => 960,
            //'Use53FootTrailerRouting' => 'NO',
            //'UseTruckRestrictions' => 'YES',
            //'DividedHighwayAvoidPreference' => 'NEUTRAL',
            //'FreewayAvoidPreference' => 'NEUTRAL',
            //'TollRoadUsage' => 'ALWAYS_AVOID',
            //'truck_config' => '26_STRAIGHT_TRUCK',
            //'InternationalBordersOpen' => 'YES',
            'purchased_new' => true,
            //'HazmatType' => 'FLAMMABLE',
        ]);

        $response = $vehicle->createVehicle($vehicleParameters);

        self::assertNotNull($response);
        self::assertInstanceOf(
            VehicleCreateResponseV4::class,
            VehicleCreateResponseV4::fromArray($response)
        );

        $result =  VehicleCreateResponseV4::fromArray($response);

        $this->assertEquals('ISUZU FTR', $result->vehicle_alias);
        $this->assertEquals('1NP5DB9X93N507873', $result->vehicle_vin);
        $this->assertEquals('IFT6253', $result->vehicle_license_plate);
        $this->assertEquals('2008-05-14', $result->license_start_date);
        $this->assertEquals('2020-09-24', $result->license_end_date);
        $this->assertEquals('FTR', $result->vehicle_model);
        $this->assertEquals(2008, $result->vehicle_model_year);
        $this->assertEquals(2008, $result->vehicle_year_acquired);
        $this->assertEquals(223, $result->vehicle_reg_country_id);
        $this->assertEquals('bigrig', $result->vehicle_type_id);
        //$this->assertEquals(false, $result->has_trailer);
        //$this->assertEquals(5, $result->mpg_city);
        //$this->assertEquals(15, $result->mpg_highway);
        $this->assertEquals('5', $result->fuel_consumption_city);
        $this->assertEquals('15', $result->fuel_consumption_highway);
        $this->assertEquals('diesel', $result->fuel_type);
        //$this->assertEquals(112, $result->height_inches);
        //$this->assertEquals(280, $result->height_metric);
        //$this->assertEquals(19000, $result->maxWeightPerAxleGroupInPounds);
        //$this->assertEquals(8620, $result->max_weight_per_axle_group_metric);
        //$this->assertEquals(94, $result->widthInInches);
        //$this->assertEquals(235, $result->width_metric);
        //$this->assertEquals(384, $result->lengthInInches);
        //$this->assertEquals(960, $result->length_metric);
        //$this->assertEquals('NO', $result->Use53FootTrailerRouting);
        //$this->assertEquals('YES', $result->UseTruckRestrictions);
        //$this->assertEquals('NEUTRAL', $result->DividedHighwayAvoidPreference);
        //$this->assertEquals('NEUTRAL', $result->FreewayAvoidPreference);
        //$this->assertEquals('ALWAYS_AVOID', $result->TollRoadUsage);
        //$this->assertEquals('26_STRAIGHT_TRUCK', $result->truck_config);
        //$this->assertEquals('YES', $result->InternationalBordersOpen);
        $this->assertEquals(true, $result->purchased_new);
        //$this->assertEquals('FLAMMABLE', $result->HazmatType);

        self::$createdVehicles[] = $result->vehicle_id;
    }

    public function testCreateHeavyTruck()
    {
        $vehicle = new VehicleV4();

        $vehicleParameters = Vehicle::fromArray([
            'vehicle_alias' => 'Peterbilt 579',
            'vehicle_vin' => '1NP5DB9X93N507873',
            'vehicle_license_plate' => 'PPV7516',
            'license_start_date' => '2017-06-05',
            'license_end_date' => '2021-08-14',
            'vehicle_model' => '579',
            'vehicle_model_year' => 2015,
            'vehicle_year_acquired' => 2018,
            'vehicle_reg_country_id' => 223,
            'vehicle_type_id' => 'tractor_trailer',
            //'has_trailer' => true,
            'mpg_city' => 6,
            'mpg_highway' => 12,
            'fuel_type' => 'diesel',
            //'height_inches' => 114,
            //'height_metric' => 290,
            //'maxWeightPerAxleGroupInPounds' => 40000,
            //'max_weight_per_axle_group_metric' => 18000,
            //'widthInInches' => 102,
            //'width_metric' => 258,
            //'lengthInInches' => 640,
            //'length_metric' => 1625,
            //'Use53FootTrailerRouting' => 'YES',
            //'UseTruckRestrictions' => 'YES',
            //'DividedHighwayAvoidPreference' => 'STRONG_AVOID',
            //'FreewayAvoidPreference' => 'STRONG_AVOID',
            //'truck_config' => '53_SEMI_TRAILER',
            //'InternationalBordersOpen' => 'YES',
            'purchased_new' => true,
        ]);

        $response = $vehicle->createVehicle($vehicleParameters);

        self::assertNotNull($response);
        self::assertInstanceOf(
            VehicleCreateResponseV4::class,
            VehicleCreateResponseV4::fromArray($response)
        );

        $result =  VehicleCreateResponseV4::fromArray($response);

        $this->assertEquals('Peterbilt 579', $result->vehicle_alias);
        $this->assertEquals('1NP5DB9X93N507873', $result->vehicle_vin);
        $this->assertEquals('PPV7516', $result->vehicle_license_plate);
        $this->assertEquals('2017-06-05', $result->license_start_date);
        $this->assertEquals('2021-08-14', $result->license_end_date);
        $this->assertEquals('579', $result->vehicle_model);
        $this->assertEquals(2015, $result->vehicle_model_year);
        $this->assertEquals(2018, $result->vehicle_year_acquired);
        $this->assertEquals(223, $result->vehicle_reg_country_id);
        $this->assertEquals('tractor_trailer', $result->vehicle_type_id);
        //$this->assertEquals(true, $result->has_trailer);
        //'$this->assertEquals(6, $result->mpg_city);
        //$this->assertEquals(12, $result->mpg_highway);
        $this->assertEquals('6', $result->fuel_consumption_city);
        $this->assertEquals('12', $result->fuel_consumption_highway);
        $this->assertEquals('diesel', $result->fuel_type);
        //$this->assertEquals(114, $result->height_inches);
        //$this->assertEquals(290, $result->height_metric);
        //$this->assertEquals(40000, $result->maxWeightPerAxleGroupInPounds);
        //$this->assertEquals(18000, $result->max_weight_per_axle_group_metric);
        //$this->assertEquals(102, $result->widthInInches);
        //$this->assertEquals(258, $result->width_metric);
        //$this->assertEquals(640, $result->lengthInInches);
        //$this->assertEquals(1625, $result->length_metric);
        //$this->assertEquals('YES', $result->Use53FootTrailerRouting);
        //$this->assertEquals('YES', $result->UseTruckRestrictions);
        //$this->assertEquals('STRONG_AVOID', $result->DividedHighwayAvoidPreference);
        //$this->assertEquals('STRONG_AVOID', $result->FreewayAvoidPreference);
        //$this->assertEquals('ALWAYS_AVOID', $result->TollRoadUsage);
        //$this->assertEquals('53_SEMI_TRAILER', $result->truck_config);
        //$this->assertEquals('YES', $result->InternationalBordersOpen);
        $this->assertEquals(true, $result->purchased_new);

        self::$createdVehicles[] = $result->vehicle_id;
    }

    public static function tearDownAfterClass()
    {
        if (!is_null(self::$createdVehicles) && sizeof(self::$createdVehicles)>0) {
            $vehicle = new VehicleV4();

            foreach (self::$createdVehicles as $createdVehicleId) {
                $vehicleParameters = VehicleV4::fromArray([
                    'vehicle_id' => $createdVehicleId,
                ]);

                $result = $vehicle->removeVehicle($vehicleParameters);

                if (!is_null($result) && (VehicleV4::fromArray($result) instanceof VehicleV4)) {
                    echo "The vehicle ".$result['vehicle_id']." removed <br>";
                } else {
                    echo "Cannot remove the vehicle ".$result['vehicle_id']." <br>";
                };

            }
        }
    }
}