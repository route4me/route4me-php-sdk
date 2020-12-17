<?php

namespace UnitTestFiles\Test;

use Route4Me\Address;
use Route4Me\Constants;
use Route4Me\Enum\AlgorithmType;
use Route4Me\Enum\DeviceType;
use Route4Me\Enum\DistanceUnit;
use Route4Me\Enum\Format;
use Route4Me\Enum\Metric;
use Route4Me\Enum\OptimizationType;
use Route4Me\Enum\TravelMode;
use Route4Me\Tracking\FindAssetResponse;
use Route4Me\Tracking\MemberData;
use Route4Me\OptimizationProblem;
use Route4Me\OptimizationProblemParams;
use Route4Me\Route;
use Route4Me\Route4Me;
use Route4Me\RouteParameters;
use Route4Me\Tracking\Track;
use Route4Me\Tracking\TrackSetParams;
use Route4Me\Tracking\UserLocation;
use Route4Me\Tracking\UserTracking;
use Route4Me\Tracking\SetGpsResponse;

class TrackingTests extends \PHPUnit\Framework\TestCase
{
    public static $createdProblems = [];
    public static $testRoutes = [];

    public static function setUpBeforeClass()
    {
        Route4Me::setApiKey(Constants::API_KEY);

        $json = json_decode(file_get_contents(dirname(__FILE__).'/data/addresses_md_tw.json'), true);

        $addresses = [];
        foreach ($json as $address) {
            $addresses[] = Address::fromArray($address);
        }

        $parameters = RouteParameters::fromArray([
            'algorithm_type'            => AlgorithmType::CVRP_TW_MD,
            'distance_unit'             => DistanceUnit::MILES,
            'device_type'               => DeviceType::WEB,
            'optimize'                  => OptimizationType::DISTANCE,
            'metric'                    => Metric::GEODESIC,
            'route_max_duration'        => 86400 * 2,
            'travel_mode'               => TravelMode::DRIVING,
            'vehicle_capacity'          => 50,
            'vehicle_max_distance_mi'   => 10000,
            'parts'                     => 50,
        ]);
        //endregion

        $optimizationParameters = new OptimizationProblemParams();
        $optimizationParameters->setAddresses($addresses);
        $optimizationParameters->setParameters($parameters);

        self::$createdProblems[] = OptimizationProblem::optimize($optimizationParameters);

        self::$testRoutes = self::$createdProblems[0]->routes;

        $params = TrackSetParams::fromArray([
            'format' => Format::SERIALIZED,
            'route_id' => self::$testRoutes[0]->route_id,
            'member_id' => self::$testRoutes[0]->parameters->member_id,
            'course' => 1,
            'speed' => 120,
            'lat' => 41.8927521,
            'lng' => -109.0803888,
            'device_type' => 'android_phone',
            'device_guid' => 'qweqweqwe',
            'device_timestamp' => date('Y-m-d H:i:s', strtotime('-2 day')),
        ]);

        $status = Track ::set($params);

        self::assertNotNull($status, "Cannot send GPS position to the selected route");
        self::assertTrue(isset($status['status']), "Cannot send GPS position to the selected route");
        self::assertTrue($status['status'], "Cannot send GPS position to the selected route");
    }

    public function testFromArray()
    {
        $trackingParams = TrackSetParams::fromArray([
            'member_id'     => 44444,
            'format'        => 'json',
            'route_id'      => '489D597EE62534C906096F1AAC278D26',
            'course'        => 72,
            'speed'         => 65,
            'lat'           => 38.218662,
            'lng'           => -85.789032,
            'device_type'   => 'android_phone',
            'device_guid'   => 'HK5454H0K454564WWER445'
        ]);

        $this->assertEquals(44444, $trackingParams->member_id);
        $this->assertEquals('489D597EE62534C906096F1AAC278D26', $trackingParams->route_id);

        $this->assertEquals(72, $trackingParams->course);
        $this->assertEquals(65, $trackingParams->speed);
        $this->assertEquals(38.218662, $trackingParams->lat);
        $this->assertEquals(-85.789032, $trackingParams->lng);
        $this->assertEquals('android_phone', $trackingParams->device_type);
        $this->assertEquals('HK5454H0K454564WWER445', $trackingParams->device_guid);
    }

