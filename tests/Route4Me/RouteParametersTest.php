<?php

namespace Route4Me\Components;

use Route4Me\RouteParameters;

class RouteParametersTest extends \PHPUnit_Framework_TestCase
{
    public function testFromArray()
    {
        $params = RouteParameters::fromArray([
            'is_upload' => false,
            'rt' => true,
            'route_name' => 'php sdk test name',
        ]);

        $this->assertFalse($params->is_upload);
        $this->assertTrue($params->rt);
        $this->assertEquals($params->route_name, 'php sdk test name');
    }

    public function testFromArrayBadParams()
    {
        $params = RouteParameters::fromArray([
            'demoaddress' => 'php sdk test name',
        ]);

        $this->assertFalse(property_exists($params, 'demoaddress'));
    }

    public function testToArray()
    {
        $params = RouteParameters::fromArray([
            'demoaddress' => 'php sdk test name',
            'route_type' => 'api',
            'store_route' => true,
            'is_upload' => false,
            'rt' => true,
            'route_name' => 'php sdk test name',
        ]);

        $this->assertEquals($params->toArray(), [
            'route_type' => 'api',
            'store_route' => true,
            'is_upload' => false,
            'rt' => true,
            'route_name' => 'php sdk test name',
        ]);
    }
}
