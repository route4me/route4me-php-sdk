<?php

namespace UnitTestFiles\Test;

use Route4Me\Enum\Endpoint;
use Route4Me\Route4Me;

/**
 * Regression tests for the stateful base-URL poisoning bug: entrypoints that
 * talk to a non-default host must not leave the shared Route4Me::$baseUrl
 * pointing at that host, or a later request (e.g. AddAddressNote) leaks to it.
 */
class BaseUrlLeakUnitTests extends \PHPUnit\Framework\TestCase
{
    protected function setUp()
    {
        // Start every case from the known-good default host.
        Route4Me::setBaseUrl(Endpoint::BASE_URL);
    }

    protected function tearDown()
    {
        Route4Me::setBaseUrl(Endpoint::BASE_URL);
    }

    public function testVehicleConstructorsDoNotPoisonBaseUrl()
    {
        new \Route4Me\Vehicles\VehicleV4();
        new \Route4Me\Vehicles\Vehicle();
        new \Route4Me\Vehicles\VehiclesResponseV4();

        $this->assertEquals(
            Endpoint::BASE_URL,
            Route4Me::getBaseUrl(),
            'WH vehicle classes must not mutate the shared base URL'
        );
    }

    /**
     * Telematics vendor discovery is the reported poison source. It must route
     * itself per-request and leave the global default intact for later note
     * traffic. Assertion is stable regardless of whether the HTTP call succeeds.
     */
    public function testTelematicsDiscoveryDoesNotPoisonBaseUrl()
    {
        try {
            \Route4Me\TelematicsGateway\TelematicsVendor::GetTelematicsVendors(null);
        } catch (\Exception $e) {
            // Network/API outcome is irrelevant; we only assert the side effect.
        }

        $this->assertEquals(
            Endpoint::BASE_URL,
            Route4Me::getBaseUrl(),
            'GetTelematicsVendors must not leave the base URL on the telematics host'
        );
    }

    public function testPerRequestBaseUrlOverrideDoesNotMutateGlobal()
    {
        // makeRequst may fail on the fake host; the point is the global is untouched.
        try {
            Route4Me::makeRequst([
                'baseUrl' => 'https://example.invalid',
                'url'     => '/nowhere',
                'method'  => 'GET',
            ]);
        } catch (\Exception $e) {
        }

        $this->assertEquals(
            Endpoint::BASE_URL,
            Route4Me::getBaseUrl(),
            'A per-request baseUrl override must not change the shared default'
        );
    }
}