    public function testFindAsset()
    {
        $trackingNumber = null;

        //region -- Get a tracking number from a random route destination --
        $routeId = self::$testRoutes[0]->route_id;

        $addresses = self::$testRoutes[0]->addresses;
        assert(!is_null($addresses), "Cannot retrieve a random route ID");

        foreach ($addresses as $addr1) {
            if (!is_null($addr1->tracking_number)) {
                $trackingNumber = $addr1->tracking_number;
                break;
            }
        }

        $this->assertNotNull($trackingNumber, "Cannot select a tracking number");

        //endregion

        $params = [
            'tracking' => $trackingNumber,
        ];

        $route = new Route();

        $result = $route->GetAssetTracking($params);

        $this->assertNotNull($result);
        $this->assertInstanceOf(FindAssetResponse::class, FindAssetResponse::fromArray($result));
    }

    public function testGetAllUserLocations()
    {
        $track = new Track();

        $userLocations = $track->getUserLocations();

        $this->assertNotNull($userLocations);
        $this->assertTrue(is_array($userLocations));
        $this->assertTrue(sizeof($userLocations)>0);
        $this->assertInstanceOf(
            UserLocation::class,
            UserLocation::fromArray($userLocations[0]));
        $this->assertInstanceOf(
            MemberData::class,
            MemberData::fromArray($userLocations[0]['member_data']));
        $this->assertInstanceOf(
            UserTracking::class,
            UserTracking::fromArray($userLocations[0]['tracking']));
    }

    public function testQueryUserLocations()
    {
        $track = new Track();
        $userLocations = $track->getUserLocations();
        $userLocation = reset($userLocations);

        $email = $userLocation['member_data']['member_email'];

        $queriedUserLocations = $track->getUserLocations($email);

        $this->assertNotNull($queriedUserLocations);
        $this->assertTrue(is_array($queriedUserLocations));
        $this->assertTrue(sizeof($queriedUserLocations)>0);
        $this->assertInstanceOf(
            UserLocation::class,
            UserLocation::fromArray($queriedUserLocations[0])
        );
        $this->assertInstanceOf(
            MemberData::class,
            MemberData::fromArray($queriedUserLocations[0]['member_data'])
        );
        $this->assertInstanceOf(
            UserTracking::class,
            UserTracking::fromArray($queriedUserLocations[0]['tracking'])
        );
    }

    public function testGetDeviceHistoryTimeRange()
    {
        $startDate = time() - 30 * 24 * 3600;
        $endDate = time() + 1 * 24 * 3600;

        $params = [
            'route_id' => self::$testRoutes[0]->route_id,
            'format' => Format::JSON,
            'time_period' => 'custom',
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];

        $route = new Route();

        $result = $route->GetTrackingHistoryFromTimeRange($params);

        $this->assertNotNull($result);
    }

    public function testSetGPSPosition()
    {
        $route = new Route();

        $routeId = self::$testRoutes[0]->route_id;

        // Set GPS postion to the selected route
        // Set right member_id corresponding to the API key
        $params = TrackSetParams::fromArray([
            'format' => Format::CSV,
            'route_id' => $routeId,
            'member_id' => self::$testRoutes[0]->parameters->member_id,
            'course' => 1,
            'speed' => 120,
            'lat' => 41.8927521,
            'lng' => -109.0803888,
            'device_type' => 'android_phone',
            'device_guid' => 'qweqweqwe',
            'device_timestamp' => date('Y-m-d H:i:s', strtotime('-1 day')),
        ]);

        $status = Track::set($params);

        $this->assertNotNull($status);
        $this->assertInstanceOf(
            SetGpsResponse::class,
            SetGpsResponse::fromArray($status)
        );
        $this->assertTrue($status['status']);
    }

    public function testTrackDeviceLastLocationHistory()
    {
        $route = new Route();

        $routeId = self::$testRoutes[0]->route_id;

        $params = [
            'route_id' => $routeId,
            'device_tracking_history' => '1',
        ];

        $result = $route->GetLastLocation($params);

        $this->assertNotNull($result);
        $this->assertInstanceOf(Route::class, $result);
        $this->assertTrue(isset($result->tracking_history));
    }

    public static function tearDownAfterClass()
    {
        if (sizeof(self::$createdProblems)>0) {
            $optimizationProblemIDs = [];

            foreach (self::$createdProblems as $problem) {
                $optimizationProblemId = $problem->optimization_problem_id;

                $optimizationProblemIDs[] = $optimizationProblemId;
            }

            $params = [
                'optimization_problem_ids' => $optimizationProblemIDs,
                'redirect'                 => 0,
            ];

            $problem = new OptimizationProblem();
            $result = $problem->removeOptimization($params);

            if ($result!=null && $result['status']==true) {
                echo "The test optimizations were removed <br>";
            } else {
                echo "Cannot remove the test optimizations <br>";
            }
        }
    }
}