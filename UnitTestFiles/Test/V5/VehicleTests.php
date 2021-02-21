<?php

namespace UnitTestFiles\Test\V5;

use Doctrine\Common\Annotations\Annotation\Enum;
use PHPUnit\Framework\TestCase as TestCase;
use Route4Me\Constants as Constants;
use Route4Me\Route4Me as Route4Me;
use Route4Me\V5\Enum\FuelConsumptionUnits;
use Route4Me\V5\Enum\FuelTypes;
use Route4Me\V5\Enum\VehicleSizeUnits;
use Route4Me\V5\Enum\VehicleWeightUnits;
use Route4Me\V5\Routes\AddonRoutesApi\Route as Route;
use Route4Me\V5\Vehicles\DataTypes\Vehicle as Vehicle;
use Route4Me\V5\Vehicles\DataTypes\VehicleOrderResponse;
use Route4Me\V5\Vehicles\DataTypes\VehicleLocationResponse as VehicleLocationResponse;
use Route4Me\V5\Vehicles\DataTypes\VehicleProfile;
use Route4Me\V5\Vehicles\DataTypes\VehicleProfilesResponse;
use Route4Me\V5\Vehicles\DataTypes\VehicleResponse;
use Route4Me\V5\Vehicles\DataTypes\VehicleTemporary;
use Route4Me\V5\Vehicles\DataTypes\VehicleTrackResponse;
use Route4Me\V5\Vehicles\QueryTypes\VehicleOrderParameters;
use Route4Me\V5\Vehicles\QueryTypes\VehicleParameters;
use Route4Me\V5\Vehicles\QueryTypes\VehicleProfileParameters;
use Route4Me\V5\Vehicles\QueryTypes\VehicleSearchParameters;

class VehicleTests extends TestCase
{
    public static $createdVehicles = [];
    public static $createdVehicleProfiles = [];

