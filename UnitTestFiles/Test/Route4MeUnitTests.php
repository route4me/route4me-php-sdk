<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 7/18/20
 * Time: 11:40 PM
 */

namespace UnitTestFiles\Test;

use Route4Me\AvoidanceZone;

class Route4MeUnitTests extends \PHPUnit\Framework\TestCase {
    protected $AvoidanceZone;

    public function setUp()
    {
        $this->AvoidanceZone = new AvoidanceZone();
    }

    public function testgetAvoidanceZones()
    {
        echo "This Is Route4MeUnitTests <br>";
        $condition = true;
        $this->assertTrue($condition);
    }
}
 