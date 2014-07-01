<?php

namespace Route4me\Components;

use Route4me\RouteParameters;

class RouteParametersTest extends \PHPUnit_Framework_TestCase
{
    function testFromArray()
    {
        $params = RouteParameters::fromArray(array(
            'is_upload'  => false,
            'rt'         => true,
            'route_name' => 'php sdk test name'
        ));

        $this->assertFalse($params->is_upload);
        $this->assertTrue($params->rt);
        $this->assertEquals($params->route_name, 'php sdk test name');
    }

    function testFromArrayBadParams()
    {
        $params = RouteParameters::fromArray(array(
            'demoaddress' => 'php sdk test name'
        ));

        $this->assertFalse(property_exists($params, 'demoaddress'));
    }

    function testToArray()
    {
        $params = RouteParameters::fromArray(array(
            'demoaddress' => 'php sdk test name',
            'route_type'  => 'api',
            'store_route' => true,
            'is_upload'   => false,
            'rt'          => true,
            'route_name'  => 'php sdk test name'
        ));

        $this->assertEquals($params->toArray(), array(
            'route_type'  => 'api',
            'store_route' => true,
            'is_upload'   => false,
            'rt'          => true,
            'route_name'  => 'php sdk test name'
        ));
    }
}