    public static function setUpBeforeClass()
    {
        Route4Me::setApiKey(Constants::API_KEY);

        $vehicle = new Vehicle();

        //region Create Test Vehicles

        $class6TruckParams = Vehicle::fromArray([
            'vehicle_alias'             => 'GMC TopKick C5500 TST 6',
            'vehicle_vin'               => 'SAJXA01A06FN08012',
            'vehicle_license_plate'     => 'CVH4561',
            'vehicle_model'             => 'TopKick C5500',
            'vehicle_model_year'        => 1995,
            'vehicle_year_acquired'     => 2008,
            'vehicle_reg_country_id'    => 223,
            'vehicle_reg_state_id'      => 12,
            'vehicle_make'              => 'GMC',
            'vehicle_type_id'           => 'pickup_truck',
            'vehicle_cost_new'          => 60000,
            'purchased_new'             => true,
            'mpg_city'                  => 8,
            'mpg_highway'               => 14,
            'fuel_type'                 => 'diesel',
            'license_start_date'        => '2021-01-01',
            'license_end_date'          => '2031-01-01',
        ]);

        $result = $vehicle->createVehicle($class6TruckParams);

        self::assertNotNull($result);
        self::assertInstanceOf(
            Vehicle::class,
            Vehicle::fromArray($result)
        );

        self::$createdVehicles[] = $result;


        $class7TruckParams = Vehicle::fromArray([
            'vehicle_alias'             => 'FORD F750 TST 7',
            'vehicle_vin'               => '1NPAX6EX2YD550743',
            'vehicle_license_plate'     => 'FFV9547',
            'vehicle_model'             => 'F-750',
            'vehicle_model_year'        => 2010,
            'vehicle_year_acquired'     => 2018,
            'vehicle_reg_country_id'    => 223,
            'vehicle_make'              => 'Ford',
            'vehicle_type_id'           => 'livestock_carrier',
            'vehicle_cost_new'          => 60000,
            'purchased_new'             => true,
            'mpg_city'                  => 7,
            'mpg_highway'               => 14,
            'fuel_consumption_city'     => 7,
            'fuel_consumption_highway'  => 14,
            'fuel_type'                 => 'diesel',
            'license_start_date'        => '2021-01-01',
            'license_end_date'          => '2031-01-01',
        ]);

        $result = $vehicle->createVehicle($class7TruckParams);

        self::assertNotNull($result);
        self::assertInstanceOf(
            Vehicle::class,
            Vehicle::fromArray($result)
        );

        self::$createdVehicles[] = $result;

        //endregion

        #region Create Test Vehicle Profiles

        $profile1 = new VehicleProfile();

        $profile1->name = "Heavy Duty - 28 Double Trailer ".date('Y-m-d H:i');
        $profile1->height_units = VehicleSizeUnits::METER;
        $profile1->width_units = VehicleSizeUnits::METER;
        $profile1->length_units = VehicleSizeUnits::METER;
        $profile1->height = 4;
        $profile1->width = 2.44;
        $profile1->length = 12.2;
        $profile1->is_predefined = false;
        $profile1->is_default = false;
        $profile1->weight_units = VehicleWeightUnits::KILOGRAM;
        $profile1->weight = 20400;
        $profile1->max_weight_per_axle = 15400;
        $profile1->fuel_type = FuelTypes::UNLEADED_91;
        $profile1->fuel_consumption_city = 6;
        $profile1->fuel_consumption_highway = 12;
        $profile1->fuel_consumption_city_unit = FuelConsumptionUnits::MILES_PER_GALLON_US;
        $profile1->fuel_consumption_highway_unit = FuelConsumptionUnits::MILES_PER_GALLON_US;

        $result1 = $profile1->createVehicleProfile($profile1->toArray());

        self::assertNotNull($result1);
        self::assertInstanceOf(
            VehicleProfile::class,
            VehicleProfile::fromArray($result1)
        );

        self::$createdVehicleProfiles[] = $result1;

        $profile2 = new VehicleProfile();

        $profile2->name = "Heavy Duty - 40 Straight Truck ".date('Y-m-d H:i');
        $profile2->height_units = VehicleSizeUnits::METER;
        $profile2->width_units = VehicleSizeUnits::METER;
        $profile2->length_units = VehicleSizeUnits::METER;
        $profile2->height = 4;
        $profile2->width = 2.44;
        $profile2->length = 14.6;
        $profile2->is_predefined = false;
        $profile2->is_default = false;
        $profile2->weight_units = VehicleWeightUnits::KILOGRAM;
        $profile2->weight = 36300;
        $profile2->max_weight_per_axle = 15400;
        $profile2->fuel_type = FuelTypes::UNLEADED_87;
        $profile2->fuel_consumption_city = 5;
        $profile2->fuel_consumption_highway = 10;
        $profile2->fuel_consumption_city_unit = FuelConsumptionUnits::MILES_PER_GALLON_US;
        $profile2->fuel_consumption_highway_unit = FuelConsumptionUnits::MILES_PER_GALLON_US;

        $result2 = $profile2->createVehicleProfile($profile2->toArray());

        self::assertNotNull($result2);
        self::assertInstanceOf(
            VehicleProfile::class,
            VehicleProfile::fromArray($result2)
        );

        self::$createdVehicleProfiles[] = $result2;

        #endregion
    }

    public function testFromArray()
    {
        $class6TruckParams = Vehicle::fromArray([
            'vehicle_alias'             => 'GMC TopKick C5500 TST 6',
            'vehicle_vin'               => 'SAJXA01A06FN08012',
            'vehicle_license_plate'     => 'CVH4561',
            'vehicle_model'             => 'TopKick C5500',
            'vehicle_model_year'        => 1995,
            'vehicle_year_acquired'     => 2008,
            'vehicle_reg_country_id'    => 223,
            'vehicle_reg_state_id'      => 12,
            'vehicle_make'              => 'GMC',
            'vehicle_type_id'           => 'pickup_truck',
            'vehicle_cost_new'          => 60000,
            'purchased_new'             => true,
            'mpg_city'                  => 8,
            'mpg_highway'               => 14,
            'fuel_type'                 => 'diesel',
            'license_start_date'        => '2021-01-01',
            'license_end_date'          => '2031-01-01',
        ]);

        $this->assertEquals($class6TruckParams->vehicle_alias , 'GMC TopKick C5500 TST 6');
        $this->assertEquals($class6TruckParams->vehicle_vin , 'SAJXA01A06FN08012');
        $this->assertEquals($class6TruckParams->vehicle_license_plate , 'CVH4561');
        $this->assertEquals($class6TruckParams->vehicle_model , 'TopKick C5500');
        $this->assertEquals($class6TruckParams->vehicle_model_year , 1995);
        $this->assertEquals($class6TruckParams->vehicle_year_acquired , 2008);
        $this->assertEquals($class6TruckParams->vehicle_reg_country_id , 223);
        $this->assertEquals($class6TruckParams->vehicle_reg_state_id , 12);
        $this->assertEquals($class6TruckParams->vehicle_make , 'GMC');
        $this->assertEquals($class6TruckParams->vehicle_type_id , 'pickup_truck');
        $this->assertEquals($class6TruckParams->vehicle_cost_new , 60000);
        $this->assertEquals($class6TruckParams->purchased_new ,true);
        $this->assertEquals($class6TruckParams->mpg_city , 8);
        $this->assertEquals($class6TruckParams->mpg_highway , 14);
        $this->assertEquals($class6TruckParams->fuel_type , 'diesel');
        $this->assertEquals($class6TruckParams->license_start_date , '2021-01-01');
        $this->assertEquals($class6TruckParams->license_end_date , '2031-01-01');


    }

    public function testGetVehiclesPaginatedList()
    {
        $vehParams = new VehicleParameters();

        $vehParams->with_pagination = true;
        $vehParams->page = 1;
        $vehParams->perPage = 10;

        $vehicle = new Vehicle();

        $result = $vehicle->getVehiclesPaginatedList($vehParams->toArray());

        $this->assertNotNull($result);
        $this->assertTrue(is_array($result));
        $this->assertTrue(sizeof($result)>0);
        $this->assertInstanceOf(Vehicle::class, Vehicle::fromArray($result));
    }

    public function testCreateVehicle()
    {
        $vehicle = new Vehicle();

        $class7TruckParams = Vehicle::fromArray([
            'vehicle_alias'             => 'FORD F750 TST 7',
            'vehicle_vin'               => '1NPAX6EX2YD550743',
            'vehicle_license_plate'     => 'FFV9547',
            'vehicle_model'             => 'F-750',
            'vehicle_model_year'        => 2010,
            'vehicle_year_acquired'     => 2018,
            'vehicle_reg_country_id'    => 223,
            'vehicle_reg_state_id'      => 12,
            'vehicle_make'              => 'Ford',
            'vehicle_type_id'           => 'livestock_carrier',
            'vehicle_cost_new'          => 70000,
            'purchased_new'             => false,
            'mpg_city'                  => 6,
            'mpg_highway'               => 12,
            'fuel_consumption_city'     => 6,
            'fuel_consumption_highway'  => 12,
            'fuel_type'                 => 'diesel',
            'license_start_date'        => '2020-03-01',
            'license_end_date'          => '2028-12-01',
        ]);

        $result = $vehicle->createVehicle($class7TruckParams);

        self::assertNotNull($result);
        self::assertInstanceOf(
            Vehicle::class,
            Vehicle::fromArray($result)
        );

        self::$createdVehicles[] = $result;
    }

    public function testCreateTemporaryVehicle()
    {
        $this->markTestSkipped('The endpoint vehicles/assign is enabled for the accounts with the specified features.');

        $vehicle = new Vehicle();

        $tempVehParams = new VehicleTemporary();

        $tempVehParams->assigned_member_id = 1;
        $tempVehParams->expires_at = '2028-12-20';
        $tempVehParams->force_assignment = true;
        $tempVehParams->vehicle_id = self::$createdVehicles[0]['vehicle_id'];
        $tempVehParams->vehicle_license_plate = self::$createdVehicles[0]['vehicle_license_plate'];

        $result = $vehicle->createTemporaryVehicle($tempVehParams->toArray());

        self::assertNotNull($result);
        self::assertInstanceOf(
            VehicleTemporary::class,
            VehicleTemporary::fromArray($result)
        );
    }

    public function testExecuteVehicleOrder()
    {
        $this->markTestSkipped('The endpoint vehicles/execute is enabled for the account with the specified features.');

        $vehicle = new Vehicle();

        $orderParams = new VehicleOrderParameters();
        $orderParams->vehicle_id = self::$createdVehicles[0]['vehicle_id'];
        $orderParams->lat = 38.247605;
        $orderParams->lng = -85.746697;

        $result = $vehicle->executeVehicleOrder($orderParams->toArray());

        self::assertNotNull($result);
        self::assertInstanceOf(
            VehicleOrderResponse::class,
            VehicleOrderResponse::fromArray($result)
        );
    }

    public function testGetLatestVehicleLocations()
    {
        $vehicle = new Vehicle();

        $vehicleIDs = array_column(self::$createdVehicles, 'vehicle_id');

        $vehParams = new VehicleParameters();
        $vehParams->ids = $vehicleIDs;

        $result = $vehicle->getVehicleLocations($vehParams);

        self::assertNotNull($result);
        self::assertInstanceOf(
            VehicleLocationResponse::class,
            VehicleLocationResponse::fromArray($result)
        );
        self::assertTrue(isset($result['data']));
        self::assertTrue(is_array($result['data']));
    }

    public function testGetVehicleById()
    {
        $vehicle = new Vehicle();

        $vehParams = new VehicleParameters();
        $vehParams->vehicle_id = self::$createdVehicles[0]['vehicle_id'];

        $result = $vehicle->getVehicleById($vehParams->toArray());

        self::assertNotNull($result);
        self::assertInstanceOf(
            Vehicle::class,
            Vehicle::fromArray($result)
        );
        self::assertEquals($vehParams->vehicle_id, $result['vehicle_id']);
    }


    public function testGetVehicleTrack()
    {
        $vehicle = new Vehicle();

        $vehParams = new VehicleParameters();
        $vehParams->vehicle_id = self::$createdVehicles[0]['vehicle_id'];

        $result = $vehicle->getVehicleTrack($vehParams->toArray());

        self::assertNotNull($result);
        self::assertInstanceOf(
            VehicleTrackResponse::class,
            VehicleTrackResponse::fromArray($result)
        );
    }

    public function testDeleteVehicle()
    {
        $vehicle = new Vehicle();

        $vehParams = new VehicleParameters();
        $vehParams->vehicle_id = self::$createdVehicles[sizeof(self::$createdVehicles) - 1]['vehicle_id'];

        $result = $vehicle->removeVehicle($vehParams->toArray());

        self::assertNotNull($result);
        self::assertInstanceOf(
            Vehicle::class,
            Vehicle::fromArray($result)
        );
        self::assertEquals($vehParams->vehicle_id, $result['vehicle_id']);

        array_pop(self::$createdVehicles);
    }

    public function testGetVehicleProfiles()
    {
        $vehicleProfile = new VehicleProfile();

        $vehProfileParams = new VehicleProfileParameters();

        $vehProfileParams->with_pagination = true;
        $vehProfileParams->page = 1;
        $vehProfileParams->perPage = 10;

        $result = $vehicleProfile->getVehicleProfiles($vehProfileParams->toArray());

        self::assertNotNull($result);
        self::assertInstanceOf(
            VehicleProfilesResponse::class,
            VehicleProfilesResponse::fromArray($result)
        );
    }

    public function testCreateVehicleProfile()
    {
        $vehicleProfile = new VehicleProfile();

        $profile = new VehicleProfile();

        $profile->name = "Heavy Duty - 48 Semitrailer ".date('Y-m-d H:i');
        $profile->height_units = VehicleSizeUnits::METER;
        $profile->width_units = VehicleSizeUnits::METER;
        $profile->length_units = VehicleSizeUnits::METER;
        $profile->height = 3.5;
        $profile->width = 2.5;
        $profile->length = 16;
        $profile->is_predefined = false;
        $profile->is_default = false;
        $profile->weight_units = VehicleWeightUnits::KILOGRAM;
        $profile->weight = 35000;
        $profile->max_weight_per_axle = 17500;
        $profile->fuel_type = FuelTypes::UNLEADED_87;
        $profile->fuel_consumption_city = 6;
        $profile->fuel_consumption_highway = 11;
        $profile->fuel_consumption_city_unit = FuelConsumptionUnits::MILES_PER_GALLON_US;
        $profile->fuel_consumption_highway_unit = FuelConsumptionUnits::MILES_PER_GALLON_US;


        $result = $vehicleProfile->createVehicleProfile($profile->toArray());

        self::assertNotNull($result);
        self::assertInstanceOf(
            VehicleProfile::class,
            VehicleProfile::fromArray($result)
        );

        self::$createdVehicleProfiles[] = $result;
    }

    public function testDeleteVehicleProfile()
    {
        $vehicleProfile = new VehicleProfile();

        $vehProfileId = self::$createdVehicleProfiles[sizeof(self::$createdVehicleProfiles)-1]['vehicle_profile_id'];

        $result = $vehicleProfile->removeVehicleProfile($vehProfileId);

        self::assertNotNull($result);
        self::assertInstanceOf(
            VehicleProfile::class,
            VehicleProfile::fromArray($result)
        );

        array_pop(self::$createdVehicleProfiles);
    }

    public function testGetVehicleProfileById()
    {
        $vehicleProfile = new VehicleProfile();

        $vehProfileId = self::$createdVehicleProfiles[sizeof(self::$createdVehicleProfiles)-1]['vehicle_profile_id'];

        $result = $vehicleProfile->getVehicleProfileById($vehProfileId);

        self::assertNotNull($result);
        self::assertInstanceOf(
            VehicleProfile::class,
            VehicleProfile::fromArray($result)
        );
        self::assertEquals($vehProfileId,$result['vehicle_profile_id']);
    }

    public function testGetVehicleByLicensePlate()
    {
        $vehicle = new Vehicle();

        $vehParams = new VehicleParameters();
        $vehParams->vehicle_license_plate = self::$createdVehicles[0]['vehicle_license_plate'];

        $result = $vehicle->getVehicleByLicensePlate($vehParams);

        self::assertNotNull($result);
        self::assertInstanceOf(
            VehicleResponse::class,
            VehicleResponse::fromArray($result)
        );
    }

    public function testSearchVehicles()
    {
        $this->markTestSkipped('This method is deprecated until resolving the response issue.');

        $vehicle = new Vehicle();

        $searchParams = new VehicleSearchParameters();

        $searchParams->vehicle_ids = array_column(self::$createdVehicles, 'vehicle_id');
        $searchParams->lat = 29.748868;
        $searchParams->lng = -95.358473;

        $result = $vehicle->searchVehicles($searchParams);

        self::assertNotNull($result);
        self::assertInstanceOf(
            Vehicle::class,
            VehicleResponse::fromArray($result[0])
        );
    }

    public function testUpdateVehicle()
    {
        $vehicle = new Vehicle();

        $vehicle->vehicle_alias = self::$createdVehicles[0]['vehicle_alias'] .' Updated';
        $vehicle->vehicle_vin = '11111111111111111';
        $vehicle->vehicle_id = self::$createdVehicles[0]['vehicle_id'];

        $result = $vehicle->updateVehicle($vehicle->toArray());

        self::assertNotNull($result);
        self::assertInstanceOf(
            Vehicle::class,
            Vehicle::fromArray($result)
        );
    }

    public function testUpdateVehicleProfile()
    {
        $vehicleProfile = new VehicleProfile();

        $vehProfileId = self::$createdVehicleProfiles[0]['vehicle_profile_id'];

        $vehicleProfile->name = self::$createdVehicleProfiles[0]['name'].'Updated';
        $vehicleProfile->fuel_consumption_city_unit = FuelConsumptionUnits::MILES_PER_GALLON_US;
        $vehicleProfile->fuel_consumption_highway_unit = FuelConsumptionUnits::MILES_PER_GALLON_US;
        $vehicleProfile->vehicle_profile_id = self::$createdVehicleProfiles[0]['vehicle_profile_id'];

        $result = $vehicleProfile->updateVehicleProfile($vehicleProfile->toArray());

        self::assertNotNull($result);
        self::assertInstanceOf(
            VehicleProfile::class,
            VehicleProfile::fromArray($result)
        );
    }

    public static function tearDownAfterClass()
    {
        $vehicle = new Vehicle();

        $vehParams = new VehicleParameters();

        foreach (self::$createdVehicles as $veh1) {
            if (isset($veh1['vehicle_id'])) {
                $vehParams->vehicle_id = $veh1['vehicle_id'];
                $result1 = $vehicle->removeVehicle($vehParams->toArray());
            }
        }

        $vehProfile = new VehicleProfile();

        foreach (self::$createdVehicleProfiles as $prof1) {
            if (isset($prof1['vehicle_profile_id'])) {
                $result2 = $vehProfile->removeVehicleProfile($prof1['vehicle_profile_id']);
            }
        }
    }
}
